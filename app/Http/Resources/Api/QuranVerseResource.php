<?php
namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuranVerseResource extends JsonResource
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
            'number_in_chapter' => $this->number_in_chapter,
            'text'              => $this->text,
            'juz'               => $this->juz,
            'manzil'            => $this->manzil,
            'ruku'              => $this->ruku,
            'hizb_quarter'      => $this->hizb_quarter,
            'sajda'             => $this->sajda,
            'translations'      => QuranVerseTranslationResource::collection($this->whenLoaded('translations')),
        ];
    }
}
