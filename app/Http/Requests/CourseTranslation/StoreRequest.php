<?php
namespace App\Http\Requests\CourseTranslation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $translationId = $this->route('course_translation')?->id ?? $this->input('id');
        $courseId      = $this->input('course_id') ?? $this->route('course_translation')?->course_id;

        return [
            'course_id'  => [$translationId ? 'nullable' : 'required', 'exists:courses,id'],
            'lang'       => [
                'required',
                'string',
                'max:10',
                Rule::unique('course_translations', 'lang')
                    ->where(fn($query) => $query->where('course_id', $courseId))
                    ->ignore($translationId),
            ],
            'title'      => ['required', 'string', 'max:255'],
            'desc'       => ['nullable', 'string'],
            'objectives' => ['nullable'],
            'key_points' => ['nullable'],
            'duration'   => ['nullable', 'integer', 'min:0'],
            'author_id'  => ['nullable', 'exists:instructors,id'],
        ];
    }
}
