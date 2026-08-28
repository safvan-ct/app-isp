<?php
namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuranVerseTranslationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'quran_chapter_id'  => $this->quran_chapter_id,
            'quran_verse_id'    => $this->quran_verse_id,
            'number_in_chapter' => $this->number_in_chapter,
            'lang'              => $this->lang,
            'text'              => $this->text,
            'text_romanized'    => $this->text_romanized,
            'direction'         => $this->direction,
        ];
    }
}
