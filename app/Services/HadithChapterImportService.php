<?php
namespace App\Services;

use App\Models\HadithBook;
use App\Models\HadithChapter;
use App\Models\HadithChapterTranslation;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class HadithChapterImportService
{
    public function __construct(protected ApiService $apiService)
    {}

    /**
     * Import or re-import Hadith chapters for a specific book or all books.
     *
     * @param int|null $bookId
     * @return array
     */
    public function importChapters(?int $bookId = null): array
    {
        $apiKey  = config('services.hadith.api_key');
        $baseUrl = config('services.hadith.chapter');

        if (empty($apiKey) || empty($baseUrl)) {
            $msg = 'Hadith API key or chapter URL is missing in configuration.';
            Log::error("[HadithChapterImport] {$msg}");
            return ['status' => false, 'message' => $msg];
        }

        $query = HadithBook::query();
        if ($bookId) {
            $query->where('id', $bookId);
        }

        $books = $query->get();

        if ($books->isEmpty()) {
            $msg = $bookId ? "Hadith book with ID {$bookId} not found." : "No Hadith books found in database.";
            Log::warning("[HadithChapterImport] {$msg}");
            return ['status' => false, 'message' => $msg];
        }

        $importedCount = 0;
        $updatedCount  = 0;
        $skippedCount  = 0;
        $warnings      = [];

        foreach ($books as $book) {
            $url      = str_replace(['{book_slug}', '{api_key}'], [$book->slug, $apiKey], $baseUrl);
            $response = $this->apiService->get($url);

            if (Arr::get($response, 'status') !== 200) {
                $msg = "Failed to fetch chapters for book '{$book->name}' ({$book->slug}). API Status: " . Arr::get($response, 'status', 'Unknown');
                Log::error("[HadithChapterImport] {$msg}", ['response' => $response]);
                $warnings[] = $msg;
                continue;
            }

            $chaptersData = Arr::get($response, 'result.chapters', []);
            if (empty($chaptersData) || ! is_array($chaptersData)) {
                $msg = "No chapters found in API response for book '{$book->slug}'.";
                Log::warning("[HadithChapterImport] {$msg}");
                $warnings[] = $msg;
                continue;
            }

            // Load Malayalam translations JSON if available
            $path       = database_path("json/hadith/{$book->slug}.json");
            $chaptersMl = file_exists($path) ? json_decode(file_get_contents($path), true) : [];
            $chapterMap = count($chaptersMl) > 0 ? array_column($chaptersMl, null, 'id') : [];

            try {
                DB::transaction(function () use ($book, $chaptersData, $chapterMap, &$importedCount, &$updatedCount, &$skippedCount, &$warnings) {
                    $sort = 1;
                    foreach ($chaptersData as $index => $chapData) {
                        $chapNum    = isset($chapData['chapterNumber']) ? (int) $chapData['chapterNumber'] : null;
                        $apiChapId  = $chapData['id'] ?? null;
                        $arabicName = $chapData['chapterArabic'] ?? null;
                        $englishRaw = $chapData['chapterEnglish'] ?? null;

                        if (is_null($chapNum)) {
                            $warn = "Book '{$book->slug}' chapter at index {$index} missing 'chapterNumber'. Skipping.";
                            Log::warning("[HadithChapterImport] {$warn}", ['chapter_data' => $chapData]);
                            $warnings[] = $warn;
                            $skippedCount++;
                            continue;
                        }

                        if (empty($englishRaw) && empty($arabicName)) {
                            $warn = "Book '{$book->slug}' chapter #{$chapNum} missing titles. Using default name.";
                            Log::warning("[HadithChapterImport] {$warn}");
                            $warnings[] = $warn;
                        }

                        $slugText = ! empty($englishRaw) ? $englishRaw : "chapter-{$chapNum}";
                        $slug     = Str::slug($slugText);

                        $chapterAttributes = [
                            'id'   => $apiChapId,
                            'slug' => $slug,
                            'name' => $arabicName ?? $englishRaw ?? "Chapter {$chapNum}",
                            'sort' => $sort++,
                        ];

                        $existingChapter = HadithChapter::where('hadith_book_id', $book->id)->where('chapter_number', $chapNum)->first();
                        if ($existingChapter) {
                            $existingChapter->update($chapterAttributes);
                            $chapterModel = $existingChapter;
                            $updatedCount++;
                        } else {
                            $chapterModel = HadithChapter::firstOrCreate(array_merge([
                                'hadith_book_id' => $book->id,
                                'chapter_number' => $chapNum,
                            ], $chapterAttributes));
                            $importedCount++;
                        }

                        // Arabic Translation
                        HadithChapterTranslation::updateOrCreate(
                            ['hadith_chapter_id' => $chapterModel->id, 'lang' => 'ar'],
                            [
                                'name'       => $arabicName ?? $chapterModel->name,
                                'created_by' => 1,
                            ]
                        );

                        // English Translation
                        $enParsed = parseHadithTitle($englishRaw ?? '');
                        HadithChapterTranslation::updateOrCreate(
                            ['hadith_chapter_id' => $chapterModel->id, 'lang' => 'en'],
                            [
                                'name'           => $enParsed['title'] ?? $englishRaw,
                                'name_romanized' => $enParsed['romanized'] ?? null,
                                'description'    => $enParsed['description'] ?? null,
                                'created_by'     => 1,
                            ]
                        );

                        // Malayalam Translation if available
                        if ($apiChapId && isset($chapterMap[$apiChapId])) {
                            $mlItem = $chapterMap[$apiChapId];
                            HadithChapterTranslation::updateOrCreate(
                                ['hadith_chapter_id' => $chapterModel->id, 'lang' => 'ml'],
                                [
                                    'name'       => $mlItem['name'] ?? null,
                                    'created_by' => 1,
                                ]
                            );
                        }
                    }
                });
            } catch (\Throwable $e) {
                $msg = "Error during chapter transaction for book '{$book->slug}': " . $e->getMessage();
                Log::error("[HadithChapterImport] {$msg}", ['trace' => $e->getTraceAsString()]);
                $warnings[] = $msg;
            }
        }

        $summary = "Hadith chapters import finished. New: {$importedCount}, Updated: {$updatedCount}, Skipped: {$skippedCount}, Warnings: " . count($warnings);
        Log::info("[HadithChapterImport] {$summary}", ['warnings' => $warnings]);

        return [
            'status'  => true,
            'message' => "Import completed! (New: {$importedCount}, Updated: {$updatedCount}, Skipped: {$skippedCount})",
            'imported_count' => $importedCount,
            'updated_count' => $updatedCount,
            'skipped_count' => $skippedCount,
            'warnings' => $warnings,
        ];
    }
}
