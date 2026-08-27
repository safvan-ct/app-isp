<?php
namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HadithChapterTranslationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                     => $this->id,
            'hadith_chapter_id'      => $this->hadith_chapter_id,
            'lang'                   => $this->lang,
            'name'                   => $this->name,
            'name_romanized'         => $this->name_romanized,
            'description'            => $this->description,
            'hadith_count_romanized' => $this->hadith_count_romanized,
            // 'is_active'              => $this->is_active,
        ];
    }
}
