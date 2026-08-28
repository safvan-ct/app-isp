<?php
namespace App\Services;

use App\Http\Resources\Api\QuranChapterResource;
use App\Repository\Quran\QuranChapterInterface;

class QuranChapterService
{
    public function __construct(
        protected QuranChapterInterface $quranChapterRepository
    ) {}

    public function getChapters(array $filters, int $perPage = 15)
    {
        $paginatedChapters = $this->quranChapterRepository->getPaginatedChaptersWithFilters($filters, $perPage);

        return QuranChapterResource::collection($paginatedChapters)->response()->getData(true);
    }
}
