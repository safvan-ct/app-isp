<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseTranslation;
use App\Models\Instructor;
use App\Repository\Course\CourseTranslationInterface;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
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
            new Middleware(PermissionMiddleware::using('update courses'), only: ['update', 'store']),
            new Middleware(PermissionMiddleware::using('active courses'), only: ['status']),
        ];
    }

    public function index(string $course_id, string $translation = null)
    {
        $course = Course::findOrFail($course_id);
        $transl = $translation ? CourseTranslation::findOrFail($translation) : null;
        $instructors = Instructor::active()->get();
        return view('admin.course.translations', compact('course', 'transl', 'instructors'));
    }

    public function dataTable(Request $request)
    {
        $results = $this->courseTranslationRepository->dataTable($request->course_id);
        return DataTables::of($results)->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'lang' => 'required|string|max:5',
            'title' => 'required|string|max:255',
            'desc' => 'nullable|string',
        ]);

        try {
            $data = $request->except('_token');
            $data['status'] = true;
            $this->courseTranslationRepository->store($data);
            return response()->json(['message' => 'Translation created successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, CourseTranslation $courseTranslation)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'desc' => 'nullable|string',
        ]);

        try {
            $data = $request->except('_token');
            if ($request->has('key_points')) {
                $data['key_points'] = is_array($request->key_points) ? $request->key_points : [];
            } else {
                $data['key_points'] = [];
            }
            $this->courseTranslationRepository->update($data, $courseTranslation);
            return response()->json(['message' => 'Translation updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function status(string $id)
    {
        try {
            $this->courseTranslationRepository->status($id);
            return response()->json(['message' => 'Translation status updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
