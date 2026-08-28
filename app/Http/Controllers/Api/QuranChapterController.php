<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\GetQuranChaptersRequest;
use App\Services\QuranChapterService;

class QuranChapterController extends Controller
{
    public function __construct(
        protected QuranChapterService $quranChapterService
    ) {}

    public function index(GetQuranChaptersRequest $request)
    {
        $validated = $request->validated();

        $perPage = (int) ($validated['per_page'] ?? 15);

        // Filter keys only for query parameters
        $filters = array_intersect_key($validated, array_flip(['chapter_name', 'translation', 'active', 'all', 'minimal', 'revelation']));

        return $this->quranChapterService->getChapters($filters, $perPage);
    }
}
