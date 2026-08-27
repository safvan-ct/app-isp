<?php
namespace App\Services;

use App\Http\Resources\Api\HadithBookResource;
use App\Repository\Hadith\HadithBookInterface;

class HadithBookService
{
    public function __construct(
        protected HadithBookInterface $hadithBookRepository
    ) {}

    public function getBooks(array $filters, int $perPage = 10)
    {
        $paginatedBooks = $this->hadithBookRepository->getPaginatedWithFilters($filters, $perPage);

        return HadithBookResource::collection($paginatedBooks);
    }
}
