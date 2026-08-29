<?php
namespace App\Services;

use App\Models\HadithBook;
use App\Models\HadithBookTranslation;
use App\Models\HadithChapter;
use App\Models\HadithChapterTranslation;
use App\Models\HadithJsonImportLog;
use App\Models\HadithVerse;
use App\Models\HadithVerseTranslation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * HadithJsonImportService
 *
 * Imports Hadith books, chapters, and verses from local JSON files
 * located in database/hadees/{file}.json.
 *
 * JSON structure expected:
 * {
 *   "metadata": { "id": int, "english": { "title": string }, "arabic": { "title": string, "author": string } },
 *   "chapters": [ { "id": int|null, "bookId": int, "arabic": string, "english": string } ],
 *   "hadiths":  [ { "id": int, "idInBook": int, "chapterId": int, "bookId": int,
 *                   "arabic": string, "english": { "narrator": string, "text": string } } ]
 * }
 */
class HadithJsonImportService
{
    /**
     * Predefined book metadata (translations, abbreviations, etc.) keyed by book slug.
     * Add more entries here when new JSON files are added.
     */
    protected array $bookTranslationsInfo = [
        'muwatta-malik'           => [
            'en' => [
                'name'         => 'The Muwaṭṭa',
                'writer'       => 'Imam Malik ibn Anas',
                'life_span'    => '93-179 AH',
                'status'       => 'muwatta',
                'abbreviation' => 'MW',
                'desc'         => 'Islamic jurisprudence, worship, transactions, manners, and Prophetic traditions.',
                'group'        => "Kutub al-Tis'ah",
            ],
            'ar' => [
                'name' => 'المواطأ', 'writer' => 'مالك بن أنس', 'life_span' => '93-179 هـ',
            ],
            'ml' => [
                'name'      => 'അൽ-മുവത്ത',
                'writer'    => 'മാലിക് ഇബ്നു അനസ്',
                'life_span' => '93-179 ഹി',
            ],
        ],
        'musnad-ahmad-ibn-hanbal' => [
            'en' => [
                'name'         => 'Musnad Ahmad ibn Hanbal',
                'writer'       => 'Ahmad ibn Muhammad ibn Hanbal',
                'desc'         => 'Hadith collection arranged primarily according to the Companion narrator, rather than by fiqh subject.',
                'status'       => 'musnad',
                'abbreviation' => 'MAH',
                'group'        => "Kutub al-Tis'ah",
                'life_span'    => '164-241 AH',
            ],
            'ar' => [
                'name' => 'مُسْنَد أَحْمَد بْن حَنْبَل', 'writer' => 'اَحْمَد بْن مُحَمَّد بْن حَنْبَل', 'life_span' => '164-241 هـ',
            ],
            'ml' => [
                'name'      => 'മുസ്നാദ് അഹ്മദ് ഇബ്ന് ഹന്ബൽ',
                'writer'    => 'അഹ്മദ് ഇബ്നു മുഹമ്മദ് ഇബ്ന് ഹന്ബൽ',
                'life_span' => '164-241 ഹി',
            ],
        ],
        'sunan-al-darimi'         => [
            'en' => [
                'name'         => 'Sunan al-Darimi',
                'writer'       => 'Abdullah ibn Abd al-Rahman al-Darimi',
                'desc'         => 'A major hadith collection arranged by subject, covering jurisprudence, worship, manners, and other aspects of the Sunnah.',
                'status'       => 'sunan',
                'abbreviation' => 'SD',
                'group'        => "Kutub al-Tis'ah",
                'life_span'    => '181-255 AH',
            ],
            'ar' => [
                'name' => 'سنن الدارمي', 'writer' => 'عبد الله بن عبد الرحمن الدارمي', 'life_span' => '181-255 هـ',
            ],
            'ml' => [
                'name'      => 'സുനാൻ അൽ-ദാരിമി',
                'writer'    => 'അബ്ദുള്ളാ ഇബ്നു അബ്ദുൽ റഹ്മാൻ അൽ-ദാരിമി',
                'life_span' => '181-255 ഹി',
            ],
        ],
        'riyad-as-salihin'        => [
            'en' => [
                'name'         => 'Riyad as-Salihin',
                'writer'       => 'Yahya ibn Sharaf al-Nawawi',
                'desc'         => 'Focusing on worship, manners, ethics, spirituality, and righteous conduct',
                'status'       => 'collection',
                'abbreviation' => 'RAS',
                'group'        => 'Thematic',
                'life_span'    => '631-676 AH',
            ],
            'ar' => [
                'name' => 'رياض الصالحين', 'writer' => 'يحيى بن شرف النواوي', 'life_span' => '631-676 هـ',
            ],
            'ml' => [
                'name'      => 'റിയാദ് അസ്-സാലിഹിൻ',
                'writer'    => 'യഹ്യ ഇബ്നു ഷാറഫ് അൽ-നവവി',
                'life_span' => '631-676 ഹി',
            ],
        ],
    ];

