<?php
namespace App\Repository\Course;

use App\Enums\CourseType;
use App\Models\Course;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class CourseRepository implements CourseInterface
{
    public function dataTable(): Builder
    {
        $locale = app()->getLocale();

        return Course::query()
            ->leftJoin('course_translations', function ($join) use ($locale) {
                $join->on('courses.id', '=', 'course_translations.course_id')
                    ->where('course_translations.lang', '=', $locale);
            })
            ->select([
                'courses.id',
                'courses.slug',
                'courses.type',
                'courses.sort',
                'courses.status',
                'courses.coming_soon',
                'course_translations.title as title',
            ]);
    }

    public function store(array $data): Course
    {
        $data['coming_soon'] = ! empty($data['coming_soon']);
        $data['status']      = $data['status'] ?? true;
        $data['sort']        = (Course::max('sort') ?? 0) + 1;

        return Course::create($data);
    }

    public function update(array $data, Course $course): bool
    {
        if (array_key_exists('coming_soon', $data)) {
            $data['coming_soon'] = ! empty($data['coming_soon']);
        }

        return $course->update($data);
    }

    public function status(Course|string $course): bool
    {
        if (! $course instanceof Course) {
            $course = Course::findOrFail($course);
        }

        return $course->update(['status' => ! $course->status]);
    }

    public function sort(array $data): void
    {
        DB::transaction(function () use ($data) {
            foreach ($data as $item) {
                if (isset($item['id'], $item['sort'])) {
                    Course::where('id', $item['id'])->update(['sort' => $item['sort']]);
                }
            }
        });
    }

    public function getTypes(): array
    {
        return CourseType::cases();
    }
}
