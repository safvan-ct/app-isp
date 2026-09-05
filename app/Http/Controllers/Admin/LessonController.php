<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lesson\StoreRequest;
use App\Models\Lesson;
use App\Repository\Course\LessonInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\View\View;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Yajra\DataTables\Facades\DataTables;

class LessonController extends Controller implements HasMiddleware
{
    public function __construct(
        protected LessonInterface $lessonRepository,
    ) {}

    public static function middleware(): array
    {
        return [
            new Middleware(PermissionMiddleware::using('view lessons'), only: ['index', 'dataTable']),
            new Middleware(PermissionMiddleware::using('store lessons'), only: ['store']),
            new Middleware(PermissionMiddleware::using('update lessons'), only: ['update']),
            new Middleware(PermissionMiddleware::using('active lessons'), only: ['status']),
            new Middleware(PermissionMiddleware::using('sort lessons'), only: ['sort']),
        ];
    }

    public function index(?string $chapter_id = null): View
    {
        $chapters = $this->lessonRepository->getChapters();
        $chapter  = $chapter_id ? $this->lessonRepository->getChapter($chapter_id) : null;

        return view('admin.course.lesson.index', compact('chapters', 'chapter'));
    }

    public function dataTable(Request $request): JsonResponse
    {
        $chapterId = $request->filled('chapter_id') ? (int) $request->chapter_id : null;
        $query     = $this->lessonRepository->dataTable($chapterId);

        return DataTables::of($query)->make(true);
    }

    public function store(StoreRequest $request): JsonResponse
    {
        try {
            $this->lessonRepository->store($request->validated());
            return response()->json(['message' => 'Lesson created successfully']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function update(StoreRequest $request, Lesson $lesson): JsonResponse
    {
        try {
            $this->lessonRepository->update($request->validated(), $lesson);
            return response()->json(['message' => 'Lesson updated successfully']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function status(Lesson $lesson): JsonResponse
    {
        try {
            $this->lessonRepository->status($lesson);
            return response()->json(['message' => 'Lesson status updated successfully']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function sort(Request $request): JsonResponse
    {
        try {
            $this->lessonRepository->sort($request->all());
            return response()->json(['message' => 'Lesson sort updated successfully']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
