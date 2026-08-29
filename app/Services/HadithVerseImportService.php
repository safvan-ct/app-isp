<?php

namespace App\Services;

use App\Models\HadithBook;
use App\Models\HadithChapter;
use App\Models\HadithVerse;
use App\Models\HadithVerseImportLog;
use App\Models\HadithVerseTranslation;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HadithVerseImportService
{
    protected string $baseUrl;

    public function __construct(protected ApiService $apiService)
    {
        $apiKey        = config('services.hadith.api_key');
        $template      = config('services.hadith.hadith');
        $this->baseUrl = str_replace('{api_key}', $apiKey, $template);
    }

    // -----------------------------------------------------------------------
    // Public API
    // -----------------------------------------------------------------------

    /**
     * Import or resume import of verses for a book (+ optional chapter).
     *
     * Behaviour:
     *  - No log found            → fresh import of ALL pages.
     *  - Log found, completed    → return "already imported" immediately.
     *  - Log found, incomplete   → resume: only process failed_pages.
     *
     * @return array{status:bool, message:string, new_count:int, updated_count:int,
     *               skipped_count:int, warnings:string[], log:array}
     */
    public function importVerses(?int $bookId = null, ?int $chapterId = null): array
    {
        if (! $bookId) {
            return $this->result(false, 'Please select a book to import verses.', 0, 0, 0, [], null);
        }

        set_time_limit(0);
        ini_set('memory_limit', '-1');

        $book = HadithBook::find($bookId);
        if (! $book) {
            return $this->result(false, "Book ID {$bookId} not found.", 0, 0, 0, [], null);
        }

        $chapter = null;
        if ($chapterId) {
            $chapter = HadithChapter::where('id', $chapterId)
                ->where('hadith_book_id', $bookId)
                ->first();
            if (! $chapter) {
                return $this->result(false, "Chapter ID {$chapterId} not found for this book.", 0, 0, 0, [], null);
            }
        }

        $scope = $chapter
            ? "book '{$book->name}' / chapter #{$chapter->chapter_number}"
            : "book '{$book->name}'";

        // ------------------------------------------------------------------
        // 1. Check existing log
        // ------------------------------------------------------------------
        $log = HadithVerseImportLog::forScope($bookId, $chapterId);

        if ($log && $log->isCompleted()) {
            $msg = "Already fully imported for {$scope}. {$log->successCount()} pages completed.";
            Log::info("[HadithVerseImport] {$msg}");
            return $this->result(true, $msg, 0, 0, 0, [], $log);
        }

        // ------------------------------------------------------------------
        // 2. Build API base URL
        // ------------------------------------------------------------------
        $urlBase = "{$this->baseUrl}&book={$book->slug}&paginate=500";
        if ($chapter) {
            $urlBase .= "&chapter={$chapter->id}";
        }

        // ------------------------------------------------------------------
        // 3. Fetch first page to get total_pages
        // ------------------------------------------------------------------
        $firstPage = $this->apiService->get("{$urlBase}&page=1");

        if (Arr::get($firstPage, 'status') !== 200) {
            $msg = "[HadithVerseImport] Failed to fetch first page for {$scope}. Status: "
                . Arr::get($firstPage, 'status');
            Log::error($msg, ['response' => $firstPage]);
            return $this->result(false, "API error fetching verses for {$scope}.", 0, 0, 0, [$msg], $log);
        }

        $totalPages = (int) Arr::get($firstPage, 'result.hadiths.last_page', 0);

        if ($totalPages === 0) {
            $msg = "[HadithVerseImport] No pages returned for {$scope}.";
            Log::warning($msg);
            return $this->result(true, $msg, 0, 0, 0, [$msg], $log);
        }

        // ------------------------------------------------------------------
        // 4. Create or update log
        // ------------------------------------------------------------------
        $isResume = $log !== null;

        if (! $log) {
            // Fresh import
            $log = HadithVerseImportLog::create([
                'hadith_book_id'    => $bookId,
                'hadith_chapter_id' => $chapterId,
                'total_pages'       => $totalPages,
                'success_pages'     => [],
                'failed_pages'      => [],
                'failed_hadiths'    => [],
                'status'            => 'in_progress',
                'started_at'        => now(),
            ]);
        } else {
            // Resume: keep existing success_pages, reset failed_pages for re-processing
            $log->update([
                'total_pages' => $totalPages,
                'status'      => 'in_progress',
                'started_at'  => $log->started_at ?? now(),
            ]);
        }

        Log::info("[HadithVerseImport] " . ($isResume ? 'Resuming' : 'Starting')
            . " import for {$scope}. Total pages: {$totalPages}."
            . ($isResume ? " Failed pages to retry: " . $log->failedCount() : ''));

        // ------------------------------------------------------------------
        // 5. Determine which pages to process
        // ------------------------------------------------------------------
        $pagesToProcess = $isResume && count($log->failed_pages ?? []) > 0
            ? $log->failed_pages   // Resume: only failed pages
            : range(1, $totalPages); // Fresh: all pages

        $successPages  = $log->success_pages ?? [];
        $failedPages   = $isResume ? [] : [];   // Start fresh tracking for this run's failures
        $failedHadiths = $log->failed_hadiths ?? [];
        $warnings      = [];
        $newCount      = $updatedCount = $skippedCount = 0;

        // ------------------------------------------------------------------
        // 6. Process each page
        // ------------------------------------------------------------------
        foreach ($pagesToProcess as $page) {
            $pageResult = $this->processPage(
                $page,
                $urlBase,
                $scope,
                $failedHadiths,
                $warnings,
                $newCount,
                $updatedCount
            );

            if ($pageResult === true) {
                // Success — add to success, remove from failed
                if (! in_array($page, $successPages)) {
                    $successPages[] = $page;
                }
                $failedPages = array_values(array_filter($failedPages, fn($p) => $p !== $page));
            } else {
                // Failure — add to failed pages list
                if (! in_array($page, $failedPages)) {
                    $failedPages[] = $page;
                }
                $skippedCount++;
            }

            // Persist log progress after every page
            $log->update([
                'success_pages'  => array_values(array_unique($successPages)),
                'failed_pages'   => array_values(array_unique($failedPages)),
                'failed_hadiths' => $failedHadiths,
            ]);
        }

        // ------------------------------------------------------------------
        // 7. Determine final status
        // ------------------------------------------------------------------
        sort($successPages);
        $uniqueSuccessCount = count(array_unique($successPages));
        $isComplete         = $uniqueSuccessCount >= $totalPages;

        $log->update([
            'success_pages'  => array_values(array_unique($successPages)),
            'failed_pages'   => array_values(array_unique($failedPages)),
            'failed_hadiths' => $failedHadiths,
            'status'         => $isComplete ? 'completed' : 'failed',
            'completed_at'   => $isComplete ? now() : null,
        ]);

        $action  = $isResume ? 'Resume' : 'Import';
        $summary = "{$action} " . ($isComplete ? 'COMPLETED' : 'PARTIALLY COMPLETED')
            . " for {$scope}. "
            . "New: {$newCount}, Updated: {$updatedCount}, "
            . "Success pages: {$uniqueSuccessCount}/{$totalPages}, "
            . "Failed pages: " . count($failedPages) . ".";

        Log::info("[HadithVerseImport] {$summary}", ['warnings_count' => count($warnings)]);

        $log->refresh();

        return $this->result($isComplete, $summary, $newCount, $updatedCount, $skippedCount, $warnings, $log);
    }

    // -----------------------------------------------------------------------
    // Private helpers
    // -----------------------------------------------------------------------

    /**
     * Process a single API page.
     *
     * @param  array  $failedHadiths  Passed by reference — appended to on errors.
     * @param  array  $warnings       Passed by reference.
     * @param  int    $newCount       Passed by reference.
     * @param  int    $updatedCount   Passed by reference.
     * @return bool   true on success, false on HTTP/API error.
     */
    private function processPage(
        int $page,
        string $urlBase,
        string $scope,
        array &$failedHadiths,
        array &$warnings,
        int &$newCount,
        int &$updatedCount
    ): bool {
        $response = $this->apiService->get("{$urlBase}&page={$page}");

        if (Arr::get($response, 'status') !== 200) {
            $reason  = Arr::get($response, 'message') ?? 'HTTP error';
            $msg     = "[HadithVerseImport] Page {$page} HTTP error for {$scope}: {$reason}";
            Log::error($msg);
            $warnings[] = $msg;

            $failedHadiths[] = ['page' => $page, 'hadith_id' => null, 'reason' => "Page HTTP error: {$reason}"];
            return false;
        }

        $data = Arr::get($response, 'result.hadiths.data', []);

        if (empty($data)) {
            Log::warning("[HadithVerseImport] Empty data on page {$page} for {$scope}.");
            return true; // Empty page still counts as success (no data to import)
        }

        $now        = now();
        $pageErrors = [];

        DB::transaction(function () use ($data, $now, $page, &$newCount, &$updatedCount, &$pageErrors, &$warnings) {
            foreach ($data as $hadith) {
                $apiId = Arr::get($hadith, 'id');

                if (! $apiId) {
                    $reason         = "Missing ID for hadithNumber=" . Arr::get($hadith, 'hadithNumber', '?');
                    $warnings[]     = "[HadithVerseImport] {$reason}";
                    $pageErrors[]   = ['page' => $page, 'hadith_id' => null, 'reason' => $reason];
                    Log::warning("[HadithVerseImport] Hadith has no ID.", ['hadith' => Arr::only($hadith, ['hadithNumber'])]);
                    continue;
                }

                $hadithBookId  = Arr::get($hadith, 'book.id');
                $hadithChapId  = Arr::get($hadith, 'chapter.id');
                $chapterNum    = Arr::get($hadith, 'chapter.chapterNumber');
                $hadithNum     = (int) Arr::get($hadith, 'hadithNumber', 0);

                if (! $hadithBookId || ! $hadithChapId) {
                    $reason       = "Hadith #{$apiId} missing book or chapter ID.";
                    $warnings[]   = "[HadithVerseImport] {$reason}";
                    $pageErrors[] = ['page' => $page, 'hadith_id' => $apiId, 'reason' => $reason];
                    Log::warning("[HadithVerseImport] {$reason}");
                    continue;
                }

                $exists = HadithVerse::where('id', $apiId)->exists();

                HadithVerse::updateOrInsert(
                    ['id' => $apiId],
                    [
                        'hadith_book_id'    => $hadithBookId,
                        'hadith_chapter_id' => $hadithChapId,
                        'chapter_number'    => $chapterNum,
                        'hadith_number'     => $hadithNum,
                        'heading'           => Arr::get($hadith, 'headingArabic') ?: null,
                        'text'              => Arr::get($hadith, 'hadithArabic') ?: null,
                        'volume'            => Arr::get($hadith, 'volume'),
                        'status'            => strtolower(Arr::get($hadith, 'status', '')),
                        'is_active'         => 1,
                        'updated_at'        => $now,
                        'created_at'        => $now,
                    ]
                );

                $exists ? $updatedCount++ : $newCount++;

                // English translation
                $enText    = Arr::get($hadith, 'hadithEnglish');
                $enHeading = Arr::get($hadith, 'headingEnglish');
                $narrator  = Arr::get($hadith, 'narrator');

                if ($enText) {
                    HadithVerseTranslation::updateOrInsert(
                        ['hadith_verse_id' => $apiId, 'lang' => 'en'],
                        [
                            'narrator'         => $narrator,
                            'heading'          => $enHeading ?: null,
                            'text'             => $enText,
                            'status_romanized' => strtolower(Arr::get($hadith, 'status', '')),
                            'is_active'        => 1,
                            'created_by'       => 1,
                            'updated_at'       => $now,
                            'created_at'       => $now,
                        ]
                    );
                } else {
                    $reason       = "Hadith #{$apiId} has no English text.";
                    $warnings[]   = "[HadithVerseImport] {$reason}";
                    $pageErrors[] = ['page' => $page, 'hadith_id' => $apiId, 'reason' => $reason];
                    Log::warning("[HadithVerseImport] {$reason}");
                }
            }
        });

        // Merge this page's hadith-level errors into the global array
        foreach ($pageErrors as $err) {
            $failedHadiths[] = $err;
        }

        Log::info("[HadithVerseImport] Processed page {$page} for {$scope}. Errors: " . count($pageErrors));

        unset($data);
        gc_collect_cycles();

        return true;
    }

    private function result(
        bool $status,
        string $message,
        int $new,
        int $updated,
        int $skipped,
        array $warnings,
        ?HadithVerseImportLog $log
    ): array {
        return [
            'status'        => $status,
            'message'       => $message,
            'new_count'     => $new,
            'updated_count' => $updated,
            'skipped_count' => $skipped,
            'warnings'      => $warnings,
            'log'           => $log ? $this->logToArray($log) : null,
        ];
    }

    public function logToArray(HadithVerseImportLog $log): array
    {
        return [
            'id'              => $log->id,
            'total_pages'     => $log->total_pages,
            'success_count'   => $log->successCount(),
            'failed_count'    => $log->failedCount(),
            'progress'        => $log->progressPercent(),
            'status'          => $log->status,
            'failed_pages'    => $log->failed_pages ?? [],
            'failed_hadiths'  => $log->failed_hadiths ?? [],
            'started_at'      => $log->started_at?->toDateTimeString(),
            'completed_at'    => $log->completed_at?->toDateTimeString(),
        ];
    }
}
