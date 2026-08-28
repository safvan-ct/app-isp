<?php
namespace App\Http\Requests\Hadith;

use Illuminate\Foundation\Http\FormRequest;

class HadithChapterTranslationStoreRequest extends FormRequest
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
        return [
            'hadith_chapter_id' => 'required|exists:hadith_chapters,id',
            'lang'              => 'required|in:' . implode(',', array_diff(array_keys(config('app.languages')), ['ar'])),
            'name'              => 'required|string|max:500',
            'name_romanized'    => 'nullable|string|max:500',
            'description'       => 'nullable|string',
        ];
    }
}