    /**
     * Map of JSON file names (without extension) to their canonical book slugs.
     * Used to match a file like "malik.json" to the slug "muwatta-malik".
     */
    protected array $fileToSlugMap = [
        'malik'           => 'muwatta-malik',
        'ahmed'           => 'musnad-ahmad-ibn-hanbal',
        'darimi'          => 'sunan-al-darimi',
        'riyad_assalihin' => 'riyad-as-salihin',
    ];

    // -----------------------------------------------------------------------
    // Public API
    // -----------------------------------------------------------------------

    /**
     * Import a single JSON file: book + chapters + verses.
     *
     * @param  string  $fileName  Bare file name without extension, e.g. "malik"
     * @return array{status:bool, message:string, book:array|null,
     *               chapters_imported:int, chapters_updated:int,
     *               verses_imported:int, verses_updated:int,
     *               skipped_count:int, warnings:string[]}
     */
    public function importFromFile(string $fileName, bool $force = false): array
    {
        set_time_limit(0);
        ini_set('memory_limit', '-1');

        $fileName = pathinfo(basename($fileName), PATHINFO_FILENAME);
        if (! in_array($fileName, $this->availableFiles(), true)) {
            $msg = "JSON import file '{$fileName}' is not available.";
            Log::error("[HadithJsonImport] {$msg}");

            return $this->result(false, $msg);
        }

        $path = database_path("hadees/{$fileName}.json");

        if (! file_exists($path)) {
            $msg = "JSON file not found: {$path}";
            Log::error("[HadithJsonImport] {$msg}");

            return $this->result(false, $msg);
        }

        $raw = file_get_contents($path);
        if ($raw === false) {
            $msg = "Failed to read JSON file: {$path}";
            Log::error("[HadithJsonImport] {$msg}");

            return $this->result(false, $msg);
        }

        $data = json_decode($raw, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            $msg = "JSON parse error in {$fileName}.json: " . json_last_error_msg();
            Log::error("[HadithJsonImport] {$msg}");

            return $this->result(false, $msg);
        }

        $metadata     = $data['metadata'] ?? null;
        $chaptersData = $data['chapters'] ?? [];
        $hadithsData  = $data['hadiths'] ?? [];

        if (! $metadata) {
            $msg = "Missing 'metadata' key in {$fileName}.json";
            Log::error("[HadithJsonImport] {$msg}");

            return $this->result(false, $msg);
        }

        $englishTitle = $metadata['english']['title'] ?? '';
        $bookSlug     = $this->fileToSlugMap[$fileName] ?? str()->slug($englishTitle);

        $log = HadithJsonImportLog::firstOrCreate(
            ['source_file' => $fileName],
            ['total_steps' => 3, 'success_steps' => [], 'failed_steps' => [], 'failed_items' => []]
        );

        if ($log->isCompleted() && ! $force) {
            $msg = "'{$fileName}.json' has already been fully imported.";
            Log::info("[HadithJsonImport] {$msg}");

            return array_merge($this->result(true, $msg), ['log' => $this->logToArray($log)]);
        }

        $log->update([
            'total_steps'   => 3,
            'success_steps' => [],
            'failed_steps'  => [],
            'failed_items'  => [],
            'status'        => 'in_progress',
            'started_at'    => now(),
            'completed_at'  => null,
        ]);

        Log::info('[HadithJsonImport] ' . ($force ? 'Re-importing' : 'Starting') . " '{$englishTitle}' (file: {$fileName}).");

        // ── 1. Book ───────────────────────────────────────────────────────
        try {
            [$bookModel, $bookResult] = $this->importBook($metadata, $bookSlug, $chaptersData, $hadithsData);

            if (! $bookModel) {
                return $this->failLog($log, 'book', $bookResult['message'] ?? 'Failed to import book.', $bookResult);
            }
            $this->completeStep($log, 'book', $bookModel->id);

            // ── 2. Chapters ───────────────────────────────────────────────────
            $chapterResult = $this->importChapters($bookModel, $chaptersData);
            $chapterIds    = $chapterResult['chapterIds']; // [ originalId => dbId ]
            $this->completeStep($log, 'chapters');

            // ── 3. Verses ─────────────────────────────────────────────────────
            $verseResult = $this->importVerses($bookModel, $hadithsData, $chapterIds);
            $this->completeStep($log, 'verses');

            $summary = "Import completed for '{$englishTitle}'. "
                . "Chapters — New: {$chapterResult['imported']}, Updated: {$chapterResult['updated']}. "
                . "Verses — New: {$verseResult['imported']}, Updated: {$verseResult['updated']}, Skipped: {$verseResult['skipped']}.";

            Log::info("[HadithJsonImport] {$summary}");
            $log->update(['status' => 'completed', 'completed_at' => now()]);

            $warnings = array_merge(
                $bookResult['warnings'] ?? [],
                $chapterResult['warnings'] ?? [],
                $verseResult['warnings'] ?? []
            );

            return array_merge($this->result(true, $summary), [
                'book'              => ['id' => $bookModel->id, 'slug' => $bookModel->slug, 'name' => $bookModel->name],
                'chapters_imported' => $chapterResult['imported'],
                'chapters_updated'  => $chapterResult['updated'],
                'verses_imported'   => $verseResult['imported'],
                'verses_updated'    => $verseResult['updated'],
                'skipped_count'     => $verseResult['skipped'],
                'warnings'          => $warnings,
                'log'               => $this->logToArray($log->fresh()),
            ]);
        } catch (\Throwable $e) {
            return $this->failLog($log, 'import', $e->getMessage());
        }
    }

