<?php
namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HadithBookTranslationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                      => $this->id,
            'hadith_book_id'          => $this->hadith_book_id,
            'lang'                    => $this->lang,
            'name'                    => $this->name,
            'name_romanized'          => $this->name_romanized,
            'writer'                  => $this->writer,
            'writer_romanized'        => $this->writer_romanized,
            'status_romanized'        => $this->status_romanized,
            'life_span_romanized'     => $this->life_span_romanized,
            'chapter_count_romanized' => $this->chapter_count_romanized,
            'hadith_count_romanized'  => $this->hadith_count_romanized,
            'description'             => $this->description,
            // 'is_active'               => $this->is_active,
        ];
    }
}
