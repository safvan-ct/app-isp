<?php
namespace App\Services;

use App\Http\Resources\Api\HadithBookResource;
use App\Http\Resources\Api\HadithChapterResource;
use App\Http\Resources\Api\HadithVerseResource;
use App\Repository\Hadith\HadithBookInterface;
use App\Repository\Hadith\HadithChapterInterface;
use App\Repository\Hadith\HadithVerseInterface;

class HadithVerseService
{
    public function __construct(
        protected HadithBookInterface $hadithBookRepository,
        protected HadithChapterInterface $hadithChapterRepository,
        protected HadithVerseInterface $hadithVerseRepository
    ) {}

    public function getVerses(string $bookSlug, string $chapterSlug, array $filters, int $perPage = 10)
    {
        $book    = $this->hadithBookRepository->getBySlugWithActiveTranslation($bookSlug, $filters['translation'] ?? null);
        $chapter = $this->hadithChapterRepository->getBySlugAndBook($chapterSlug, $book, $filters['translation'] ?? null);

        $paginatedVerses = $this->hadithVerseRepository->getPaginatedVersesWithFilters($chapter, $filters, $perPage);

        return [
            'book'    => new HadithBookResource($book),
            'chapter' => new HadithChapterResource($chapter),
            'verses'  => HadithVerseResource::collection($paginatedVerses)->response()->getData(true),
        ];
    }

    public function getVerse(string $bookSlug, int $hadithNumber, array $filters)
    {
        $lang = $filters['translation'] ?? null;

        $book  = $this->hadithBookRepository->getBySlugWithActiveTranslation($bookSlug, $lang);
        $verse = $this->hadithVerseRepository->getByBookAndNumber($hadithNumber, $book, $lang);

        return [
            'book'    => new HadithBookResource($book),
            'chapter' => new HadithChapterResource($verse->chapter),
            'verse'   => new HadithVerseResource($verse),
        ];
    }
}
