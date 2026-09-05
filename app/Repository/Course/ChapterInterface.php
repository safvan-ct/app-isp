<?php
namespace App\Repository\Course;

use App\Models\Chapter;
use App\Models\Course;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

interface ChapterInterface
{
    public function dataTable(?int $courseId = null): Builder;
    public function getCourse(int | string $courseId): Course;
    public function getCourses(): Collection;
    public function find(int | string $id): ?Chapter;
    public function store(array $data): Chapter;
    public function update(array $data, Chapter $chapter): bool;
    public function status(Chapter | string $chapter): bool;
    public function sort(array $data): void;
}
