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
            $urlBase .= "&chapter={$chapter->chapter_number}";
        }

        // ------------------------------------------------------------------
        // 3. Fetch first page to get total_pages
        // ------------------------------------------------------------------
        try {
            $firstPage = $this->apiService->get("{$urlBase}&page=1");
        } catch (\Exception $e) {
            $msg = "Failed to connect to API: " . $e->getMessage();
            Log::error("[HadithVerseImport] {$msg}");
            $this->markLogError($log, $msg);
            return $this->result(false, $msg, 0, 0, 0, [$msg], $log ? $log->refresh() : null);
        }

        if (Arr::get($firstPage, 'status') !== 200) {
            $msg = "API error fetching first page for {$scope}. Status: " . Arr::get($firstPage, 'status');
            Log::error("[HadithVerseImport] {$msg}", ['response' => $firstPage]);
            $this->markLogError($log, $msg);
            return $this->result(false, $msg, 0, 0, 0, [$msg], $log ? $log->refresh() : null);
        }

        $totalPages = (int) Arr::get($firstPage, 'result.hadiths.last_page', 0);

        if ($totalPages === 0) {
            $msg = "No pages returned for {$scope}.";
            Log::warning("[HadithVerseImport] {$msg}");
            return $this->result(true, $msg, 0, 0, 0, [$msg], $log);
        }

        // ------------------------------------------------------------------
        // 4. Create or update log — mark in_progress
        // ------------------------------------------------------------------
        $isResume = $log !== null;

        try {
            if (! $log) {
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
                $log->update([
                    'total_pages' => $totalPages,
                    'status'      => 'in_progress',
                    'started_at'  => $log->started_at ?? now(),
                ]);
                $log->refresh();
            }
        } catch (\Exception $e) {
            $msg = "Failed to create/update import log: " . $e->getMessage();
            Log::error("[HadithVerseImport] {$msg}");
            return $this->result(false, $msg, 0, 0, 0, [$msg], null);
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
        // On resume: start with FULL existing failed list from DB so that
        // page-by-page saves always reflect truly-remaining pages.
        // On fresh: start empty, failed pages accumulate as they fail.
        $failedPages   = $isResume ? ($log->failed_pages ?? []) : [];
        $failedHadiths = $log->failed_hadiths ?? [];
        $warnings      = [];
        $newCount      = $updatedCount = $skippedCount = 0;

        // ------------------------------------------------------------------
        // 6. Process each page — catch ALL exceptions so the log is always saved
        // ------------------------------------------------------------------
        try {
            foreach ($pagesToProcess as $page) {
                try {
                    $pageResult = $this->processPage(
                        $page,
                        $urlBase,
                        $scope,
                        $failedHadiths,
                        $warnings,
                        $newCount,
                        $updatedCount
                    );
                } catch (\Exception $e) {
                    // Unexpected exception on a single page (e.g. DB connection lost mid-transaction)
                    $reason      = "Page {$page} threw exception: " . $e->getMessage();
                    $warnings[]  = "[HadithVerseImport] {$reason}";
                    $failedHadiths[] = ['page' => $page, 'hadith_id' => null, 'reason' => $reason];
                    Log::error("[HadithVerseImport] {$reason}", ['trace' => $e->getTraceAsString()]);
                    $pageResult = false;
                }

                if ($pageResult === true) {
                    // Add to success if not already there
                    if (! in_array($page, $successPages)) {
                        $successPages[] = $page;
                    }
                    // ALWAYS remove from failed — shrinks DB's failed_pages as we go
                    $failedPages = array_values(array_filter($failedPages, fn($p) => $p !== $page));
                } else {
                    // Keep/add in failed pages
                    if (! in_array($page, $failedPages)) {
                        $failedPages[] = $page;
                    }
                    // If this page previously succeeded but now fails, demote it
                    $successPages = array_values(array_filter($successPages, fn($p) => $p !== $page));
                    $skippedCount++;
                }

                // Persist progress after every page — log is always up-to-date
                try {
                    $log->update([
                        'success_pages'  => array_values(array_unique($successPages)),
                        'failed_pages'   => array_values(array_unique($failedPages)),
                        'failed_hadiths' => $failedHadiths,
                    ]);
                } catch (\Exception $e) {
                    // Log save failed — don't abort import, just log it
                    Log::error("[HadithVerseImport] Failed to save log after page {$page}: " . $e->getMessage());
                }
            }
        } catch (\Exception $e) {
            // Outer catch: catastrophic failure (e.g. OOM, unexpected fatal)
            $reason = "Catastrophic error during import loop: " . $e->getMessage();
            Log::error("[HadithVerseImport] {$reason}", ['trace' => $e->getTraceAsString()]);
            $warnings[] = $reason;
            $failedHadiths[] = ['page' => 0, 'hadith_id' => null, 'reason' => $reason];

            // Compute remaining pages (not yet in success) as failed
            $allPages     = range(1, $totalPages);
            $remaining    = array_values(array_diff($allPages, array_unique($successPages)));
            foreach ($remaining as $rp) {
                if (! in_array($rp, $failedPages)) {
                    $failedPages[] = $rp;
                }
            }

            // Save the error state to the log
            try {
                $log->update([
                    'success_pages'  => array_values(array_unique($successPages)),
                    'failed_pages'   => array_values(array_unique($failedPages)),
                    'failed_hadiths' => $failedHadiths,
                    'status'         => 'failed',
                    'completed_at'   => null,
                ]);
            } catch (\Exception $saveEx) {
                Log::error("[HadithVerseImport] Also failed to save log after catastrophic error: " . $saveEx->getMessage());
            }

            $log->refresh();
            return $this->result(false, $reason, $newCount, $updatedCount, $skippedCount, $warnings, $log);
        }

        // ------------------------------------------------------------------
        // 7. Determine final status and persist
        // ------------------------------------------------------------------
        sort($successPages);
        $uniqueSuccessPages = array_values(array_unique($successPages));
        $uniqueSuccessCount = count($uniqueSuccessPages);

        // Pages still missing from success = truly remaining / failed
        $allPages       = range(1, $totalPages);
        $remainingPages = array_values(array_diff($allPages, $uniqueSuccessPages));
        $isComplete     = count($remainingPages) === 0;

        $finalFailedPages = $isComplete
            ? []
            : array_values(array_unique(array_merge($failedPages, $remainingPages)));

        try {
            $log->update([
                'success_pages'  => $uniqueSuccessPages,
                'failed_pages'   => $finalFailedPages,
                'failed_hadiths' => $failedHadiths,
                'status'         => $isComplete ? 'completed' : 'failed',
                'completed_at'   => $isComplete ? now() : null,
            ]);
        } catch (\Exception $e) {
            Log::error("[HadithVerseImport] Failed to save final log status: " . $e->getMessage());
        }

        $action  = $isResume ? 'Resume' : 'Import';
        $summary = "{$action} " . ($isComplete ? 'COMPLETED' : 'PARTIALLY COMPLETED')
            . " for {$scope}. "
            . "New: {$newCount}, Updated: {$updatedCount}, "
            . "Success pages: {$uniqueSuccessCount}/{$totalPages}, "
            . "Failed pages: " . count($finalFailedPages) . ".";

        Log::info("[HadithVerseImport] {$summary}", ['warnings_count' => count($warnings)]);

        $log->refresh();

        return $this->result($isComplete, $summary, $newCount, $updatedCount, $skippedCount, $warnings, $log);
    }

    // -----------------------------------------------------------------------
    // Private helpers
    // -----------------------------------------------------------------------

    /**
     * If an API/connection error happens before the main loop starts,
     * mark the existing log as 'failed' and append the error to failed_hadiths.
     */
    private function markLogError(?HadithVerseImportLog $log, string $reason): void
    {
        if (! $log) {
            return;
        }

        try {
            $failedHadiths   = $log->failed_hadiths ?? [];
            $failedHadiths[] = ['page' => 0, 'hadith_id' => null, 'reason' => $reason];

            $log->update([
                'failed_hadiths' => $failedHadiths,
                'status'         => 'failed',
                'completed_at'   => null,
            ]);
        } catch (\Exception $e) {
            Log::error("[HadithVerseImport] Could not update log with error: " . $e->getMessage());
        }
    }

    /**
     * Process a single API page.
     * Returns true on success, false on HTTP/API error.
     * Throws \Exception on unexpected/fatal errors (caller handles them).
     *
     * @param  array  $failedHadiths  Passed by reference — appended to on errors.
     * @param  array  $warnings       Passed by reference.
     * @param  int    $newCount       Passed by reference.
     * @param  int    $updatedCount   Passed by reference.
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
            $reason      = Arr::get($response, 'message') ?? 'HTTP error';
            $msg         = "[HadithVerseImport] Page {$page} HTTP error for {$scope}: {$reason}";
            Log::error($msg);
            $warnings[]      = $msg;
            $failedHadiths[] = ['page' => $page, 'hadith_id' => null, 'reason' => "Page HTTP error: {$reason}"];
            return false;
        }

        $data = Arr::get($response, 'result.hadiths.data', []);

        if (empty($data)) {
            Log::warning("[HadithVerseImport] Empty data on page {$page} for {$scope}.");
            return true; // Empty page = success (nothing to import)
        }

        $now        = now();
        $pageErrors = [];

        try {
            DB::transaction(function () use ($data, $now, $page, &$newCount, &$updatedCount, &$pageErrors, &$warnings) {
                foreach ($data as $hadith) {
                    $apiId = Arr::get($hadith, 'id');

                    if (! $apiId) {
                        $reason       = "Missing ID for hadithNumber=" . Arr::get($hadith, 'hadithNumber', '?');
                        $warnings[]   = "[HadithVerseImport] {$reason}";
                        $pageErrors[] = ['page' => $page, 'hadith_id' => null, 'reason' => $reason];
                        Log::warning("[HadithVerseImport] Hadith has no ID.", ['hadith' => Arr::only($hadith, ['hadithNumber'])]);
                        continue;
                    }

                    $hadithBookId = Arr::get($hadith, 'book.id');
                    $hadithChapId = Arr::get($hadith, 'chapter.id');
                    $chapterNum   = Arr::get($hadith, 'chapter.chapterNumber');
                    $hadithNum    = (int) Arr::get($hadith, 'hadithNumber', 0);

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
        } catch (\Exception $e) {
            // DB transaction failed — the entire page's writes were rolled back.
            // Record as page-level failure and bubble up as false (not as exception).
            $reason      = "DB transaction failed on page {$page}: " . $e->getMessage();
            Log::error("[HadithVerseImport] {$reason}");
            $warnings[]      = "[HadithVerseImport] {$reason}";
            $failedHadiths[] = ['page' => $page, 'hadith_id' => null, 'reason' => $reason];
            return false;
        }

        // Merge hadith-level errors collected inside the transaction
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
            'id'             => $log->id,
            'total_pages'    => $log->total_pages,
            'success_count'  => $log->successCount(),
            'failed_count'   => $log->failedCount(),
            'progress'       => $log->progressPercent(),
            'status'         => $log->status,
            'failed_pages'   => $log->failed_pages ?? [],
            'failed_hadiths' => $log->failed_hadiths ?? [],
            'started_at'     => $log->started_at?->toDateTimeString(),
            'completed_at'   => $log->completed_at?->toDateTimeString(),
        ];
    }
}
