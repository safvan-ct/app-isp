<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HadithChapterCountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Updating hadith counts in hadith_chapters table...');

        $updatedRows = DB::update("
            UPDATE hadith_chapters
            SET
                hadith_count = (
                    SELECT COUNT(*)
                    FROM hadith_verses
                    WHERE hadith_verses.hadith_chapter_id = hadith_chapters.id
                ),
                is_active = CASE
                    WHEN (
                        SELECT COUNT(*)
                        FROM hadith_verses
                        WHERE hadith_verses.hadith_chapter_id = hadith_chapters.id
                    ) = 0 THEN 0
                    ELSE 1
                END
        ");

        $this->command->info("Successfully updated {$updatedRows} chapters' hadith counts.");
    }
}
