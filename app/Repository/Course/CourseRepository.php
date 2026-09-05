<?php
namespace App\Repository\Course;

use App\Models\Course;
use App\Models\CourseTranslation;
use Illuminate\Support\Facades\DB;

class CourseRepository implements CourseInterface
{
    public function dataTable()
    {
        return Course::with(['translations' => function ($query) {
            $query->where('lang', app()->getLocale());
        }])->orderBy('sort')->get()->map(function ($course) {
            $translation = $course->translations->first();
            return [
                'id' => $course->id,
                'slug' => $course->slug,
                'title' => $translation ? $translation->title : null,
                'type' => $course->type->label(),
                'status' => $course->status,
                'coming_soon' => $course->coming_soon,
                'sort' => $course->sort,
            ];
        });
    }

    public function store(array $data)
    {
        return Course::create($data);
    }

    public function update(array $data, Course $course)
    {
        return $course->update($data);
    }

    public function status(string $id)
    {
        $course = Course::findOrFail($id);
        return $course->update(['status' => !$course->status]);
    }

    public function sort(array $data)
    {
        DB::transaction(function () use ($data) {
            foreach ($data as $item) {
                Course::where('id', $item['id'])->update(['sort' => $item['sort']]);
            }
        });
    }
}
