<?php
namespace App\Repository\Course;

use App\Models\Chapter;
use App\Models\Lesson;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class LessonRepository implements LessonInterface
{
    public function dataTable(?int $chapterId = null): Builder
    {
        $locale = app()->getLocale();

        return Lesson::query()
            ->when($chapterId, fn($q) => $q->where('lessons.chapter_id', $chapterId))
            ->leftJoin('chapters', 'lessons.chapter_id', '=', 'chapters.id')
            ->leftJoin('chapter_translations', function ($join) use ($locale) {
                $join->on('chapters.id', '=', 'chapter_translations.chapter_id')
                    ->where('chapter_translations.lang', '=', $locale);
            })
            ->leftJoin('courses', 'chapters.course_id', '=', 'courses.id')
            ->leftJoin('course_translations', function ($join) use ($locale) {
                $join->on('courses.id', '=', 'course_translations.course_id')
                    ->where('course_translations.lang', '=', $locale);
            })
            ->leftJoin('lesson_translations', function ($join) use ($locale) {
                $join->on('lessons.id', '=', 'lesson_translations.lesson_id')
                    ->where('lesson_translations.lang', '=', $locale);
            })
            ->select([
                'lessons.id',
                'lessons.chapter_id',
                'lessons.slug',
                'lessons.sort',
                'lessons.status',
                'lesson_translations.title as title',
                'chapter_translations.title as chapter_title',
                'chapters.slug as chapter_slug',
                'course_translations.title as course_title',
                'courses.slug as course_slug',
            ]);
    }

    public function getChapter(int | string $chapterId): Chapter
    {
        return Chapter::with('course')->findOrFail($chapterId);
    }

    public function getChapters(): Collection
    {
        $locale = app()->getLocale();

        return Chapter::query()
            ->leftJoin('courses', 'chapters.course_id', '=', 'courses.id')
            ->leftJoin('course_translations', function ($join) use ($locale) {
                $join->on('courses.id', '=', 'course_translations.course_id')
                    ->where('course_translations.lang', '=', $locale);
            })
            ->leftJoin('chapter_translations', function ($join) use ($locale) {
                $join->on('chapters.id', '=', 'chapter_translations.chapter_id')
                    ->where('chapter_translations.lang', '=', $locale);
            })
            ->select([
                'chapters.id',
                'chapters.slug',
                'chapter_translations.title as title',
                'courses.slug as course_slug',
                'course_translations.title as course_title',
            ])
            ->get();
    }

    public function find(int | string $id): ?Lesson
    {
        return Lesson::find($id);
    }

    public function store(array $data): Lesson
    {
        $data['status'] = $data['status'] ?? true;
        $maxSort        = Lesson::where('chapter_id', $data['chapter_id'])->max('sort') ?? 0;
        $data['sort']   = $maxSort + 1;

        return Lesson::create($data);
    }

    public function update(array $data, Lesson $lesson): bool
    {
        return $lesson->update($data);
    }

    public function status(Lesson | string $lesson): bool
    {
        if (! $lesson instanceof Lesson) {
            $lesson = Lesson::findOrFail($lesson);
        }

        return $lesson->update(['status' => ! $lesson->status]);
    }

    public function sort(array $data): void
    {
        DB::transaction(function () use ($data) {
            foreach ($data as $item) {
                if (isset($item['id'], $item['sort'])) {
                    Lesson::where('id', $item['id'])->update(['sort' => $item['sort']]);
                }
            }
        });
    }
}
