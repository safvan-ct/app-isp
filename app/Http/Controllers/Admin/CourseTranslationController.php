<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseTranslation\StoreRequest;
use App\Models\CourseTranslation;
use App\Repository\Course\CourseTranslationInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\View\View;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Yajra\DataTables\Facades\DataTables;

class CourseTranslationController extends Controller implements HasMiddleware
{
    public function __construct(
        protected CourseTranslationInterface $courseTranslationRepository,
    ) {}

    public static function middleware(): array
    {
        return [
            new Middleware(PermissionMiddleware::using('view courses'), only: ['index', 'dataTable']),
            new Middleware(PermissionMiddleware::using('store courses'), only: ['store']),
            new Middleware(PermissionMiddleware::using('update courses'), only: ['update']),
            new Middleware(PermissionMiddleware::using('active courses'), only: ['status']),
        ];
    }

    public function index(string | int $course_id, ?string $translation = null): View
    {
        $course      = $this->courseTranslationRepository->getCourse($course_id);
        $transl      = $translation ? $this->courseTranslationRepository->find($translation) : null;
        $instructors = $this->courseTranslationRepository->getInstructors();

        return view('admin.course.translations', compact('course', 'transl', 'instructors'));
    }

    public function dataTable(Request $request): JsonResponse
    {
        $query = $this->courseTranslationRepository->dataTable($request->course_id);

        return DataTables::of($query)
            ->rawColumns(['objectives', 'desc', 'key_points'])
            ->make(true);
    }

    public function store(StoreRequest $request): JsonResponse
    {
        try {
            $this->courseTranslationRepository->store($request->validated());
            return response()->json(['message' => 'Translation created successfully']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function update(StoreRequest $request, CourseTranslation $courseTranslation): JsonResponse
    {
        try {
            $this->courseTranslationRepository->update($request->validated(), $courseTranslation);
            return response()->json(['message' => 'Translation updated successfully']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function status(CourseTranslation $courseTranslation): JsonResponse
    {
        try {
            $this->courseTranslationRepository->status($courseTranslation);
            return response()->json(['message' => 'Translation status updated successfully']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
