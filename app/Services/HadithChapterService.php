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

        $chapters = $this->hadithChapterRepository->getPaginatedChaptersWithFilters($book, $filters, $perPage);

        $isMinimal = filter_var($filters['minimal'] ?? false, FILTER_VALIDATE_BOOLEAN);

        if ($chapters instanceof \Illuminate\Pagination\CursorPaginator  || $chapters instanceof \Illuminate\Pagination\AbstractPaginator) {
            $responseData = [
                'chapters' => HadithChapterResource::collection($chapters)->response()->getData(true),
            ];
            if (! $isMinimal) {
                $responseData['book'] = new HadithBookResource($book);
            }
            return $responseData;
        }

        $responseData = [
            'chapters' => [
                'data' => HadithChapterResource::collection($chapters),
            ],
        ];
        if (! $isMinimal) {
            $responseData['book'] = new HadithBookResource($book);
        }
        return $responseData;
    }
}
