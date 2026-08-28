<?php
namespace App\Http\Requests\Hadith;

use Illuminate\Foundation\Http\FormRequest;

class HadithBookTranslationStoreRequest extends FormRequest
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
            'lang'                => 'required|in:' . implode(',', array_keys(config('app.languages'))),
            'name'                => 'required|string|max:255',
            'name_romanized'      => 'nullable|string|max:255',
            'writer'              => 'required|string|max:255',
            'writer_romanized'    => 'nullable|string|max:255',
            'life_span_romanized' => 'nullable|string|max:255',
            'status_romanized'    => 'nullable|string|max:255',
            'description'         => 'nullable|string',
            'hadith_book_id'      => 'required|exists:hadith_books,id',
        ];
    }
}
