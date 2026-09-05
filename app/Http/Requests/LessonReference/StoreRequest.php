<?php
namespace App\Http\Requests\LessonReference;

use Illuminate\Foundation\Http\FormRequest;

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
     */
    public function rules(): array
    {
        return [
            'lesson_id'              => ['required', 'exists:lessons,id'],
            'title'                  => ['required', 'string', 'max:255'],
            'simplified'             => ['nullable', 'string'],
            'translations'           => ['nullable', 'array'],
            'translations.*.lang'    => ['nullable', 'string', 'max:10'],
            'translations.*.text'    => ['nullable', 'string'],
            'status'                 => ['nullable', 'boolean'],
        ];
    }
}
