<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\GetHadithBooksRequest;
use App\Services\HadithBookService;

class HadithBookController extends Controller
{
    public function __construct(
        protected HadithBookService $hadithBookService
    ) {}

    public function index(GetHadithBooksRequest $request)
    {
        $validated = $request->validated();

        $perPage = (int) ($validated['per_page'] ?? 10);

        // Filter keys only for query parameters
        $filters = array_intersect_key($validated, array_flip(['book_name', 'translation', 'active']));

        return $this->hadithBookService->getBooks($filters, $perPage);
    }
}