    /**
     * Import all available JSON files listed in $fileToSlugMap.
     *
     * @param  array|null  $only  Optional whitelist of file names to process (e.g. ['malik','ahmed'])
     * @return array[] One result array per processed file, keyed by file name
     */
    public function importAll(?array $only = null): array
    {
        $files   = $only ?? $this->availableFiles();
        $results = [];

        foreach ($files as $fileName) {
            $results[$fileName] = $this->importFromFile($fileName);
        }

        return $results;
    }

    // -----------------------------------------------------------------------
    // Private helpers — Book
    // -----------------------------------------------------------------------

    /**
     * Upsert the HadithBook and its translations.
     *
     * @return array{0: HadithBook|null, 1: array}
     */
    private function importBook(array $metadata, string $bookSlug, array $chaptersData, array $hadithsData): array
    {
        $bookEn   = $this->bookTranslationsInfo[$bookSlug]['en'] ?? null;
        $bookAr   = $this->bookTranslationsInfo[$bookSlug]['ar'] ?? null;
        $metaId   = isset($metadata['id']) ? (int) $metadata['id'] + 2 : null;
        $warnings = [];

        if (! $bookEn && ! $bookAr) {
            $warn = "Book slug '{$bookSlug}' has no predefined translations in HadithJsonImportService::\$bookTranslationsInfo.";
            Log::warning("[HadithJsonImport] {$warn}");
            $warnings[] = $warn;
        }

        $bookAttributes = [
            'name'          => $bookAr['name'] ?? $metadata['arabic']['title'] ?? $bookSlug,
            'abbreviation'  => $bookEn['abbreviation'] ?? null,
            'writer'        => $bookAr['writer'] ?? $metadata['arabic']['author'] ?? null,
            'status'        => $bookEn['status'] ?? null,
            'group'         => $bookEn['group'] ?? null,
            'life_span'     => $bookEn['life_span'] ?? null,
            'chapter_count' => count($chaptersData),
            'hadith_count'  => count($hadithsData),
        ];

        try {
            DB::beginTransaction();

            $existingBook = HadithBook::where('slug', $bookSlug)->first();

            if ($existingBook) {
                $existingBook->update($bookAttributes);
                $bookModel = $existingBook->fresh();
                $action    = 'updated';
            } else {
                $attrs             = array_merge(['slug' => $bookSlug], $bookAttributes);
                $attrs['priority'] = (HadithBook::max('priority') ?? 0) + 1;

                // Honour JSON metadata ID only when it does not conflict with an existing row
                if ($metaId && ! HadithBook::where('id', $metaId)->exists()) {
                    $attrs['id'] = $metaId;
                }

                $bookModel = HadithBook::forceCreate($attrs);
                $action    = 'created';
            }

            // Upsert translations (en / ar / ml)
            if (isset($this->bookTranslationsInfo[$bookSlug])) {
                foreach ($this->bookTranslationsInfo[$bookSlug] as $lang => $tr) {
                    if (empty($tr['name'])) {
                        continue;
                    }

                    HadithBookTranslation::updateOrCreate(
                        ['hadith_book_id' => $bookModel->id, 'lang' => $lang],
                        [
                            'name'                => $tr['name'],
                            'writer'              => $tr['writer'] ?? null,
                            'life_span_romanized' => $tr['life_span'] ?? null,
                            'description'         => $tr['desc'] ?? null,
                            'created_by'          => 1,
                        ]
                    );
                }
            }

            DB::commit();

            Log::info("[HadithJsonImport] Book '{$bookSlug}' {$action} (DB id: {$bookModel->id}).");

            return [$bookModel, ['message' => "Book {$action}.", 'warnings' => $warnings]];

        } catch (\Throwable $e) {
            DB::rollBack();
            $msg = "Failed to upsert book '{$bookSlug}': " . $e->getMessage();
            Log::error("[HadithJsonImport] {$msg}", ['trace' => $e->getTraceAsString()]);

            return [null, ['message' => $msg, 'warnings' => $warnings]];
        }
    }

