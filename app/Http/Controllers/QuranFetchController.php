<?php
namespace App\Http\Controllers;

use App\Models\QuranChapter;
use App\Models\QuranVerse;
use App\Repository\Quran\QuranChapterTranslationInterface;
use App\Repository\Quran\QuranVerseInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuranFetchController extends Controller
{
    public function __construct(
        protected QuranChapterTranslationInterface $quranChapterTranslationRepository,
        protected QuranVerseInterface $quranVerseRepository
    ) {}

    public function fetchChapters(Request $request)
    {
        return $this->quranChapterTranslationRepository->getChapters($request->get('chapter_id'));
    }

    public function fetchVerses(Request $request)
    {
        return $this->quranVerseRepository->getVerses($request->get('chapter_id'), $request->get('ayah_number'));
    }

    public function fetchVerseById($id)
    {
        $result = $this->quranVerseRepository->getVerseById([$id]);
        return response()->json(['html' => view('web.partials.ayah-list', ['result' => $result, 'playOnly' => true])->render()]);
    }

    public function fetchReference($slug, $number)
    {
        $chapter = QuranChapter::where('id', $slug)->first();
        $result  = QuranVerse::select('id', 'quran_chapter_id', 'number_in_chapter', 'text')
            ->with([
                'translations',
                'chapter' => fn($q) => $q->select('id', 'name')->with('translations'),
            ])
            ->where('quran_chapter_id', $chapter->id)
            ->where('number_in_chapter', $number)
            ->active()
            ->get();

        return response()->json(['html' => view('app.partials.quran', ['verses' => $result])->render()]);
    }

    public function fetchLikedVerses(Request $request)
    {
        if (Auth::check() && Auth::user()->role == 'Customer') {
            $result = $this->quranVerseRepository->getLikedVerses(Auth::id());
        } else {
            $ids    = array_values(array_filter($request->ids));
            $result = $this->quranVerseRepository->getVerseById($ids, true);
        }

        return response()->json([
            'html'       => view('web.partials.ayah-list', ['result' => $result, 'liked' => true])->render(),
            'pagination' => view('components.web.pagination', ['paginator' => $result])->render(),
        ]);
    }

    public function fetchBookmarkedVerses(Request $request)
    {
        $result = $this->quranVerseRepository->getBookmarkedVerses(Auth::id(), $request->get('collection_id'));

        return response()->json([
            'html'       => view('web.partials.ayah-list', ['result' => $result, 'bookmarked' => true])->render(),
            'pagination' => view('components.web.pagination', ['paginator' => $result])->render(),
        ]);
    }
}
