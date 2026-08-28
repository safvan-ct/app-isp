<?php
namespace App\Services;

use App\Models\HadithBook;
use App\Models\HadithChapter;
use App\Models\HadithVerse;
use App\Models\HadithVerseTranslation;
use App\Services\ApiService;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HadithVerseImportService
{
    protected string $baseUrl;

    public function __construct(protected ApiService $apiService)
    {
        $apiKey        = config('services.hadith.api_key');
        $template      = config('services.hadith.hadith'); // "https://.../?apiKey={api_key}"
        $this->baseUrl = str_replace('{api_key}', $apiKey, $template);
    }

    /**
     * Import / re-import verses for a specific book, optionally filtered to one chapter.
     * If no bookId is given, nothing is processed (we never bulk-import all books at once).
     *
     * @return array{status:bool, message:string, new_count:int, updated_count:int, skipped_count:int, warnings:string[]}
     */
    public function importVerses(?int $bookId = null, ?int $chapterId = null): array
    {
        if (! $bookId) {
            return $this->result(false, 'Please select a book to import verses.', 0, 0, 0, []);
        }

        set_time_limit(0);
        ini_set('memory_limit', '-1');

        $book = HadithBook::find($bookId);
        if (! $book) {
            return $this->result(false, "Book ID {$bookId} not found.", 0, 0, 0, []);
        }

        // If chapter is specified, verify it belongs to this book
        $chapter = null;
        if ($chapterId) {
            $chapter = HadithChapter::where('id', $chapterId)->where('hadith_book_id', $bookId)->first();
            if (! $chapter) {
                return $this->result(false, "Chapter ID {$chapterId} not found for this book.", 0, 0, 0, []);
            }
        }

        $scope    = $chapter ? "book '{$book->name}' / chapter #{$chapter->chapter_number}" : "book '{$book->name}'";
        $warnings = [];
        $newCount = $updatedCount = $skippedCount = 0;

        Log::info("[HadithVerseImport] Starting import for {$scope}.");

        try {
            // Build base URL for this book (+ optional chapter)
            $urlBase = "{$this->baseUrl}&book={$book->slug}&paginate=500";
            if ($chapter) {
                $urlBase .= "&chapter={$chapter->id}";
            }

            // Fetch first page to get total pages
            $firstPage  = $this->apiService->get("{$urlBase}&page=1");
            if (Arr::get($firstPage, 'status') !== 200) {
                $msg = "[HadithVerseImport] Failed to fetch first page for {$scope}. Status: " . Arr::get($firstPage, 'status');
                Log::error($msg, ['response' => $firstPage]);
                $warnings[] = $msg;
                return $this->result(false, "API error fetching verses for {$scope}.", 0, 0, 0, $warnings);
            }

            $totalPages = (int) Arr::get($firstPage, 'result.hadiths.last_page', 0);
            if ($totalPages === 0) {
                $msg = "[HadithVerseImport] No pages returned for {$scope}.";
                Log::warning($msg);
                return $this->result(true, $msg, 0, 0, 0, [$msg]);
            }

            Log::info("[HadithVerseImport] {$scope} — {$totalPages} pages to process.");

            for ($page = 1; $page <= $totalPages; $page++) {
                $response = $this->apiService->get("{$urlBase}&page={$page}");

                if (Arr::get($response, 'status') !== 200) {
                    $msg = "[HadithVerseImport] Error on page {$page} for {$scope}: " . (Arr::get($response, 'message') ?? 'unknown');
                    Log::error($msg);
                    $warnings[] = $msg;
                    $skippedCount++;
                    continue;
                }

                $data = Arr::get($response, 'result.hadiths.data', []);

                if (empty($data)) {
                    Log::warning("[HadithVerseImport] Empty data on page {$page} for {$scope}.");
                    $skippedCount++;
                    continue;
                }

                $now = now();

                DB::transaction(function () use ($data, $now, &$newCount, &$updatedCount, &$warnings) {
                    foreach ($data as $hadith) {
                        $id = Arr::get($hadith, 'id');

                        if (! $id) {
                            $warnings[] = "[HadithVerseImport] Missing ID for hadith #" . Arr::get($hadith, 'hadithNumber', '?');
                            Log::warning("[HadithVerseImport] Hadith has no ID.", ['hadith' => $hadith]);
                            continue;
                        }

                        $bookId     = Arr::get($hadith, 'book.id');
                        $chapterId  = Arr::get($hadith, 'chapter.id');
                        $chapterNum = Arr::get($hadith, 'chapter.chapterNumber');
                        $hadithNum  = (int) Arr::get($hadith, 'hadithNumber', 0);

                        if (! $bookId || ! $chapterId) {
                            $warnings[] = "[HadithVerseImport] Hadith #{$id} missing book/chapter ID.";
                            Log::warning("[HadithVerseImport] Hadith #{$id} missing book or chapter ID.");
                            continue;
                        }

                        $verseExists = HadithVerse::where('id', $id)->exists();

                        HadithVerse::updateOrInsert(
                            ['id' => $id],
                            [
                                'hadith_book_id'    => $bookId,
                                'hadith_chapter_id' => $chapterId,
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

                        if ($verseExists) {
                            $updatedCount++;
                        } else {
                            $newCount++;
                        }

                        // Upsert English translation
                        $enHeading = Arr::get($hadith, 'headingEnglish');
                        $enText    = Arr::get($hadith, 'hadithEnglish');
                        $narrator  = Arr::get($hadith, 'narrator');

                        if ($enText) {
                            HadithVerseTranslation::updateOrInsert(
                                ['hadith_verse_id' => $id, 'lang' => 'en'],
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
                            $warnings[] = "[HadithVerseImport] Hadith #{$id} has no English text.";
                            Log::warning("[HadithVerseImport] Hadith #{$id} has no English text.");
                        }
                    }
                });

                unset($data);
                gc_collect_cycles();

                Log::info("[HadithVerseImport] Processed page {$page}/{$totalPages} for {$scope}.");
            }

            $summary = "Import complete for {$scope}. New: {$newCount}, Updated: {$updatedCount}, Skipped pages: {$skippedCount}.";
            Log::info("[HadithVerseImport] {$summary}", ['warnings' => $warnings]);

            return $this->result(true, $summary, $newCount, $updatedCount, $skippedCount, $warnings);

        } catch (\Exception $e) {
            Log::error("[HadithVerseImport] Exception: " . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return $this->result(false, 'Import failed: ' . $e->getMessage(), $newCount, $updatedCount, $skippedCount, $warnings);
        }
    }

    private function result(bool $status, string $message, int $new, int $updated, int $skipped, array $warnings): array
    {
        return [
            'status'        => $status,
            'message'       => $message,
            'new_count'     => $new,
            'updated_count' => $updated,
            'skipped_count' => $skipped,
            'warnings'      => $warnings,
        ];
    }
}
