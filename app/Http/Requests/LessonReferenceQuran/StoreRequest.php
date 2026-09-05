<?php
namespace App\Http\Requests\LessonReferenceQuran;

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
            'surah_id'            => ['required', 'exists:quran_chapters,id'],
            'verse_no'            => ['required', 'integer', 'min:1'],
            'status'              => ['nullable', 'boolean'],
        ];
    }
}
