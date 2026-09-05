<?php
namespace App\Repository\Course;

use App\Models\Course;
use App\Models\CourseTranslation;
use App\Models\Instructor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class CourseTranslationRepository implements CourseTranslationInterface
{
    public function dataTable(int | string $courseId): Builder
    {
        return CourseTranslation::query()
            ->where('course_id', $courseId)
            ->select([
                'id',
                'course_id',
                'lang',
                'title',
                'desc',
                'objectives',
                'key_points',
                'duration',
                'author_id',
                'status',
            ]);
    }

    public function getCourse(int | string $courseId): Course
    {
        return Course::findOrFail($courseId);
    }

    public function find(int | string $id): ?CourseTranslation
    {
        return CourseTranslation::find($id);
    }

    public function getInstructors(): Collection
    {
        return Instructor::active()->select(['id', 'name'])->get();
    }

    public function store(array $data): CourseTranslation
    {
        $data['status'] = $data['status'] ?? true;

        if (isset($data['key_points']) && ! is_array($data['key_points'])) {
            $data['key_points'] = json_decode($data['key_points'], true) ?? [];
        }

        return CourseTranslation::create($data);
    }

    public function update(array $data, CourseTranslation $translation): bool
    {
        if (isset($data['key_points']) && ! is_array($data['key_points'])) {
            $data['key_points'] = json_decode($data['key_points'], true) ?? [];
        }

        return $translation->update($data);
    }

    public function status(CourseTranslation | string $translation): bool
    {
        if (! $translation instanceof CourseTranslation) {
            $translation = CourseTranslation::findOrFail($translation);
        }

        return $translation->update(['status' => ! $translation->status]);
    }
}
