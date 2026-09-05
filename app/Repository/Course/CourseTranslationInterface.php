<?php
namespace App\Repository\Course;

use App\Models\Course;
use App\Models\CourseTranslation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

interface CourseTranslationInterface
{
    public function dataTable(int|string $courseId): Builder;
    public function getCourse(int|string $courseId): Course;
    public function find(int|string $id): ?CourseTranslation;
    public function getInstructors(): Collection;
    public function store(array $data): CourseTranslation;
    public function update(array $data, CourseTranslation $translation): bool;
    public function status(CourseTranslation|string $translation): bool;
}
