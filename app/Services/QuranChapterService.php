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
        $result = $this->quranChapterRepository->getPaginatedChaptersWithFilters($filters, $perPage);

        $chapters     = $result['chapters'];
        $meccanCount  = $result['meccan_count'];
        $medinanCount = $result['medinan_count'];

        if ($chapters instanceof \Illuminate\Pagination\CursorPaginator  || $chapters instanceof \Illuminate\Pagination\AbstractPaginator) {
            $responseData                  = QuranChapterResource::collection($chapters)->response()->getData(true);
            $responseData['meccan_count']  = $meccanCount;
            $responseData['medinan_count'] = $medinanCount;
            return $responseData;
        }

        return [
            'data'          => QuranChapterResource::collection($chapters),
            'meccan_count'  => $meccanCount,
            'medinan_count' => $medinanCount,
        ];
    }
}
