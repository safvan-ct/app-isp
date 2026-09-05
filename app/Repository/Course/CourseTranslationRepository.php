<?php
namespace App\Repository\Course;

use App\Models\CourseTranslation;

class CourseTranslationRepository implements CourseTranslationInterface
{
    public function dataTable(string $course_id)
    {
        return CourseTranslation::where('course_id', $course_id)->with('author')->get();
    }

    public function store(array $data)
    {
        return CourseTranslation::create($data);
    }

    public function update(array $data, CourseTranslation $translation)
    {
        return $translation->update($data);
    }

    public function status(string $id)
    {
        $translation = CourseTranslation::findOrFail($id);
        return $translation->update(['status' => !$translation->status]);
    }
}
