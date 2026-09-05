<?php
namespace App\Http\Requests\LessonReferenceHadith;

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
            'lesson_reference_id' => ['required', 'exists:lesson_references,id'],
            'hadith_verse_id'     => ['required', 'exists:hadith_verses,id'],
            'verse_no'            => ['required', 'integer', 'min:1'],
            'status'              => ['nullable', 'boolean'],
        ];
    }
}
