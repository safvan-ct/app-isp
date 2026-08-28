<?php
namespace App\Repository\Quran;

use App\Models\QuranChapter;
use App\Models\QuranVerse;

interface QuranVerseInterface
{
    public function getById($id);

    public function dataTable($chapterId);

    public function status($id);

    public function update(array $data, QuranVerse $quranVerse);

    public function getVerseById(array $id, $paginate = false);

    public function getVerses(int $chapterId, ?int $ayahNumber = null);

    public function getLikedVerses($userId, $paginate = true);

    public function getBookmarkedVerses($userId, $collectionId, $paginate = true);

    public function getPaginatedVersesWithFilters(QuranChapter $chapter, array $filters, int $perPage);

    public function getByChapterAndNumber(int $verseNumber, QuranChapter $chapter, ?string $lang = null);
}
