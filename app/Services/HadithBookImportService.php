<?php
namespace App\Services;

use App\Models\HadithBook;
use App\Models\HadithBookTranslation;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HadithBookImportService
{
    public function __construct(protected ApiService $apiService)
    {}

    /**
     * Predefined translations map for known Hadith books.
     */
    protected array $bookTranslations = [
        'sahih-bukhari' => [
            'en' => [
                'name'         => 'Sahih al-Bukhari',
                'writer'       => 'Muhammad ibn Ismail al Bukhari',
                'life_span'    => '194-256 AH',
                'status'       => 'sahih',
                'abbreviation' => 'SB',
                'desc'         => 'The most authentic book after the Quran, arranged by legal & theological topics.',
                'group'        => 'Kutub al-Sittah',
            ],
            'ar' => [
                'name' => 'صحيح البخاري', 'writer' => 'محمد بن إسماعيل البخاري', 'life_span' => '194-256 هـ',
            ],
            'ml' => [
                'name'      => 'സ്വഹീഹ് അൽ-ബുഖാരി',
                'writer'    => 'മുഹമ്മദ് ബിൻ ഇസ്മായിൽ അൽ ബുഖാരി',
                'life_span' => '194-256 ഹി',
            ],
        ],
        'sahih-muslim'  => [
            'en' => [
                'name'         => 'Sahih Muslim',
                'writer'       => 'Muslim ibn al-Hajjaj al-Naysaburi',
                'desc'         => 'Renowned for its rigorous thematic organization and preservation of narration variants.',
                'status'       => 'sahih',
                'abbreviation' => 'SM',
                'group'        => 'Kutub al-Sittah',
                'life_span'    => '204-261 AH',
            ],
            'ar' => [
                'name' => 'صحيح مسلم', 'writer' => 'مسلم بن الحجاج النيسابوري', 'life_span' => '204-261 هـ',
            ],
            'ml' => [
                'name'      => 'സഹീഹ് മുസ്ലിം',
                'writer'    => 'മുസ്ലീം ഇബ്നു അൽ-ഹജ്ജാജ് അൽ-നൈസബൂരി',
                'life_span' => '204-261 ഹി',
            ],
        ],
        'al-tirmidhi'   => [
            'en' => [
                'name'         => 'Jami Al-Tirmidhi',
                'writer'       => 'Abu Isa Muhammad ibn Isa al-Tirmidhi',
                'desc'         => "Renowned for grading Hadith gradations (Sahih, Hasan, Da'if) and noting jurisprudential differences.",
                'status'       => 'jami',
                'abbreviation' => 'JAT',
                'group'        => 'Kutub al-Sittah',
                'life_span'    => '209-279 AH',
            ],
            'ar' => [
                'name' => 'جامع الترمذي', 'writer' => 'أبو عيسى محمد بن عيسى الترمذي', 'life_span' => '209-279 هـ',
            ],
            'ml' => [
                'name'      => 'ജാമി അൽ-തിർമിധി',
                'writer'    => 'അബു ഈസാ മുഹമ്മദ് ഇബ്‌നു ഈസാ അൽ-തിർമിദി',
                'life_span' => '209-279 ഹി',
            ],
        ],
        'abu-dawood'    => [
            'en' => [
                'name'         => 'Sunan Abu Dawood',
                'writer'       => "Abu Dawud Sulayman ibn al-Ash'ath al-Sijistani",
                'desc'         => 'Centered heavily upon legal rulings (Ahkam) and legislative traditions.',
                'status'       => 'sunan',
                'abbreviation' => 'SAD',
                'group'        => 'Kutub al-Sittah',
                'life_span'    => '202-275 AH',
            ],
            'ar' => [
                'name' => 'سنن أبو داود', 'writer' => "أبو داود سليمان بن الأشعث السجستاني", 'life_span' => '202-275 هـ',
            ],
            'ml' => [
                'name'      => 'സുനാൻ അബു ദാവൂദ്',
                'writer'    => "അബു ദാവൂദ് സുലൈമാൻ ഇബ്നു അൽ-അശ്അത്ത് അൽ-സിജിസ്ഥാനി",
                'life_span' => '202-275 ഹി',
            ],
        ],
        'ibn-e-majah'   => [
            'en' => [
                'name'         => 'Sunan Ibn Majah',
                'writer'       => 'Muhammad ibn Yazīd Ibn Majah',
                'desc'         => "Features clear legal structure with numerous unique narrations (Zawa'id).",
                'status'       => 'sunan',
                'abbreviation' => 'SIM',
                'group'        => 'Kutub al-Sittah',
                'life_span'    => '209-273 AH',
            ],
            'ar' => [
                'name' => 'سنن ابن ماجه', 'writer' => 'محمد بن يزيد بن ماجه', 'life_span' => '209-273 هـ',
            ],
            'ml' => [
                'name'      => 'സുനാൻ ഇബ്‍ൻ മാജഹ്',
                'writer'    => 'മുഹമ്മദ് ബിൻ യസീദ് ഇബ്ന്‍ മാജഹ്',
                'life_span' => '209-273 ഹി',
            ],
        ],
        'sunan-nasai'   => [
            'en' => [
                'name'         => "Sunan an-Nasa'i",
                'writer'       => "Ahmad ibn Shu'ayb al-Nasa'i",
                'desc'         => "Distinguished by strict authentication criteria second only to the two Sahihs.",
                'status'       => 'sunan',
                'abbreviation' => 'SAN',
                'group'        => 'Kutub al-Sittah',
                'life_span'    => '214-303 AH',
            ],
            'ar' => [
                'name' => 'سنن النسائي', 'writer' => 'أحمد بن شعيب النسائي', 'life_span' => '214-303 هـ',
            ],
            'ml' => [
                'name'      => 'സുനാൻ അൽ-നസാഈ',
                'writer'    => 'അഹ്മദ് ഇബ്നു ശുഐബ് അൽ-നസാഇ',
                'life_span' => '214-303 ഹി',
            ],
        ],
        'mishkat'       => [
            'en' => [
                'name'         => 'Mishkat al-Masabih',
                'writer'       => 'Muhammad ibn Abdallah al-Khatib al-Tabrizi',
                'desc'         => "Mishkat al-Masabih is a comprehensive hadith collection that brings together narrations on faith, worship, manners, virtues, and various aspects of Islamic life, organized thematically.",
                'status'       => 'collection',
                'abbreviation' => 'MAM',
                'group'        => 'Thematic',
                'life_span'    => 'd. 741 AH',
            ],
            'ar' => [
                'name' => 'مشکاة المصابیح', 'writer' => 'محمد بن عبد الله الخطيب التبريزي', 'life_span' => 'd. 741 هـ',
            ],
            'ml' => [
                'name'      => 'മിഷ്കാത്ത് അൽ-മസാബിഹ്',
                'writer'    => 'മുഹമ്മദ് ഇബ്ൻ അബ്ദല്ല അൽ ഖത്തീബ് അൽ തബ്രിസി',
                'life_span' => 'd. 741 AH',
            ],
        ],
    ];

    /**
     * Import Hadith books from the external API with comprehensive logging.
     *
     * @return array
     */
    public function importBooks(): array
    {
        $apiKey  = config('services.hadith.api_key');
        $baseUrl = config('services.hadith.books');

        if (empty($apiKey) || empty($baseUrl)) {
            $msg = 'Hadith API key or books URL is missing in configuration.';
            Log::error("[HadithBookImport] {$msg}");
            return ['status' => false, 'message' => $msg];
        }

        $url      = str_replace('{api_key}', $apiKey, $baseUrl);
        $response = $this->apiService->get($url);

        if (Arr::get($response, 'status') !== 200) {
            $msg = 'Failed to fetch Hadith books from API. Response status: ' . Arr::get($response, 'status', 'Unknown') . '. Message: ' . Arr::get($response, 'message', 'No details');
            Log::error("[HadithBookImport] {$msg}");
            return ['status' => false, 'message' => $msg];
        }

        $booksData = Arr::get($response, 'result.books', []);

        if (empty($booksData) || ! is_array($booksData)) {
            $msg = 'No books found in API response.';
            Log::error("[HadithBookImport] {$msg}", ['response' => $response]);
            return ['status' => false, 'message' => $msg];
        }

        $importedCount = 0;
        $updatedCount  = 0;
        $skippedCount  = 0;
        $warnings      = [];
        $priority      = 1;

        try {
            DB::transaction(function () use ($booksData, &$importedCount, &$updatedCount, &$skippedCount, &$warnings, &$priority) {
                foreach ($booksData as $index => $book) {
                    $slug          = $book['bookSlug'] ?? null;
                    $hadithsCount  = isset($book['hadiths_count']) ? (int) $book['hadiths_count'] : 0;
                    $chaptersCount = isset($book['chapters_count']) ? (int) $book['chapters_count'] : 0;
                    $bookName      = $book['bookName'] ?? null;
                    $writerName    = $book['writerName'] ?? null;
                    $bookId        = $book['id'] ?? null;

                    // Log missing mandatory data warnings
                    if (empty($slug)) {
                        $warn = "Book entry at index {$index} missing 'bookSlug'. Skipping.";
                        Log::warning("[HadithBookImport] {$warn}", ['book_data' => $book]);
                        $warnings[] = $warn;
                        $skippedCount++;
                        continue;
                    }

                    if (empty($bookName)) {
                        $warn = "Book with slug '{$slug}' missing 'bookName'. Using fallback.";
                        Log::warning("[HadithBookImport] {$warn}");
                        $warnings[] = $warn;
                    }

                    if ($hadithsCount <= 0) {
                        $warn = "Book '{$slug}' has 0 hadiths count. Skipping.";
                        Log::warning("[HadithBookImport] {$warn}");
                        $warnings[] = $warn;
                        $skippedCount++;
                        continue;
                    }

                    $bookEng = $this->bookTranslations[$slug]['en'] ?? null;
                    $bookAr  = $this->bookTranslations[$slug]['ar'] ?? null;

                    if (! $bookEng && ! $bookAr) {
                        $warn = "Book with slug '{$slug}' does not have predefined translations in HadithBookImportService.";
                        Log::warning("[HadithBookImport] {$warn}");
                        $warnings[] = $warn;
                    }

                    $bookAttributes = [
                        'name'          => $bookAr['name'] ?? $bookName ?? $slug,
                        'abbreviation'  => $bookEng['abbreviation'] ?? null,
                        'writer'        => $bookAr['writer'] ?? $writerName ?? null,
                        'status'        => $bookEng['status'] ?? null,
                        'group'         => $bookEng['group'] ?? null,
                        'life_span'     => $bookEng['life_span'] ?? null,
                        'chapter_count' => $chaptersCount,
                        'hadith_count'  => $hadithsCount,
                        'priority'      => $priority++,
                    ];

                    if ($bookId) {
                        $bookAttributes['id'] = $bookId;
                    }

                    $existingBook = HadithBook::where('slug', $slug)->first();
                    if ($existingBook) {
                        // $existingBook->update($bookAttributes);
                        $existingBook->forceFill($bookAttributes);
                        $existingBook->save();

                        $hadithBook = $existingBook;
                        $updatedCount++;
                    } else {
                        $hadithBook = HadithBook::forceCreate(array_merge(['slug' => $slug], $bookAttributes));
                        $importedCount++;
                    }

                    // Process Translations
                    if (isset($this->bookTranslations[$slug])) {
                        foreach ($this->bookTranslations[$slug] as $lang => $translation) {
                            if (empty($translation['name'])) {
                                $warn = "Translation for book '{$slug}' in lang '{$lang}' missing 'name'.";
                                Log::warning("[HadithBookImport] {$warn}");
                                $warnings[] = $warn;
                                continue;
                            }

                            HadithBookTranslation::updateOrCreate(
                                [
                                    'hadith_book_id' => $hadithBook->id,
                                    'lang'           => $lang,
                                ],
                                [
                                    'name'                => $translation['name'],
                                    'writer'              => $translation['writer'] ?? null,
                                    'life_span_romanized' => $translation['life_span'] ?? null,
                                    'description'         => $translation['desc'] ?? null,
                                    'created_by'          => 1,
                                ]
                            );
                        }
                    }
                }
            });

            $summary = "Hadith books import completed. New: {$importedCount}, Updated: {$updatedCount}, Skipped: {$skippedCount}, Warnings: " . count($warnings);
            Log::info("[HadithBookImport] {$summary}", ['warnings' => $warnings]);

            return [
                'status'  => true,
                'message' => "Import completed successfully! (New: {$importedCount}, Updated: {$updatedCount}, Skipped: {$skippedCount})",
                'imported_count' => $importedCount,
                'updated_count' => $updatedCount,
                'skipped_count' => $skippedCount,
                'warnings' => $warnings,
            ];
        } catch (\Throwable $e) {
            $msg = 'An error occurred during Hadith books database transaction: ' . $e->getMessage();
            Log::error("[HadithBookImport] {$msg}", ['trace' => $e->getTraceAsString()]);
            return ['status' => false, 'message' => $msg];
        }
    }
}
