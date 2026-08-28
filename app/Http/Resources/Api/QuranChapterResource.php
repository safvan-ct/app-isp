<?php
namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuranChapterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if ($request->boolean('minimal')) {
            $translation = $this->translations->first();
            return [
                'id'          => $this->id,
                'slug'        => $this->slug,
                'title'       => $translation?->name_tr ?? $this->name,
                'translation' => $translation?->name ?? '',
                'name'        => $this->name,
            ];
        }

        return [
            'id'           => $this->id,
            'slug'         => $this->slug,
            'name'         => $this->name,
            'revelation'   => $this->revelation,
            'no_of_verses' => $this->no_of_verses,
            'juz'          => $this->juz,
            'translations' => QuranChapterTranslationResource::collection($this->whenLoaded('translations')),
        ];
    }
}
