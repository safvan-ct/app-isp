<?php
namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HadithChapterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'hadith_book_id' => $this->hadith_book_id,
            'chapter_number' => $this->chapter_number,
            'slug'           => $this->slug,
            'name'           => $this->name,
            'hadith_count'   => $this->hadith_count,
            // 'sort'           => $this->sort,
            // 'is_active'      => $this->is_active,
            'translations'   => HadithChapterTranslationResource::collection($this->whenLoaded('translations')),
        ];
    }
}
