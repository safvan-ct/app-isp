<?php
namespace Database\Seeders;

use App\Services\HadithBookImportService;
use Illuminate\Database\Seeder;

class HadithBookSeeder extends Seeder
{
    public function __construct(protected HadithBookImportService $importService)
    {}

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $result = $this->importService->importBooks();

        if ($result['status']) {
            $this->command->info($result['message']);
            if (! empty($result['warnings'])) {
                foreach ($result['warnings'] as $warning) {
                    $this->command->warn($warning);
                }
            }
        } else {
            $this->command->error('Failed to seed Hadith books: ' . $result['message']);
        }
    }
}
