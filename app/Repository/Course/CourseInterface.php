<?php
namespace App\Repository\Course;

use App\Models\Course;
use Illuminate\Database\Eloquent\Builder;

interface CourseInterface
{
    public function dataTable(): Builder;
    public function store(array $data): Course;
    public function update(array $data, Course $course): bool;
    public function status(Course|string $course): bool;
    public function sort(array $data): void;
    public function getTypes(): array;
}
