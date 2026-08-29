<?php

namespace Database\Seeders;

use App\Services\HadithJsonImportService;
use Illuminate\Database\Seeder;

/**
 * Local seed entry point that shares the exact same import path as the
 * admin JSON import UI.
 */
class HadithVerseJsonSeeder extends Seeder
{
    public function run(HadithJsonImportService $importService): void
    {
        foreach (['malik', 'ahmed', 'darimi', 'riyad_assalihin'] as $file) {
            $result = $importService->importFromFile($file, true);

            $this->command?->{$result['status'] ? 'info' : 'error'}($result['message']);
        }
    }
}
