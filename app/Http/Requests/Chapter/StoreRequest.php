<?php
namespace App\Http\Requests\Chapter;

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
        $chapterId = $this->route('chapter')?->id ?? $this->input('id');
        $courseId  = $this->input('course_id') ?? $this->route('chapter')?->course_id;

        return [
            'course_id' => [$chapterId ? 'nullable' : 'required', 'exists:courses,id'],
            'slug'      => [
                'required',
                'string',
                'max:255',
                Rule::unique('chapters', 'slug')
                    ->where(fn($q) => $q->where('course_id', $courseId))
                    ->ignore($chapterId),
            ],
        ];
    }
}
