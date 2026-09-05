<?php
namespace App\Http\Requests\LessonTranslation;

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
        $translationId = $this->route('lesson_translation')?->id ?? $this->input('id');
        $lessonId      = $this->input('lesson_id') ?? $this->route('lesson_translation')?->lesson_id;

        return [
            'lesson_id' => [$translationId ? 'nullable' : 'required', 'exists:lessons,id'],
            'lang'      => [
                'required',
                'string',
                'max:10',
                Rule::unique('lesson_translations', 'lang')
                    ->where(fn($q) => $q->where('lesson_id', $lessonId))
                    ->ignore($translationId),
            ],
            'title'     => ['required', 'string', 'max:255'],
            'desc'      => ['nullable', 'string'],
        ];
    }
}
