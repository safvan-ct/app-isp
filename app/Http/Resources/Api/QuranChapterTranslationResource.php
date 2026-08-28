<?php
namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuranChapterTranslationResource extends JsonResource
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
            'quran_chapter_id'       => $this->quran_chapter_id,
            'lang'                   => $this->lang,
            'name'                   => $this->name,
            'name_tr'                => $this->name_tr,
            'revelation_romanized'   => $this->revelation_romanized,
            'no_of_verses_romanized' => $this->no_of_verses_romanized,
            'juz_romanized'          => $this->juz_romanized,
            'direction'              => $this->direction,
        ];
    }
}
