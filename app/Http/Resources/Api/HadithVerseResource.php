<?php
namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HadithVerseResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'hadith_book_id'    => $this->hadith_book_id,
            'hadith_chapter_id' => $this->hadith_chapter_id,
            'chapter_number'    => $this->chapter_number,
            'hadith_number'     => $this->hadith_number,
            'heading'           => $this->heading,
            'text'              => $this->text,
            'volume'            => $this->volume,
            'status'            => $this->status,
            // 'is_active'         => $this->is_active,
            'translations'      => HadithVerseTranslationResource::collection($this->whenLoaded('translations')),
        ];
    }
}