    // -----------------------------------------------------------------------
    // Private helpers — Chapters
    // -----------------------------------------------------------------------

    /**
     * Upsert chapters for the given book.
     *
     * @return array{imported:int, updated:int, skipped:int, warnings:string[], chapterIds:array<int,int>}
     */
    private function importChapters(HadithBook $book, array $chaptersData): array
    {
        $imported   = 0;
        $updated    = 0;
        $skipped    = 0;
        $warnings   = [];
        $chapterIds = []; // [ originalChapterId => dbChapterId ]
        $sort       = 1;

        foreach ($chaptersData as $index => $chapter) {
            $origId     = is_null($chapter['id']) ? 0 : (int) $chapter['id'];
            $arabicName = $chapter['arabic'] ?? '';
            $englishRaw = $chapter['english'] ?? '';

            if ($origId === 0 && empty($arabicName) && empty($englishRaw)) {
                $warn = "Chapter at index {$index} for book '{$book->slug}' has no ID or name. Skipping.";
                Log::warning("[HadithJsonImport] {$warn}");
                $warnings[] = $warn;
                $skipped++;
                $sort++;

                continue;
            }

            $slugText    = ! empty($englishRaw) ? $englishRaw : "chapter-{$origId}";
            $chapterSlug = str()->slug($slugText);

            try {
                DB::transaction(function () use (
                    $book, $origId, $arabicName, $englishRaw, $chapterSlug, $sort,
                    &$chapterIds, &$imported, &$updated
                ) {
                    $existing = HadithChapter::where('hadith_book_id', $book->id)
                        ->where('chapter_number', $origId)
                        ->first();

                    $attrs = [
                        'slug' => $chapterSlug,
                        'name' => $arabicName ?: ($englishRaw ?: "Chapter {$origId}"),
                        'sort' => $sort,
                    ];

                    if ($existing) {
                        $existing->update($attrs);
                        $chapterModel = $existing->fresh();
                        $updated++;
                    } else {
                        $chapterModel = HadithChapter::forceCreate(array_merge([
                            'hadith_book_id' => $book->id,
                            'chapter_number' => $origId,
                        ], $attrs));
                        $imported++;
                    }

                    $chapterIds[$origId] = $chapterModel->id;

                    // English chapter translation
                    if (! empty($englishRaw)) {
                        HadithChapterTranslation::updateOrCreate(
                            ['hadith_chapter_id' => $chapterModel->id, 'lang' => 'en'],
                            ['name' => $englishRaw, 'created_by' => 1]
                        );
                    }

                    // Arabic chapter translation
                    if (! empty($arabicName)) {
                        HadithChapterTranslation::updateOrCreate(
                            ['hadith_chapter_id' => $chapterModel->id, 'lang' => 'ar'],
                            ['name' => $arabicName, 'created_by' => 1]
                        );
                    }
                });
            } catch (\Throwable $e) {
                $warn = "Error upserting chapter {$origId} for book '{$book->slug}': " . $e->getMessage();
                Log::error("[HadithJsonImport] {$warn}", ['trace' => $e->getTraceAsString()]);
                $warnings[] = $warn;
                $skipped++;
            }

            $sort++;
        }

        Log::info("[HadithJsonImport] Chapters for '{$book->slug}' — New: {$imported}, Updated: {$updated}, Skipped: {$skipped}.");

        return compact('imported', 'updated', 'skipped', 'warnings', 'chapterIds');
    }

