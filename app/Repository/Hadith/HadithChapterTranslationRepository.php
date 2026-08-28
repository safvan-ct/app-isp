<?php
namespace App\Repository\Hadith;

use App\Models\HadithChapterTranslation;

class HadithChapterTranslationRepository implements HadithChapterTranslationInterface
{
    public function getById($id)
    {
        return HadithChapterTranslation::find($id);
    }

    public function dataTable($chapterId)
    {
        return HadithChapterTranslation::where('hadith_chapter_id', $chapterId)
            ->select('id', 'hadith_chapter_id', 'lang', 'name', 'name_romanized', 'description', 'is_active', 'created_at');
    }

    public function updateOrCreate(array $data, ?HadithChapterTranslation $hadithChapterTranslation = null): HadithChapterTranslation
    {
        $fillable = ['hadith_chapter_id', 'lang', 'name', 'name_romanized', 'description', 'created_by', 'is_active'];
        $payload  = array_intersect_key($data, array_flip($fillable));

        return HadithChapterTranslation::updateOrCreate(['id' => $hadithChapterTranslation?->id], $payload);
    }

    public function status($id)
    {
        $query = $this->getById($id);
        if (! $query) {
            throw new \Exception('Item not found');
        }

        $query->update(['is_active' => ! $query->is_active]);
        return $query;
    }
}
