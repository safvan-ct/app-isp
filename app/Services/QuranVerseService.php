<?php
namespace App\Services;

use App\Http\Resources\Api\QuranChapterResource;
use App\Http\Resources\Api\QuranVerseResource;
use App\Repository\Quran\QuranChapterInterface;
use App\Repository\Quran\QuranVerseInterface;

class QuranVerseService
{
    public function __construct(
        protected QuranChapterInterface $quranChapterRepository,
        protected QuranVerseInterface $quranVerseRepository
    ) {}

    public function getVerses(string $chapterSlug, array $filters, int $perPage = 15)
    {
        $chapter = $this->quranChapterRepository->getBySlug($chapterSlug, $filters['translation'] ?? null);

        $paginatedVerses = $this->quranVerseRepository->getPaginatedVersesWithFilters($chapter, $filters, $perPage);

        return [
            'chapter' => new QuranChapterResource($chapter),
            'verses'  => QuranVerseResource::collection($paginatedVerses)->response()->getData(true),
        ];
    }

    public function getVerse(string $chapterSlug, int $verseNumber, array $filters)
    {
        $lang = $filters['translation'] ?? null;

        $chapter = $this->quranChapterRepository->getBySlug($chapterSlug, $lang);
        $verse   = $this->quranVerseRepository->getByChapterAndNumber($verseNumber, $chapter, $lang);

        return [
            'chapter' => new QuranChapterResource($chapter),
            'verses'  => ['data' => [new QuranVerseResource($verse)]],
        ];
    }
}
