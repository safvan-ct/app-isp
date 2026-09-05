<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChapterTranslation\StoreRequest;
use App\Models\ChapterTranslation;
use App\Repository\Course\ChapterTranslationInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\View\View;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Yajra\DataTables\Facades\DataTables;

class ChapterTranslationController extends Controller implements HasMiddleware
{
    public function __construct(
        protected ChapterTranslationInterface $chapterTranslationRepository,
    ) {}

    public static function middleware(): array
    {
        return [
            new Middleware(PermissionMiddleware::using('view chapters'), only: ['index', 'dataTable']),
            new Middleware(PermissionMiddleware::using('store chapters-translation'), only: ['store']),
            new Middleware(PermissionMiddleware::using('update chapters-translation'), only: ['update']),
            new Middleware(PermissionMiddleware::using('active chapters-translation'), only: ['status']),
        ];
    }

    public function index(string | int $chapter_id, ?string $translation = null): View
    {
        $chapter = $this->chapterTranslationRepository->getChapter($chapter_id);
        $transl  = $translation ? $this->chapterTranslationRepository->find($translation) : null;

        return view('admin.course.chapter.translations', compact('chapter', 'transl'));
    }

    public function dataTable(Request $request): JsonResponse
    {
        $query = $this->chapterTranslationRepository->dataTable($request->chapter_id);

        return DataTables::of($query)->make(true);
    }

    public function store(StoreRequest $request): JsonResponse
    {
        try {
            $this->chapterTranslationRepository->store($request->validated());
            return response()->json(['message' => 'Chapter translation created successfully']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function update(StoreRequest $request, ChapterTranslation $chapterTranslation): JsonResponse
    {
        try {
            $this->chapterTranslationRepository->update($request->validated(), $chapterTranslation);
            return response()->json(['message' => 'Chapter translation updated successfully']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function status(ChapterTranslation $chapterTranslation): JsonResponse
    {
        try {
            $this->chapterTranslationRepository->status($chapterTranslation);
            return response()->json(['message' => 'Chapter translation status updated successfully']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