    // -----------------------------------------------------------------------
    // Private helpers — Verses
    // -----------------------------------------------------------------------

    /**
     * Upsert hadiths (verses) for the given book in memory-safe chunks of 500.
     *
     * @param  array<int,int>  $chapterIds  Map of originalChapterId => dbChapterId
     * @return array{imported:int, updated:int, skipped:int, warnings:string[]}
     */
    private function importVerses(HadithBook $book, array $hadithsData, array $chapterIds): array
    {
        $imported  = 0;
        $updated   = 0;
        $skipped   = 0;
        $warnings  = [];
        $chunkSize = 500;

        $verseChunk       = [];
        $translationChunk = [];
        $now              = now();

        foreach ($hadithsData as $index => $hadith) {
            $hadithId   = isset($hadith['id']) ? (int) $hadith['id'] : null;
            $origChapId = isset($hadith['chapterId']) ? (int) $hadith['chapterId'] : 0;

            if (! $hadithId) {
                $warn = "Hadith at index {$index} for book '{$book->slug}' is missing 'id'. Skipping.";
                Log::warning("[HadithJsonImport] {$warn}");
                $warnings[] = $warn;
                $skipped++;

                continue;
            }

            $dbChapterId = $chapterIds[$origChapId] ?? null;

            if (! $dbChapterId) {
                $warn = "Hadith #{$hadithId}: chapter ID {$origChapId} not found in chapter map. Skipping.";
                Log::warning("[HadithJsonImport] {$warn}");
                $warnings[] = $warn;
                $skipped++;

                continue;
            }

            $arabicText = $hadith['arabic'] ?? null;
            $enData     = $hadith['english'] ?? [];
            $enText     = $enData['text'] ?? null;
            $narrator   = $enData['narrator'] ?? null;

            if (empty($arabicText) && empty($enText)) {
                $warn = "Hadith #{$hadithId}: both Arabic and English text are empty. Skipping.";
                Log::warning("[HadithJsonImport] {$warn}");
                $warnings[] = $warn;
                $skipped++;

                continue;
            }

            $hadithNumber = (int) ($hadith['idInBook'] ?? $hadithId);
            $exists       = HadithVerse::where('hadith_book_id', $book->id)
                ->where('hadith_chapter_id', $dbChapterId)
                ->where('hadith_number', $hadithNumber)
                ->exists();

            $verseChunk[] = [
                'hadith_book_id'    => $book->id,
                'hadith_chapter_id' => $dbChapterId,
                'chapter_number'    => $origChapId,
                'hadith_number'     => $hadithNumber,
                'text'              => $arabicText,
                'is_active'         => 1,
                'created_at'        => $now,
                'updated_at'        => $now,
            ];

            if ($enText) {
                $translationChunk[] = [
                    'hadith_chapter_id' => $dbChapterId,
                    'hadith_number'     => $hadithNumber,
                    'lang'              => 'en',
                    'narrator'          => $narrator,
                    'text'              => $enText,
                    'is_active'         => 1,
                    'created_by'        => 1,
                    'created_at'        => $now,
                    'updated_at'        => $now,
                ];
            } else {
                $warn = "Hadith #{$hadithId}: no English translation text available.";
                Log::warning("[HadithJsonImport] {$warn}");
                $warnings[] = $warn;
            }

            $exists ? $updated++ : $imported++;

            if (count($verseChunk) >= $chunkSize) {
                $this->flushVerseChunk($verseChunk, $translationChunk, $book->slug, $warnings);
                $verseChunk       = [];
                $translationChunk = [];
                gc_collect_cycles();
            }
        }

        // Flush any remaining rows
        if (! empty($verseChunk)) {
            $this->flushVerseChunk($verseChunk, $translationChunk, $book->slug, $warnings);
        }

        Log::info("[HadithJsonImport] Verses for '{$book->slug}' — New: {$imported}, Updated: {$updated}, Skipped: {$skipped}.");

        return compact('imported', 'updated', 'skipped', 'warnings');
    }

