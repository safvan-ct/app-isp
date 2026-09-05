<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Repository\Course\CourseInterface;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Yajra\DataTables\Facades\DataTables;
use App\Enums\CourseType;

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

    public function index()
    {
        $types = CourseType::cases();
        return view('admin.course.index', compact('types'));
    }

    public function dataTable()
    {
        $results = $this->courseRepository->dataTable();
        return DataTables::of($results)->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'slug' => 'required|string|unique:courses,slug',
            'type' => 'required|string',
            'coming_soon' => 'boolean'
        ]);

        try {
            $data = $request->only(['slug', 'type']);
            $data['coming_soon'] = $request->boolean('coming_soon');
            $data['status'] = true;
            $data['sort'] = Course::max('sort') + 1;
            
            $this->courseRepository->store($data);
            return response()->json(['message' => 'Course created successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'slug' => 'required|string|unique:courses,slug,' . $course->id,
            'type' => 'required|string',
            'coming_soon' => 'boolean'
        ]);

        try {
            $data = $request->only(['slug', 'type']);
            $data['coming_soon'] = $request->boolean('coming_soon');
            $this->courseRepository->update($data, $course);
            return response()->json(['message' => 'Course updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function status(string $id)
    {
        try {
            $this->courseRepository->status($id);
            return response()->json(['message' => 'Course status updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function sort(Request $request)
    {
        try {
            $this->courseRepository->sort($request->all());
            return response()->json(['message' => 'Course sort updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
