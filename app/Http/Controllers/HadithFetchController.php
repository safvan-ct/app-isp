<?php
namespace App\Http\Controllers;

use App\Models\HadithBook;
use App\Models\HadithVerse;
use App\Repository\Hadith\HadithBookTranslationInterface;
use App\Repository\Hadith\HadithChapterInterface;
use App\Repository\Hadith\HadithVerseInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HadithFetchController extends Controller
{
    public function __construct(
        protected HadithBookTranslationInterface $hadithBookTranslationRepository,
        protected HadithChapterInterface $hadithChapterRepository,
        protected HadithVerseInterface $hadithVerseRepository
    ) {}

    public function fetchBooks(Request $request)
    {
        $books = $this->hadithBookTranslationRepository->getBooks($request->get('name'));
        return response()->json($books);
    }

    public function fetchChapters(Request $request)
    {
        $chapters = $this->hadithChapterRepository->getChpaters($request->get('hadith_book_id'), $request->get('name'));
        return response()->json($chapters);
    }

    public function fetchVerses(Request $request)
    {
        $verses = $this->hadithVerseRepository->getVersesByChapter($request->get('hadith_chapter_id'), $request->get('search'));
        return response()->json($verses);
    }

    public function fetchVerse($id)
    {
        $result = $this->hadithVerseRepository->getVerseById([$id]);
        return response()->json(['html' => view('web.partials.hadith-list', ['result' => $result, 'action' => false])->render()]);
    }

    public function fetchReference($slug, $number)
    {
        $hadith = HadithBook::where('slug', $slug)->first();
        $result = HadithVerse::select('id', 'hadith_book_id', 'hadith_chapter_id', 'chapter_number', 'hadith_number', 'heading', 'text', 'volume', 'status')
            ->with([
                'translations',
                'chapter' => fn($q) => $q->select('id', 'hadith_book_id', 'chapter_number', 'name')->with('translations'),
                'book'    => fn($q)    => $q->select('id', 'name', 'slug', 'writer', 'writer_death_year', 'hadith_count', 'chapter_count')->with('translations'),
            ])
            ->where('hadith_book_id', $hadith->id)
            ->where('hadith_number', $number)
            ->active()
            ->get();

        return response()->json(['html' => view('app.partials.hadith', ['verses' => $result])->render()]);
    }

    public function fetchLikedVerses(Request $request)
    {
        if (Auth::check() && Auth::user()->role == 'Customer') {
            $result = $this->hadithVerseRepository->getLikedVerses(Auth::id());
        } else {
            $ids    = array_values(array_filter($request->ids));
            $result = $this->hadithVerseRepository->getVerseById($ids, true);
        }

        return response()->json([
            'html'       => view('web.partials.hadith-list', ['result' => $result, 'liked' => true])->render(),
            'pagination' => view('components.web.pagination', ['paginator' => $result])->render(),
        ]);
    }

    public function fetchBookmarkedVerses(Request $request)
    {
        $result = $this->hadithVerseRepository->getBookmarkedVerses(Auth::id(), $request->get('collection_id'));

        return response()->json([
            'html'       => view('web.partials.hadith-list', ['result' => $result, 'bookmarked' => true])->render(),
            'pagination' => view('components.web.pagination', ['paginator' => $result])->render(),
        ]);
    }
}
