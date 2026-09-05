<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Course\StoreRequest;
use App\Models\Course;
use App\Repository\Course\CourseInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\View\View;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Yajra\DataTables\Facades\DataTables;

class CourseController extends Controller implements HasMiddleware
{
    public function __construct(
        protected CourseInterface $courseRepository,
    ) {}

    public static function middleware(): array
    {
        return [
            new Middleware(PermissionMiddleware::using('view courses'), only: ['index', 'dataTable']),
            new Middleware(PermissionMiddleware::using('store courses'), only: ['store']),
            new Middleware(PermissionMiddleware::using('update courses'), only: ['update']),
            new Middleware(PermissionMiddleware::using('active courses'), only: ['status']),
            new Middleware(PermissionMiddleware::using('sort courses'), only: ['sort']),
        ];
    }

    public function index(): View
    {
        $types = $this->courseRepository->getTypes();
        return view('admin.course.index', compact('types'));
    }

    public function dataTable(): JsonResponse
    {
        $query = $this->courseRepository->dataTable();

        return DataTables::of($query)->make(true);
    }

    public function store(StoreRequest $request): JsonResponse
    {
        try {
            $this->courseRepository->store($request->validated());
            return response()->json(['message' => 'Course created successfully']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function update(StoreRequest $request, Course $course): JsonResponse
    {
        try {
            $this->courseRepository->update($request->validated(), $course);
            return response()->json(['message' => 'Course updated successfully']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function status(Course $course): JsonResponse
    {
        try {
            $this->courseRepository->status($course);
            return response()->json(['message' => 'Course status updated successfully']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function sort(Request $request): JsonResponse
    {
        try {
            $this->courseRepository->sort($request->all());
            return response()->json(['message' => 'Course sort updated successfully']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
