<?php
namespace App\Http\Requests\Hadith;

use Illuminate\Foundation\Http\FormRequest;

class HadithVerseTranslationStoreRequest extends FormRequest
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
            'hadith_verse_id'  => 'required|exists:hadith_verses,id',
            'lang'             => 'required|in:' . implode(',', array_keys(config('app.languages'))),
            'narrator'         => 'nullable|string|max:500',
            'heading'          => 'nullable|string',
            'text'             => 'required|string',
            'status_romanized' => 'nullable|string|max:100',
        ];
    }
}
