<?php
namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class GetQuranChaptersRequest extends FormRequest
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
            'chapter_name' => ['nullable', 'string', 'max:255'],
            'translation'  => ['nullable', 'string', 'max:10'],
            'active'       => ['nullable', 'boolean'],
            'per_page'     => ['nullable', 'integer', 'min:1', 'max:100'],
            'cursor'       => ['nullable', 'string'],
            'page'         => ['nullable', 'integer', 'min:1'],
        ];
    }
}
