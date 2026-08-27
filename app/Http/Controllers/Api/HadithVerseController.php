<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\GetHadithVerseRequest;
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

        $perPage = (int) ($validated['per_page'] ?? 3);

        // Filter keys only for query parameters
        $filters = array_intersect_key($validated, array_flip(['translation', 'active']));

        return $this->hadithVerseService->getVerses($bookSlug, $chapterSlug, $filters, $perPage);
    }

    public function show(GetHadithVerseRequest $request, string $bookSlug, int $hadithNumber)
    {
        $validated = $request->validated();

        // Filter keys only for query parameters
        $filters = array_intersect_key($validated, array_flip(['translation', 'active']));

        return $this->hadithVerseService->getVerse($bookSlug, $hadithNumber, $filters);
    }
}
