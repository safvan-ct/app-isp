<?php
namespace App\Repository\Course;

use App\Models\Lesson;
use App\Models\LessonTranslation;
use Illuminate\Database\Eloquent\Builder;

interface LessonTranslationInterface
{
    public function dataTable(int | string $lessonId): Builder;
    public function getLesson(int | string $lessonId): Lesson;
    public function find(int | string $id): ?LessonTranslation;
    public function store(array $data): LessonTranslation;
    public function update(array $data, LessonTranslation $translation): bool;
    public function status(LessonTranslation | string $translation): bool;
}
