<?php
namespace Database\Seeders;

use App\Models\HadithBook;
use App\Models\HadithBookTranslation;
use App\Models\HadithChapter;
use App\Models\HadithChapterTranslation;
use App\Models\HadithVerse;
use App\Models\HadithVerseTranslation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HadithVerseJsonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bookTranslationsInfo = [
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
                    'desc'         => "A major hadith collection arranged by subject, covering jurisprudence, worship, manners, and other aspects of the Sunnah.",
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
                    'writer'       => "Yahya ibn Sharaf al-Nawawi",
                    'desc'         => 'Focusing on worship, manners, ethics, spirituality, and righteous conduct',
                    'status'       => 'collection',
                    'abbreviation' => 'RAS',
                    'group'        => 'Thematic',
                    'life_span'    => '631-676 AH',
                ],
                'ar' => [
                    'name' => 'رياض الصالحين', 'writer' => "يحيى بن شرف النواوي", 'life_span' => '631-676 هـ',
                ],
                'ml' => [
                    'name'      => 'റിയാദ് അസ്-സാലിഹിൻ',
                    'writer'    => "യഹ്യ ഇബ്നു ഷാറഫ് അൽ-നവവി",
                    'life_span' => '631-676 ഹി',
                ],
            ],
        ];

        set_time_limit(0);             // safer than -1 in some environments
        ini_set('memory_limit', '-1'); // Unlimited memory

        $db = [
            'malik', 'ahmed', 'darimi', 'riyad_assalihin',
            // 'nawawi40', 'qudsi40', 'shahwaliullah40', 'aladab_almufrad', 'shamail_muhammadiyah', 'bulugh_almaram',
        ];

        $priority = HadithBook::max('priority') ?? 0;
        foreach ($db as $value) {
            $data   = database_path("hadees/{$value}.json");
            $result = json_decode(file_get_contents($data), true);

            $metadata     = $result['metadata'];
            $chaptersData = $result['chapters'];
            $hadithsData  = $result['hadiths'];
            $bookId       = (int) $metadata['id'] + 2;
            $now          = now();

            try {
                $bookSlug            = str()->slug($metadata['english']['title']);
                $chapters            = [];
                $chapterTranslations = [];
                $bookTranslations    = [];

                $bookEn = $bookTranslationsInfo[$bookSlug]['en'] ?? null;
                $bookAr = $bookTranslationsInfo[$bookSlug]['ar'] ?? null;

                $books = [
                    [
                        'id'            => $bookId,
                        'name'          => $bookAr['name'] ?? $metadata['arabic']['title'],
                        'abbreviation'  => $bookEn['abbreviation'] ?? null,
                        'slug'          => $bookSlug,
                        'writer'        => $bookAr['writer'] ?? $metadata['arabic']['author'] ?? null,
                        'status'        => $bookEn['status'] ?? null,
                        'group'         => $bookEn['group'] ?? null,
                        'life_span'     => $bookEn['life_span'] ?? null,
                        'chapter_count' => (int) count($chaptersData),
                        'hadith_count'  => (int) count($hadithsData),
                        'priority'      => ++$priority,
                        'created_at'    => $now,
                        'updated_at'    => $now,
                    ],
                ];

                if (isset($bookTranslationsInfo[$bookSlug])) {
                    foreach ($bookTranslationsInfo[$bookSlug] as $lang => $tr) {
                        $bookTranslations[] = [
                            'hadith_book_id'      => $bookId,
                            'lang'                => $lang,
                            'name'                => $tr['name'],
                            'writer'              => $tr['writer'] ?? null,
                            'life_span_romanized' => $tr['life_span'] ?? null,
                            'description'         => $tr['desc'] ?? null,
                            'created_by'          => 1,
                            'created_at'          => $now,
                            'updated_at'          => $now,
                        ];
                    }
                }

                $chapterId  = HadithChapter::max('id');
                $chapterIds = [];

                $sort = 1;
                foreach ($chaptersData as $chapter) {
                    $chapter['id']              = is_null($chapter['id']) ? 0 : (int) $chapter['id'];
                    $chapterId                  = $chapterId + 1;
                    $chapterIds[$chapter['id']] = $chapterId;
                    $chapterSlug                = str()->slug(empty($chapter['english']) ? 'chapter-' . $chapter['id'] : $chapter['english']);

                    $chapters[] = [
                        'id'             => $chapterId,
                        'hadith_book_id' => $bookId,
                        'chapter_number' => $chapter['id'],
                        'name'           => $chapter['arabic'] ?? '',
                        'slug'           => $chapterSlug,
                        'sort'           => $sort++,
                        'created_at'     => $now,
                        'updated_at'     => $now,
                    ];

                    if (! empty($chapter['english'])) {
                        $chapterTranslations[] = [
                            'hadith_chapter_id' => $chapterId,
                            'lang'              => 'en',
                            'name'              => $chapter['english'] ?? '',
                            'created_by'        => 1,
                            'created_at'        => $now,
                            'updated_at'        => $now,
                        ];
                    }
                }

                DB::transaction(function () use ($books, $bookTranslations, $chapters, $chapterTranslations) {
                    HadithBook::insert($books);
                    HadithBookTranslation::insert($bookTranslations);

                    HadithChapter::insert($chapters);
                    HadithChapterTranslation::insert($chapterTranslations);
                });

                $this->command->info("Hadith Book and Chapters of `{$metadata['english']['title']}` Json seeding completed at: {$now->toDateTimeString()}");
            } catch (\Throwable $e) {
                $this->command->error("Error fetching Book and Chapters: `{$metadata['english']['title']}`" . $e->getMessage());
                Log::error("Error fetching Book and Chapters: `{$metadata['english']['title']}`" . $e->getMessage());
                return;
            }

            try {
                $hadiths            = [];
                $hadithTranslations = [];
                $chunkSize          = 500;
                $hadithId           = HadithVerse::max('id');

                foreach ($hadithsData as $hadith) {
                    $hadithId = $hadithId + 1;

                    $hadiths[] = [
                        'id'                => $hadithId,
                        'hadith_book_id'    => $bookId,
                        'hadith_chapter_id' => $chapterIds[$hadith['chapterId'] ?? 0],
                        'chapter_number'    => $hadith['chapterId'],
                        'hadith_number'     => (int) $hadith['idInBook'],
                        'text'              => $hadith['arabic'],
                        'is_active'         => 1,
                        'created_at'        => $now,
                        'updated_at'        => $now,
                    ];

                    $hadithTranslations[] = [
                        'hadith_verse_id' => $hadithId,
                        'lang'            => 'en',
                        'narrator'        => $hadith['english']['narrator'],
                        'text'            => $hadith['english']['text'],
                        'is_active'       => 1,
                        'created_by'      => 1,
                        'created_at'      => $now,
                        'updated_at'      => $now,
                    ];

                    if (count($hadiths) == $chunkSize) {
                        DB::transaction(function () use ($hadiths, $hadithTranslations) {
                            HadithVerse::insert($hadiths);
                            HadithVerseTranslation::insert($hadithTranslations);
                        });

                        $hadiths            = [];
                        $hadithTranslations = [];
                    }
                }

                if (! empty($hadiths)) {
                    DB::transaction(function () use ($hadiths, $hadithTranslations) {
                        HadithVerse::insert($hadiths);
                        HadithVerseTranslation::insert($hadithTranslations);
                    });
                }

                $this->command->info("Hadith verses of `{$metadata['english']['title']}` Json seeding completed at: {$now->toDateTimeString()}");
            } catch (\Exception $e) {
                $this->command->error("Error fetching hadiths: `{$metadata['english']['title']}`" . $e->getMessage());
                Log::error("Error fetching hadiths: `{$metadata['english']['title']}`" . $e->getMessage());
                return;
            }
        }

    }
}
