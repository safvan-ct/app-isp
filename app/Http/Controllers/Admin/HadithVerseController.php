<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HadithBook;
use App\Models\HadithChapter;
use App\Models\HadithVerse;
use App\Models\HadithVerseImportLog;
use App\Repository\Hadith\HadithBookInterface;
use App\Repository\Hadith\HadithVerseInterface;
use App\Services\HadithVerseImportService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Yajra\DataTables\Facades\DataTables;

class HadithVerseController extends Controller implements HasMiddleware
{
    public function __construct(
        protected HadithVerseInterface $HadithVerseRepository,
        protected HadithBookInterface $HadithBookRepository,
        protected HadithVerseImportService $importService
    ) {}

    public static function middleware(): array
    {
        return [
            new Middleware(PermissionMiddleware::using('view hadith-verses'), only: ['index', 'dataTable', 'chapter', 'importLog']),
            new Middleware(PermissionMiddleware::using('update hadith-verse'), only: ['update', 'import']),
            new Middleware(PermissionMiddleware::using('active hadith-verse'), only: ['status']),
        ];
    }

    // -----------------------------------------------------------------------
    // Index
    // -----------------------------------------------------------------------

    public function index(Request $request)
    {
        $books             = HadithBook::orderBy('priority', 'asc')->get();
        $selectedBookId    = $request->get('book_id');
        $selectedChapterId = $request->get('chapter_id');

        $chapters = collect();
        if ($selectedBookId) {
            $chapters = HadithChapter::where('hadith_book_id', $selectedBookId)
                ->orderBy('sort', 'asc')
                ->orderBy('chapter_number', 'asc')
                ->get(['id', 'hadith_book_id', 'chapter_number', 'name']);
        }

        $perPage = 25;
        $verses  = collect();
        $stats   = [
            'total_verses'     => 0,
            'active_verses'    => 0,
            'total_in_scope'   => 0,
            'selected_book'    => null,
            'selected_chapter' => null,
        ];

        if ($selectedBookId) {
            $query = HadithVerse::where('hadith_book_id', $selectedBookId);
            if ($selectedChapterId) {
                $query->where('hadith_chapter_id', $selectedChapterId);
            }

            $statsQuery = clone $query;
            $stats      = [
                'total_verses'     => $statsQuery->count(),
                'active_verses'    => (clone $statsQuery)->where('is_active', 1)->count(),
                'total_in_scope'   => $statsQuery->count(),
                'selected_book'    => $books->firstWhere('id', $selectedBookId),
                'selected_chapter' => $selectedChapterId ? $chapters->firstWhere('id', $selectedChapterId) : null,
            ];

            $verses = $query->orderBy('hadith_number', 'asc')->paginate($perPage)->withQueryString();
        }

        // Pass import log for the current scope (if any)
        $importLog = $selectedBookId
            ? HadithVerseImportLog::forScope((int) $selectedBookId, $selectedChapterId ? (int) $selectedChapterId : null)
            : null;

        return view('admin.hadith.verse', compact(
            'books', 'chapters', 'verses', 'stats',
            'selectedBookId', 'selectedChapterId', 'importLog'
        ));
    }

    // -----------------------------------------------------------------------
    // Import
    // -----------------------------------------------------------------------

    public function import(Request $request)
    {
        try {
            $bookId    = $request->get('book_id') ? (int) $request->get('book_id') : null;
            $chapterId = $request->get('chapter_id') ? (int) $request->get('chapter_id') : null;

            $result = $this->importService->importVerses($bookId, $chapterId);

            $httpCode = $result['status'] ? 200 : 400;

            return response()->json([
                'status'   => $result['status'],
                'message'  => $result['message'],
                'warnings' => $result['warnings'] ?? [],
                'log'      => $result['log'],
            ], $httpCode);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Return the import log for a given book + optional chapter as JSON.
     * Used by the UI on book/chapter change to display the current log state.
     */
    public function importLog(Request $request)
    {
        $bookId    = $request->get('book_id') ? (int) $request->get('book_id') : null;
        $chapterId = $request->get('chapter_id') ? (int) $request->get('chapter_id') : null;

        if (! $bookId) {
            return response()->json(['log' => null]);
        }

        $log = HadithVerseImportLog::forScope($bookId, $chapterId);

        return response()->json([
            'log' => $log ? $this->importService->logToArray($log) : null,
        ]);
    }

    // -----------------------------------------------------------------------
    // Other actions
    // -----------------------------------------------------------------------

    public function update(Request $request, HadithVerse $hadithVerse)
    {
        $validated = $request->validate([
            'heading'        => 'nullable|string',
            'text'           => 'required|string',
            'volume'         => 'nullable|string|max:100',
            'status'         => 'nullable|string|max:100',
            'hadith_number'  => 'nullable|integer|min:0',
            'chapter_number' => 'nullable|integer|min:0',
        ]);

        try {
            $this->HadithVerseRepository->update($validated, $hadithVerse);
            return response()->json(['message' => 'Hadith updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function dataTable(Request $request)
    {
        $results = $this->HadithVerseRepository->dataTable($request->book_id, $request->chapter_id);
        return DataTables::of($results)->make(true);
    }

    public function chapter($bookId)
    {
        $results = HadithChapter::select('id', 'hadith_book_id', 'chapter_number', 'name')
            ->where('hadith_book_id', $bookId)
            ->orderBy('sort', 'asc')
            ->orderBy('chapter_number', 'asc')
            ->get();

        return response()->json($results);
    }

    public function status(string $id)
    {
        try {
            $this->HadithVerseRepository->status($id);
            return response()->json(['message' => 'Status updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
