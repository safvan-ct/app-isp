<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HadithBook;
use App\Repository\Hadith\HadithBookInterface;
use App\Services\HadithBookImportService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Yajra\DataTables\Facades\DataTables;

class HadithBookController extends Controller implements HasMiddleware
{
    public function __construct(
        protected HadithBookInterface $HadithBookRepository,
        protected HadithBookImportService $importService
    ) {}

    public static function middleware(): array
    {
        return [
            new Middleware(PermissionMiddleware::using('view hadith-books'), only: ['index', 'dataTable']),
            new Middleware(PermissionMiddleware::using('update hadith-book'), only: ['update', 'import']),
            new Middleware(PermissionMiddleware::using('active hadith-book'), only: ['status']),
        ];
    }

    public function index(Request $request)
    {
        $books = HadithBook::orderBy('priority', 'asc')->get();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'books' => $books,
                'stats' => [
                    'total_books'    => $books->count(),
                    'total_chapters' => $books->sum('chapter_count'),
                    'total_hadiths'  => $books->sum('hadith_count'),
                    'active_books'   => $books->where('is_active', 1)->count(),
                ],
            ]);
        }

        $stats = [
            'total_books'    => $books->count(),
            'total_chapters' => $books->sum('chapter_count'),
            'total_hadiths'  => $books->sum('hadith_count'),
            'active_books'   => $books->where('is_active', 1)->count(),
        ];

        return view('admin.hadith.book', compact('books', 'stats'));
    }

    public function import()
    {
        try {
            $result = $this->importService->importBooks();

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

    public function update(Request $request, HadithBook $hadithBook)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'writer'       => 'nullable|string|max:255',
            'abbreviation' => 'nullable|string|max:50',
            'status'       => 'nullable|string|max:100',
            'group'        => 'nullable|string|max:100',
            'life_span'    => 'nullable|string|max:100',
            'priority'     => 'nullable|integer|min:0',
        ]);

        try {
            $this->HadithBookRepository->update($validated, $hadithBook);
            return response()->json(['message' => 'Hadith book updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function dataTable()
    {
        $results = $this->HadithBookRepository->dataTable();
        return DataTables::of($results)->make(true);
    }

    public function status(string $id)
    {
        try {
            $this->HadithBookRepository->status($id);
            return response()->json(['message' => 'Status updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
