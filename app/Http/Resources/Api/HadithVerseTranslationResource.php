<?php
namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HadithVerseTranslationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'              => $this->id,
            'hadith_verse_id' => $this->hadith_verse_id,
            'lang'            => $this->lang,
            'narrator'        => $this->narrator,
            'heading'         => $this->heading,
            'text'            => $this->text,
            'status'          => $this->status_romanized,
            // 'is_active'       => $this->is_active,
        ];
    }
}
