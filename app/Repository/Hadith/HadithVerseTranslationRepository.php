<?php
namespace App\Repository\Hadith;

use App\Models\HadithVerseTranslation;

class HadithVerseTranslationRepository implements HadithVerseTranslationInterface
{
    public function getById($id)
    {
        return HadithVerseTranslation::find($id);
    }

    public function dataTable($verseId)
    {
        return HadithVerseTranslation::where('hadith_verse_id', $verseId)
            ->select('id', 'hadith_verse_id', 'lang', 'narrator', 'heading', 'text', 'status_romanized', 'is_active', 'created_at');
    }

    public function updateOrCreate(array $data, ?HadithVerseTranslation $hadithVerseTranslation = null): HadithVerseTranslation
    {
        $fillable = ['hadith_verse_id', 'lang', 'narrator', 'heading', 'text', 'status_romanized', 'created_by', 'is_active'];
        $payload  = array_intersect_key($data, array_flip($fillable));

        return HadithVerseTranslation::updateOrCreate(['id' => $hadithVerseTranslation?->id], $payload);
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
