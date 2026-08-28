<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HadithBook;
use App\Models\HadithChapter;
use App\Repository\Hadith\HadithBookInterface;
use App\Repository\Hadith\HadithChapterInterface;
use App\Services\HadithChapterImportService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Yajra\DataTables\Facades\DataTables;

class HadithChapterController extends Controller implements HasMiddleware
{
    public function __construct(
        protected HadithBookInterface $HadithBookRepository,
        protected HadithChapterInterface $HadithChapterRepository,
        protected HadithChapterImportService $importService
    ) {}

    public static function middleware(): array
    {
        return [
            new Middleware(PermissionMiddleware::using('view hadith-chapters'), only: ['index', 'dataTable']),
            new Middleware(PermissionMiddleware::using('update hadith-chapter'), only: ['update', 'import', 'resetCounts']),
            new Middleware(PermissionMiddleware::using('active hadith-chapter'), only: ['status']),
        ];
    }

    public function index(Request $request)
    {
        $books          = HadithBook::orderBy('priority', 'asc')->get();
        $selectedBookId = $request->get('book_id');

        $query = HadithChapter::with(['book', 'translations']);
        if ($selectedBookId) {
            $query->where('hadith_book_id', $selectedBookId);
        }

        // Calculate stats for current filter
        $statsQuery = clone $query;
        $stats      = [
            'total_chapters'  => $statsQuery->count(),
            'active_chapters' => (clone $statsQuery)->where('is_active', 1)->count(),
            'total_hadiths'   => $statsQuery->sum('hadith_count'),
            'selected_book'   => $selectedBookId ? $books->firstWhere('id', $selectedBookId) : null,
        ];

        $perPage  = (int) $request->get('per_page', 12);
        $chapters = $query->orderBy('sort', 'asc')->orderBy('chapter_number', 'asc')->paginate($perPage)->withQueryString();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'chapters' => $chapters,
                'stats'    => $stats,
            ]);
        }

        return view('admin.hadith.chapter', compact('books', 'chapters', 'stats', 'selectedBookId'));
    }

    public function import(Request $request)
    {
        try {
            $bookId = $request->get('book_id');
            $result = $this->importService->importChapters($bookId ? (int) $bookId : null);

            if ($result['status']) {
                return response()->json([
                    'status'   => true,
                    'message'  => $result['message'],
                    'warnings' => $result['warnings'] ?? [],
                ]);
            }

            return response()->json(['status' => false, 'message' => $result['message']], 400);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, HadithChapter $hadithChapter)
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'chapter_number' => 'nullable|integer|min:0',
            'slug'           => 'nullable|string|max:255',
            'hadith_count'   => 'nullable|integer|min:0',
            'sort'           => 'nullable|integer|min:0',
        ]);

        try {
            $this->HadithChapterRepository->update($validated, $hadithChapter);
            return response()->json(['message' => 'Hadith chapter updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Reset hadith_count for all chapters (or a single chapter) from real DB verse counts.
     */
    public function resetCounts(Request $request)
    {
        try {
            $chapterId = $request->get('chapter_id');
            $bookId    = $request->get('book_id');

            $query = HadithChapter::query();

            if ($chapterId) {
                $query->where('id', $chapterId);
            } elseif ($bookId) {
                $query->where('hadith_book_id', $bookId);
            }

            $chapters = $query->get();
            $updated  = 0;

            foreach ($chapters as $chapter) {
                $count = \App\Models\HadithVerse::where('hadith_chapter_id', $chapter->id)->count();
                $chapter->update(['hadith_count' => $count]);
                $updated++;
            }

            if ($chapterId) {
                $scope = "chapter ID {$chapterId}";
            } elseif ($bookId) {
                $scope = "all chapters of book ID {$bookId}";
            } else {
                $scope = 'all chapters';
            }

            return response()->json([
                'status'  => true,
                'message' => "Hadith counts reset for {$scope}. {$updated} chapter(s) updated.",
            ]);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function dataTable(Request $request)
    {
        $results = $this->HadithChapterRepository->dataTable($request->book_id);
        return DataTables::of($results)->make(true);
    }

    public function status(string $id)
    {
        try {
            $this->HadithChapterRepository->status($id);
            return response()->json(['message' => 'Status updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
