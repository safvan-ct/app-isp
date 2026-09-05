<?php
namespace App\Http\Requests\ChapterTranslation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $translationId = $this->route('chapter_translation')?->id ?? $this->input('id');
        $chapterId     = $this->input('chapter_id') ?? $this->route('chapter_translation')?->chapter_id;

        return [
            'chapter_id' => [$translationId ? 'nullable' : 'required', 'exists:chapters,id'],
            'lang'       => [
                'required',
                'string',
                'max:10',
                Rule::unique('chapter_translations', 'lang')
                    ->where(fn($q) => $q->where('chapter_id', $chapterId))
                    ->ignore($translationId),
            ],
            'title'      => ['required', 'string', 'max:255'],
        ];
    }
}
