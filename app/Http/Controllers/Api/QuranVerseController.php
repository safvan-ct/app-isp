<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\GetQuranVerseRequest;
use App\Http\Requests\Api\GetQuranVersesRequest;
use App\Services\QuranVerseService;

class QuranVerseController extends Controller
{
    public function __construct(
        protected QuranVerseService $quranVerseService
    ) {}

    public function index(GetQuranVersesRequest $request, string $chapterSlug)
    {
        $validated = $request->validated();

        $perPage = (int) ($validated['per_page'] ?? 15);

        // Filter keys only for query parameters
        $filters = array_intersect_key($validated, array_flip(['translation', 'active']));

        return $this->quranVerseService->getVerses($chapterSlug, $filters, $perPage);
    }

    public function show(GetQuranVerseRequest $request, string $chapterSlug, int $verseNumber)
    {
        $validated = $request->validated();

        // Filter keys only for query parameters
        $filters = array_intersect_key($validated, array_flip(['translation', 'active']));

        return $this->quranVerseService->getVerse($chapterSlug, $verseNumber, $filters);
    }
}
