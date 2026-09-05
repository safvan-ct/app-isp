<?php
namespace App\Repository\Course;

use App\Models\CourseTranslation;

interface CourseTranslationInterface
{
    public function dataTable(string $course_id);
    public function store(array $data);
    public function update(array $data, CourseTranslation $translation);
    public function status(string $id);
}
