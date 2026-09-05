<?php
namespace App\Repository\Course;

use App\Models\Course;

interface CourseInterface
{
    public function dataTable();
    public function store(array $data);
    public function update(array $data, Course $course);
    public function status(string $id);
    public function sort(array $data);
}
