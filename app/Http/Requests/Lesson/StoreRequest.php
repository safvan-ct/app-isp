<?php
namespace App\Http\Requests\Lesson;

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
        $lessonId  = $this->route('lesson')?->id ?? $this->input('id');
        $chapterId = $this->input('chapter_id') ?? $this->route('lesson')?->chapter_id;

        return [
            'chapter_id' => [$lessonId ? 'nullable' : 'required', 'exists:chapters,id'],
            'slug'       => [
                'required',
                'string',
                'max:255',
                Rule::unique('lessons', 'slug')
                    ->where(fn($q) => $q->where('chapter_id', $chapterId))
                    ->ignore($lessonId),
            ],
        ];
    }
}
