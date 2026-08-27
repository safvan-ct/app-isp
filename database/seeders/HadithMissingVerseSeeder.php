<?php
namespace Database\Seeders;

use App\Models\HadithVerse;
use App\Models\HadithVerseTranslation;
use App\Services\ApiService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HadithMissingVerseSeeder extends Seeder
{
    public function __construct(protected ApiService $apiService)
    {}

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        set_time_limit(0);             // safer than -1 in some environments
        ini_set('memory_limit', '-1'); // Unlimited memory

        $apiKey  = config('services.hadith.api_key');
        $baseUrl = config('services.hadith.hadith');
        $now     = now();
        $urlBase = str_replace("{api_key}", $apiKey, $baseUrl);

        $bookSlug = 'mishkat';
        $pages    = [
            62, 63, 124, 125, 126, 127, 247, 248, 249, 250, 251,
        ];

        $this->command->info("Hadith missing verse seeding started at: {$now->toDateTimeString()}");

        try {
            $this->command->info("Seeding book: {$bookSlug}");

            $url = "{$urlBase}&book={$bookSlug}&paginate=500&page=1";

            foreach ($pages as $page) {
                $url      = "{$url}&page={$page}";
                $response = $this->apiService->get($url);
                if (Arr::get($response, 'status') !== 200) {
                    $this->command->error("Error on page {$page}: " . ($response['message'] ?? ''));
                    Log::error("Error on page {$page} for book: {$bookSlug} " . ($response['message'] ?? ''));
                    continue;
                }

                $data         = Arr::get($response, 'result.hadiths.data', []);
                $hadiths      = [];
                $translations = [];

                foreach ($data as $hadith) {
                    $hadiths[] = [
                        'id'                => $hadith['id'],
                        'hadith_book_id'    => $hadith['book']['id'],
                        'hadith_chapter_id' => $hadith['chapter']['id'],
                        'chapter_number'    => $hadith['chapter']['chapterNumber'],
                        'hadith_number'     => (int) $hadith['hadithNumber'],
                        'heading'           => $hadith['headingArabic'],
                        'text'              => $hadith['hadithArabic'],
                        'volume'            => $hadith['volume'],
                        'status'            => strtolower($hadith['status']),
                        'is_active'         => 1,
                        'created_at'        => $now,
                        'updated_at'        => $now,
                    ];

                    $translations[] = [
                        'hadith_verse_id'  => $hadith['id'],
                        'lang'             => 'en',
                        'heading'          => $hadith['headingEnglish'],
                        'text'             => $hadith['hadithEnglish'],
                        'status_romanized' => strtolower($hadith['status']),
                        'is_active'        => 1,
                        'created_by'       => 1,
                        'created_at'       => $now,
                        'updated_at'       => $now,
                    ];
                }

                DB::transaction(function () use ($hadiths, $translations) {
                    HadithVerse::insert($hadiths);
                    HadithVerseTranslation::insert($translations);
                });

                $this->command->info("Inserted page {$page} for book: {$bookSlug}");
                Log::info("Inserted page {$page} for book: {$bookSlug}");

                unset($hadiths, $translations);
                gc_collect_cycles(); // clear memory
            }

            $this->command->info("Hadith missing verse seeding completed at: " . date('Y-m-d H:i:s'));

        } catch (\Exception $e) {
            $this->command->error('Error fetching hadiths: ' . $e->getMessage());
            Log::error('Error fetching hadiths: ' . $e->getMessage());
            return;
        }
    }
}
