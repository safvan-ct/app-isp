<?php
namespace App\Services;

use App\Http\Resources\Api\HadithBookResource;
use App\Http\Resources\Api\HadithChapterResource;
use App\Repository\Hadith\HadithBookInterface;
use App\Repository\Hadith\HadithChapterInterface;

class HadithChapterService
{
    public function __construct(
        protected HadithBookInterface $hadithBookRepository,
        protected HadithChapterInterface $hadithChapterRepository
    ) {}

    public function getChapters(string $bookSlug, array $filters, int $perPage = 10)
    {
        $book = $this->hadithBookRepository->getBySlugWithActiveTranslation($bookSlug, $filters['translation'] ?? null);

        $paginatedChapters = $this->hadithChapterRepository->getPaginatedChaptersWithFilters($book, $filters, $perPage);

        return [
            'book'     => new HadithBookResource($book),
            'chapters' => HadithChapterResource::collection($paginatedChapters)->response()->getData(true),
        ];
    }
}
