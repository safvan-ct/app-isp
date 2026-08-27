<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\GetHadithChaptersRequest;
use App\Services\HadithChapterService;

class HadithChapterController extends Controller
{
    public function __construct(
        protected HadithChapterService $hadithChapterService
    ) {}

    public function index(GetHadithChaptersRequest $request, string $bookSlug)
    {
        $validated = $request->validated();

        $perPage = (int) ($validated['per_page'] ?? 15);

        // Filter keys only for query parameters
        $filters = array_intersect_key($validated, array_flip(['chapter_name', 'translation', 'active']));

        return $this->hadithChapterService->getChapters($bookSlug, $filters, $perPage);
    }
}
