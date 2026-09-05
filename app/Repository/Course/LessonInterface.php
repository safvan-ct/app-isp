<?php
namespace App\Repository\Course;

use App\Models\Chapter;
use App\Models\Lesson;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

interface LessonInterface
{
    public function dataTable(?int $chapterId = null): Builder;
    public function getChapter(int | string $chapterId): Chapter;
    public function getChapters(): Collection;
    public function find(int | string $id): ?Lesson;
    public function store(array $data): Lesson;
    public function update(array $data, Lesson $lesson): bool;
    public function status(Lesson | string $lesson): bool;
    public function sort(array $data): void;
}
