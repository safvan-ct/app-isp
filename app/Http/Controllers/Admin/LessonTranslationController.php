<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LessonTranslation\StoreRequest;
use App\Models\LessonTranslation;
use App\Repository\Course\LessonTranslationInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\View\View;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Yajra\DataTables\Facades\DataTables;

class LessonTranslationController extends Controller implements HasMiddleware
{
    public function __construct(
        protected LessonTranslationInterface $lessonTranslationRepository,
    ) {}

    public static function middleware(): array
    {
        return [
            new Middleware(PermissionMiddleware::using('view lessons'), only: ['index', 'dataTable']),
            new Middleware(PermissionMiddleware::using('store lessons-translation'), only: ['store']),
            new Middleware(PermissionMiddleware::using('update lessons-translation'), only: ['update']),
            new Middleware(PermissionMiddleware::using('active lessons-translation'), only: ['status']),
        ];
    }

    public function index(string | int $lesson_id, ?string $translation = null): View
    {
        $lesson = $this->lessonTranslationRepository->getLesson($lesson_id);
        $transl = $translation ? $this->lessonTranslationRepository->find($translation) : null;

        return view('admin.course.lesson.translations', compact('lesson', 'transl'));
    }

    public function dataTable(Request $request): JsonResponse
    {
        $query = $this->lessonTranslationRepository->dataTable($request->lesson_id);

        return DataTables::of($query)->make(true);
    }

    public function store(StoreRequest $request): JsonResponse
    {
        try {
            $this->lessonTranslationRepository->store($request->validated());
            return response()->json(['message' => 'Lesson translation created successfully']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function update(StoreRequest $request, LessonTranslation $lessonTranslation): JsonResponse
    {
        try {
            $this->lessonTranslationRepository->update($request->validated(), $lessonTranslation);
            return response()->json(['message' => 'Lesson translation updated successfully']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function status(LessonTranslation $lessonTranslation): JsonResponse
    {
        try {
            $this->lessonTranslationRepository->status($lessonTranslation);
            return response()->json(['message' => 'Lesson translation status updated successfully']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
