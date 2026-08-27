<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\GetHadithVersesRequest;
use App\Services\HadithVerseService;

class HadithVerseController extends Controller
{
    public function __construct(
        protected HadithVerseService $hadithVerseService
    ) {}

    public function index(GetHadithVersesRequest $request, string $bookSlug, string $chapterSlug)
    {
        $validated = $request->validated();

        $perPage = (int) ($validated['per_page'] ?? 15);

        // Filter keys only for query parameters
        $filters = array_intersect_key($validated, array_flip(['translation', 'active']));

        return $this->hadithVerseService->getVerses($bookSlug, $chapterSlug, $filters, $perPage);
    }
}
