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
        set_time_limit(0);             // safer than -1 in some environments
        ini_set('memory_limit', '-1'); // Unlimited memory

        $booksMl = [
            ["id" => 7, "name" => "മുവത്ത മാലിക്", "writer" => "ഇമാം മാലിക് ഇബ്നു അനസ്"],
            ["id" => 8, "name" => "മുസ്നദ് അഹമ്മദ് ഇബ്നു ഹമ്പൽ", "writer" => "ഇമാം അഹമ്മദ് ഇബ്നു ഹമ്പൽ"],
            ["id" => 9, "name" => "സുനൻ അൽ-ദാരിമി", "writer" => "ഇമാം അബു മുഹമ്മദ് അബ്ദുൽ റഹ്മാൻ ഇബ്നു അബ്ദുൾ അള്ളാ ഇബ്നു അൽ ദാരിമി"],
            ["id" => 10, "name" => "ഇമാം നവവിയുടെ നാൽപ്പത് ഹദീസ്", "writer" => "ഇമാം യഹ്യ ഇബ്നു ഷറഫ് അൽ നവവി"],
            ["id" => 11, "name" => "നാൽപ്പത് ഖുദ്‌സി ഹദീസുകൾ", "writer" => ""],
            ["id" => 12, "name" => "ഷാ വലിയുല്ലയുടെ നാൽപ്പത് ഹദീസ്", "writer" => "ഷാ വലിയുല്ലാഹ് ദഹ്‌ലവി"],
            ["id" => 13, "name" => "റിയാദ് അസ്-സാലിഹിൻ", "writer" => "ഇമാം യഹ്യ ഇബ്നു ഷറഫ് അൽ നവവി"],
            ["id" => 14, "name" => "മിഷ്കത് അൽ-മസാബിഹ്", "writer" => "അൽ-ഖാത്തിബ് അൽ-തബ്രിസി"],
            ["id" => 15, "name" => "അൽ-അദബ് അൽ-മുഫ്രദ്", "writer" => "ഇമാം മുഹമ്മദ് ഇബ്നു ഇസ്മാഈൽ അൽ ബുഖാരി"],
            ["id" => 16, "name" => "ഷമാ'ഇൽ മുഹമ്മദിയ", "writer" => "ഇമാം തിർമിദി"],
            ["id" => 17, "name" => "ബുലുഗ് അൽ-മറം", "writer" => "ഇബ്നു ഹജർ അൽ-അസ്കലാനി"],
        ];

        $db = ['malik', 'ahmed', 'darimi', 'nawawi40', 'qudsi40', 'shahwaliullah40', 'riyad_assalihin', 'aladab_almufrad', 'shamail_muhammadiyah', 'bulugh_almaram'];

        foreach ($db as $value) {
            $data   = database_path("hadees/{$value}.json");
            $result = json_decode(file_get_contents($data), true);

            $metadata     = $result['metadata'];
            $chaptersData = $result['chapters'];
            $hadithsData  = $result['hadiths'];
            $bookMl       = array_column($booksMl, null, 'id');
            $bookId       = (int) $metadata['id'] + 2;
            $now          = now();

            try {
                $chapters            = [];
                $chapterTranslations = [];
                $bookTranslations    = [];

                $books = [
                    [
                        'id'            => $bookId,
                        'name'          => $metadata['arabic']['title'],
                        'slug'          => str()->slug($metadata['english']['title']),
                        'writer'        => $metadata['arabic']['author'] ?? null,
                        'chapter_count' => (int) count($chaptersData),
                        'hadith_count'  => (int) count($hadithsData),
                        'created_at'    => $now,
                        'updated_at'    => $now,
                    ],
                ];

                $bookTranslations[] = [
                    'hadith_book_id' => $bookId,
                    'lang'           => 'en',
                    'name'           => $metadata['english']['title'],
                    'writer'         => $metadata['english']['author'],
                    'created_by'     => 1,
                    'created_at'     => $now,
                    'updated_at'     => $now,
                ];

                if (isset($bookMl[$metadata['id']])) {
                    $found = $bookMl[$metadata['id']];

                    $bookTranslations[] = [
                        'hadith_book_id' => $bookId,
                        'lang'           => 'ml',
                        'name'           => $found['name'],
                        'writer'         => $found['writer'] ?? null,
                        'created_by'     => 1,
                        'created_at'     => $now,
                        'updated_at'     => $now,
                    ];
                }

                $chapterId  = HadithChapter::max('id');
                $chapterIds = [];

                foreach ($chaptersData as $chapter) {
                    $chapter['id']              = is_null($chapter['id']) ? 0 : (int) $chapter['id'];
                    $chapterId                  = $chapterId + 1;
                    $chapterIds[$chapter['id']] = $chapterId;

                    $chapters[] = [
                        'id'             => $chapterId,
                        'hadith_book_id' => $bookId,
                        'chapter_number' => $chapter['id'],
                        'name'           => $chapter['arabic'] ?? '',
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
