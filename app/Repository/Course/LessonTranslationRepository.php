<?php
namespace App\Repository\Course;

use App\Models\Lesson;
use App\Models\LessonTranslation;
use Illuminate\Database\Eloquent\Builder;

class LessonTranslationRepository implements LessonTranslationInterface
{
    public function dataTable(int | string $lessonId): Builder
    {
        return LessonTranslation::query()
            ->where('lesson_id', $lessonId)
            ->select([
                'id',
                'lesson_id',
                'lang',
                'title',
                'desc',
                'status',
            ]);
    }

    public function getLesson(int | string $lessonId): Lesson
    {
        return Lesson::with(['chapter.course'])->findOrFail($lessonId);
    }

    public function find(int | string $id): ?LessonTranslation
    {
        return LessonTranslation::find($id);
    }

    public function store(array $data): LessonTranslation
    {
        $data['status'] = $data['status'] ?? true;

        return LessonTranslation::create($data);
    }

    public function update(array $data, LessonTranslation $translation): bool
    {
        return $translation->update($data);
    }

    public function status(LessonTranslation | string $translation): bool
    {
        if (! $translation instanceof LessonTranslation) {
            $translation = LessonTranslation::findOrFail($translation);
        }

        return $translation->update(['status' => ! $translation->status]);
    }
}
