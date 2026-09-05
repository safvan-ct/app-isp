<?php
namespace App\Repository\Course;

use App\Models\Chapter;
use App\Models\ChapterTranslation;
use Illuminate\Database\Eloquent\Builder;

class ChapterTranslationRepository implements ChapterTranslationInterface
{
    public function dataTable(int | string $chapterId): Builder
    {
        return ChapterTranslation::query()
            ->where('chapter_id', $chapterId)
            ->select([
                'id',
                'chapter_id',
                'lang',
                'title',
                'status',
            ]);
    }

    public function getChapter(int | string $chapterId): Chapter
    {
        return Chapter::with('course')->findOrFail($chapterId);
    }

    public function find(int | string $id): ?ChapterTranslation
    {
        return ChapterTranslation::find($id);
    }

    public function store(array $data): ChapterTranslation
    {
        $data['status'] = $data['status'] ?? true;

        return ChapterTranslation::create($data);
    }

    public function update(array $data, ChapterTranslation $translation): bool
    {
        return $translation->update($data);
    }

    public function status(ChapterTranslation | string $translation): bool
    {
        if (! $translation instanceof ChapterTranslation) {
            $translation = ChapterTranslation::findOrFail($translation);
        }

        return $translation->update(['status' => ! $translation->status]);
    }
}