    /**
     * Persist a chunk of verse + translation rows inside a single transaction.
     * Uses updateOrInsert (MySQL ON DUPLICATE KEY UPDATE equivalent) to handle re-runs safely.
     */
    private function flushVerseChunk(
        array $verseChunk,
        array $translationChunk,
        string $bookSlug,
        array &$warnings
    ): void {
        try {
            DB::transaction(function () use ($verseChunk, $translationChunk) {
                foreach ($verseChunk as $row) {
                    $key = [
                        'hadith_book_id'    => $row['hadith_book_id'],
                        'hadith_chapter_id' => $row['hadith_chapter_id'],
                        'hadith_number'     => $row['hadith_number'],
                    ];
                    $values = array_diff_key($row, array_flip(array_keys($key)));
                    HadithVerse::updateOrInsert($key, $values);
                }

                foreach ($translationChunk as $tr) {
                    $verse = HadithVerse::where('hadith_book_id', $verseChunk[0]['hadith_book_id'])
                        ->where('hadith_chapter_id', $tr['hadith_chapter_id'])
                        ->where('hadith_number', $tr['hadith_number'])
                        ->firstOrFail();

                    $key    = ['hadith_verse_id' => $verse->id, 'lang' => $tr['lang']];
                    $values = array_diff_key(
                        $tr,
                        array_flip(['hadith_chapter_id', 'hadith_number', 'lang'])
                    );
                    HadithVerseTranslation::updateOrInsert($key, $values);
                }
            });
        } catch (\Throwable $e) {
            $msg = "Chunk flush failed for book '{$bookSlug}': " . $e->getMessage();
            Log::error("[HadithJsonImport] {$msg}", ['trace' => $e->getTraceAsString()]);
            $warnings[] = $msg;
        }
    }

    // -----------------------------------------------------------------------
    // Response builder
    // -----------------------------------------------------------------------

    private function result(bool $status, string $message = '', array $extra = []): array
    {
        return array_merge([
            'status'            => $status,
            'message'           => $message,
            'book'              => null,
            'chapters_imported' => 0,
            'chapters_updated'  => 0,
            'verses_imported'   => 0,
            'verses_updated'    => 0,
            'skipped_count'     => 0,
            'warnings'          => [],
        ], $extra);
    }

    /**
     * Return only JSON files that are present in database/hadees.
     *
     * @return string[]
     */
    public function availableFiles(): array
    {
        $paths = glob(database_path('hadees/*.json')) ?: [];

        return collect($paths)
            ->map(fn(string $path) => pathinfo($path, PATHINFO_FILENAME))
            ->sort()
            ->values()
            ->all();
    }

    public function logToArray(HadithJsonImportLog $log): array
    {
        return [
            'id'            => $log->id,
            'source_file'   => $log->source_file,
            'book_id'       => $log->hadith_book_id,
            'total_steps'   => $log->total_steps,
            'success_count' => $log->successCount(),
            'failed_count'  => $log->failedCount(),
            'progress'      => $log->progressPercent(),
            'status'        => $log->status,
            'failed_steps'  => $log->failed_steps ?? [],
            'failed_items'  => $log->failed_items ?? [],
            'started_at'    => $log->started_at?->toDateTimeString(),
            'completed_at'  => $log->completed_at?->toDateTimeString(),
        ];
    }

    private function completeStep(HadithJsonImportLog $log, string $step, ?int $bookId = null): void
    {
        $success = array_values(array_unique(array_merge($log->success_steps ?? [], [$step])));
        $failed  = array_values(array_filter($log->failed_steps ?? [], fn(string $item) => $item !== $step));

        $log->update(array_filter([
            'hadith_book_id' => $bookId,
            'success_steps'  => $success,
            'failed_steps'   => $failed,
        ], fn($value) => $value !== null));
        $log->refresh();
    }

    private function failLog(HadithJsonImportLog $log, string $step, string $message, array $extra = []): array
    {
        $failedSteps   = array_values(array_unique(array_merge($log->failed_steps ?? [], [$step])));
        $failedItems   = $log->failed_items ?? [];
        $failedItems[] = ['step' => $step, 'reason' => $message];

        $log->update([
            'failed_steps' => $failedSteps,
            'failed_items' => $failedItems,
            'status'       => 'failed',
            'completed_at' => null,
        ]);

        Log::error("[HadithJsonImport] {$message}");

        return array_merge($this->result(false, $message, $extra), ['log' => $this->logToArray($log->fresh())]);
    }
}
