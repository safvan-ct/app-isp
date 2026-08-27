<?php
namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HadithBookResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'slug'          => $this->slug,
            'abbreviation'  => $this->abbreviation,
            'writer'        => $this->writer,
            'status'        => $this->status,
            'group'         => $this->group,
            'life_span'     => $this->life_span,
            'chapter_count' => $this->chapter_count,
            'hadith_count'  => $this->hadith_count,
            // 'priority'      => $this->priority,
            // 'is_active'     => $this->is_active,
            'translations'  => HadithBookTranslationResource::collection($this->whenLoaded('translations')),
        ];
    }
}
