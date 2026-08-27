<?php
namespace Database\Seeders;

use App\Models\HadithBook;
use App\Models\HadithChapter;
use App\Models\HadithChapterTranslation;
use App\Services\ApiService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HadithChapterSeeder extends Seeder
{
    public function __construct(protected ApiService $apiService)
    {}

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = HadithBook::with('chapters')->select(['id', 'slug'])->get();

        foreach ($books as $book) {
            if ($book->chapters()->exists()) {
                $this->command->info("Chapters for book `{$book->slug}` already exist. Skipping.");
                continue;
            }

            $apiKey = config('services.hadith.api_key');
            $url    = str_replace(
                ['{book_slug}', '{api_key}'],
                [$book->slug, $apiKey],
                config('services.hadith.chapter')
            );

            try {
                $response = $this->apiService->get($url);

                if (Arr::get($response, 'status') !== 200) {
                    throw new \Exception($response['message'] ?? 'Invalid response status');
                }

                $chaptersData = Arr::get($response, 'result.chapters', []);
                if (empty($chaptersData)) {
                    throw new \Exception("No chapters found for book: {$book->slug}");
                }

                $now          = now();
                $chapters     = [];
                $translations = [];

                $sort = 1;
                foreach ($chaptersData as $chapter) {
                    $chapterId  = $chapter['id'];
                    $chapters[] = [
                        'id'             => $chapterId,
                        'hadith_book_id' => $book->id,
                        'chapter_number' => (int) $chapter['chapterNumber'],
                        'slug'           => Str::slug($chapter['chapterEnglish'] ?? 'chapter-' . $chapterId),
                        'name'           => $chapter['chapterArabic'] ?? '',
                        'sort'           => $sort++,
                        'created_at'     => $now,
                        'updated_at'     => $now,
                    ];

                    $translations[] = [
                        'hadith_chapter_id' => $chapterId,
                        'lang'              => 'ar',
                        'name'              => $chapter['chapterArabic'] ?? '',
                        'name_romanized'    => null,
                        'description'       => null,
                        'created_by'        => 1,
                        'created_at'        => $now,
                        'updated_at'        => $now,
                    ];

                    $en             = parseHadithTitle($chapter['chapterEnglish'] ?? '');
                    $translations[] = [
                        'hadith_chapter_id' => $chapterId,
                        'lang'              => 'en',
                        'name'              => $en['title'] ?? '',
                        'name_romanized'    => $en['romanized'] ?? '',
                        'description'       => $en['description'] ?? '',
                        'created_by'        => 1,
                        'created_at'        => $now,
                        'updated_at'        => $now,
                    ];

                    $path       = database_path("json/hadith/{$book->slug}.json");
                    $chaptersMl = file_exists($path) ? json_decode(file_get_contents($path), true) : [];
                    $chapterMap = count($chaptersMl) > 0 ? array_column($chaptersMl, null, 'id') : [];

                    if (isset($chapterMap[$chapterId])) {
                        $found          = $chapterMap[$chapterId];
                        $translations[] = [
                            'hadith_chapter_id' => $chapterId,
                            'lang'              => 'ml',
                            'name'              => $found['name'],
                            'name_romanized'    => null,
                            'description'       => null,
                            'created_by'        => 1,
                            'created_at'        => $now,
                            'updated_at'        => $now,
                        ];
                    }
                }

                DB::transaction(function () use ($chapters, $translations) {
                    HadithChapter::insert($chapters);
                    HadithChapterTranslation::insert($translations);
                });

                $this->command->info("Chapters for `{$book->slug}` seeded successfully.");
            } catch (\Throwable $e) {
                $this->command->error("Failed to seed chapters for `{$book->slug}`: " . $e->getMessage());
                continue;
            }
        }
    }
}
