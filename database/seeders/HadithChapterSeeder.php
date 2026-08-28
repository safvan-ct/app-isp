<?php
namespace Database\Seeders;

use App\Services\HadithChapterImportService;
use Illuminate\Database\Seeder;

class HadithChapterSeeder extends Seeder
{
    public function __construct(protected HadithChapterImportService $importService)
    {}

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $result = $this->importService->importChapters();

        if ($result['status']) {
            $this->command->info($result['message']);
            if (! empty($result['warnings'])) {
                foreach ($result['warnings'] as $warning) {
                    $this->command->warn($warning);
                }
            }
        } else {
            $this->command->error('Failed to seed Hadith chapters: ' . $result['message']);
        }
    }
}
