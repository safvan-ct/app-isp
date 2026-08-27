<?php
namespace Database\Seeders;

use App\Models\HadithBook;
use App\Models\HadithBookTranslation;
use App\Services\ApiService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class HadithBookSeeder extends Seeder
{
    public function __construct(protected ApiService $apiService)
    {}

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bookTranslations = [
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
                    'writer'       => 'Imam Muslim ibn al-Hajjaj al-Naysaburi',
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
                    'writer'       => 'Imam Abu Isa Muhammad ibn Isa al-Tirmidhi',
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
                    'group'        => 'General',
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

        if (HadithBook::exists()) {
            $this->command->warn('Hadith books already exist.');
            return;
        }

        try {
            $apiKey = config('services.hadith.api_key');
            $url    = str_replace('{api_key}', $apiKey, config('services.hadith.books'));

            $response = $this->apiService->get($url);

            if (Arr::get($response, 'status') !== 200) {
                throw new \Exception('Invalid response status');
            }

            $booksData = Arr::get($response, 'result.books', []);

            if (empty($booksData)) {
                throw new \Exception('No books found in API response');
            }

            $now          = now();
            $books        = [];
            $translations = [];

            $priority = 1;
            foreach ($booksData as $book) {
                if (empty($book['hadiths_count'])) {
                    continue; // Skip books with 0 hadiths
                }

                $bookId  = $book['id'];
                $bookEng = $bookTranslations[$book['bookSlug']]['en'] ?? null;
                $bookAr  = $bookTranslations[$book['bookSlug']]['ar'] ?? null;

                $books[] = [
                    'id'            => $bookId,
                    'name'          => $bookAr['name'] ?? $book['bookName'],
                    'slug'          => $book['bookSlug'],
                    'abbreviation'  => $bookEng['abbreviation'] ?? null,
                    'writer'        => $bookAr['writer'] ?? $book['writerName'] ?? null,
                    'status'        => $bookEng['status'] ?? null,
                    'group'         => $bookEng['group'] ?? null,
                    'life_span'     => $bookEng['life_span'] ?? null,
                    'chapter_count' => (int) ($book['chapters_count'] ?? 0),
                    'hadith_count'  => (int) $book['hadiths_count'],
                    'priority'      => $priority++,
                    'created_at'    => $now,
                    'updated_at'    => $now,
                ];

                if (isset($bookTranslations[$book['bookSlug']])) {
                    foreach ($bookTranslations[$book['bookSlug']] as $lang => $translation) {
                        $translations[] = [
                            'hadith_book_id'      => $bookId,
                            'lang'                => $lang,
                            'name'                => $translation['name'],
                            'writer'              => $translation['writer'] ?? null,
                            'life_span_romanized' => $translation['life_span'] ?? null,
                            'description'         => $translation['description'] ?? null,
                            'created_by'          => 1,
                            'created_at'          => $now,
                            'updated_at'          => $now,
                        ];
                    }
                }
            }

            DB::transaction(function () use ($books, $translations) {
                HadithBook::insert($books);
                HadithBookTranslation::insert($translations);
            });

            $this->command->info('Hadith books seeded successfully.');
        } catch (\Throwable $e) {
            $this->command->error('Failed to seed Hadith books: ' . $e->getMessage());
        }
    }
}
