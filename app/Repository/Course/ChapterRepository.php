<?php
namespace App\Repository\Course;

use App\Models\Chapter;
use App\Models\Course;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ChapterRepository implements ChapterInterface
{
    public function dataTable(?int $courseId = null): Builder
    {
        $locale = app()->getLocale();

        return Chapter::query()
            ->when($courseId, fn($q) => $q->where('chapters.course_id', $courseId))
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
                'chapters.course_id',
                'chapters.slug',
                'chapters.sort',
                'chapters.status',
                'chapter_translations.title as title',
                'course_translations.title as course_title',
                'courses.slug as course_slug',
            ]);
    }

    public function getCourse(int | string $courseId): Course
    {
        return Course::findOrFail($courseId);
    }

    public function getCourses(): Collection
    {
        $locale = app()->getLocale();

        return Course::query()
            ->leftJoin('course_translations', function ($join) use ($locale) {
                $join->on('courses.id', '=', 'course_translations.course_id')
                    ->where('course_translations.lang', '=', $locale);
            })
            ->select([
                'courses.id',
                'courses.slug',
                'course_translations.title as title',
            ])
            ->get();
    }

    public function find(int | string $id): ?Chapter
    {
        return Chapter::find($id);
    }

    public function store(array $data): Chapter
    {
        $data['status'] = $data['status'] ?? true;
        $maxSort        = Chapter::where('course_id', $data['course_id'])->max('sort') ?? 0;
        $data['sort']   = $maxSort + 1;

        return Chapter::create($data);
    }

    public function update(array $data, Chapter $chapter): bool
    {
        return $chapter->update($data);
    }

    public function status(Chapter | string $chapter): bool
    {
        if (! $chapter instanceof Chapter) {
            $chapter = Chapter::findOrFail($chapter);
        }

        return $chapter->update(['status' => ! $chapter->status]);
    }

    public function sort(array $data): void
    {
        DB::transaction(function () use ($data) {
            foreach ($data as $item) {
                if (isset($item['id'], $item['sort'])) {
                    Chapter::where('id', $item['id'])->update(['sort' => $item['sort']]);
                }
            }
        });
    }
}
