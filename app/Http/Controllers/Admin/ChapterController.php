<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Chapter\StoreRequest;
use App\Models\Chapter;
use App\Repository\Course\ChapterInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\View\View;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Yajra\DataTables\Facades\DataTables;

class ChapterController extends Controller implements HasMiddleware
{
    public function __construct(
        protected ChapterInterface $chapterRepository,
    ) {}

    public static function middleware(): array
    {
        return [
            new Middleware(PermissionMiddleware::using('view chapters'), only: ['index', 'dataTable']),
            new Middleware(PermissionMiddleware::using('store chapters'), only: ['store']),
            new Middleware(PermissionMiddleware::using('update chapters'), only: ['update']),
            new Middleware(PermissionMiddleware::using('active chapters'), only: ['status']),
            new Middleware(PermissionMiddleware::using('sort chapters'), only: ['sort']),
        ];
    }

    public function index(?string $course_id = null): View
    {
        $courses = $this->chapterRepository->getCourses();
        $course  = $course_id ? $this->chapterRepository->getCourse($course_id) : null;

        return view('admin.course.chapter.index', compact('courses', 'course'));
    }

    public function dataTable(Request $request): JsonResponse
    {
        $courseId = $request->filled('course_id') ? (int) $request->course_id : null;
        $query    = $this->chapterRepository->dataTable($courseId);

        return DataTables::of($query)->make(true);
    }

    public function store(StoreRequest $request): JsonResponse
    {
        try {
            $this->chapterRepository->store($request->validated());
            return response()->json(['message' => 'Chapter created successfully']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function update(StoreRequest $request, Chapter $chapter): JsonResponse
    {
        try {
            $this->chapterRepository->update($request->validated(), $chapter);
            return response()->json(['message' => 'Chapter updated successfully']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function status(Chapter $chapter): JsonResponse
    {
        try {
            $this->chapterRepository->status($chapter);
            return response()->json(['message' => 'Chapter status updated successfully']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function sort(Request $request): JsonResponse
    {
        try {
            $this->chapterRepository->sort($request->all());
            return response()->json(['message' => 'Chapter sort updated successfully']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
