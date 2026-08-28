<?php
namespace Database\Seeders;

use App\Services\HadithVerseImportService;
use Illuminate\Database\Seeder;

class HadithVerseSeeder extends Seeder
{
    public function __construct(protected HadithVerseImportService $importService)
    {}

    /**
     * Run the database seeds.
     * Imports verses for the first book that has chapters but no verses yet.
     * Re-run to process the next book.
     */
    public function run(): void
    {
        set_time_limit(0);
        ini_set('memory_limit', '-1');

        // Find the first book that has chapters but no verses yet
        $book = \App\Models\HadithBook::select(['id', 'slug', 'name'])
            ->whereHas('chapters')
            ->whereDoesntHave('verses')
            ->orderBy('id')
            ->first();

        if (! $book) {
            $this->command->info('All books already have verses seeded.');
            return;
        }

        $this->command->info("Seeding verses for book: {$book->name} (ID: {$book->id})");

        $result = $this->importService->importVerses($book->id, null);

        if ($result['status']) {
            $this->command->info($result['message']);
            foreach ($result['warnings'] as $warning) {
                $this->command->warn($warning);
            }

            // Check if more books need seeding
            $remaining = \App\Models\HadithBook::whereHas('chapters')
                ->whereDoesntHave('verses')
                ->count();

            if ($remaining > 0) {
                $this->command->info("Remaining books without verses: {$remaining}. Re-run seeder to process the next one.");
            }
        } else {
            $this->command->error('Import failed: ' . $result['message']);
        }
    }
}
