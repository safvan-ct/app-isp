<?php
namespace App\Http\Requests\LessonContent;

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
     */
    public function rules(): array
    {
        $contentId = $this->route('content') ? $this->route('content')->id : $this->id;

        return [
            'lesson_id'         => ['required', 'exists:lessons,id'],
            'lang'              => [
                'required',
                'string',
                'max:10',
                Rule::unique('lesson_contents')->where(function ($query) {
                    return $query->where('lesson_id', $this->lesson_id);
                })->ignore($contentId),
            ],
            'notes'             => ['nullable', 'string'],
            'key_notes'         => ['nullable', 'array'],
            'key_notes.*.title' => ['nullable', 'string', 'max:255'],
            'key_notes.*.desc'  => ['nullable', 'string'],
            'status'            => ['nullable', 'boolean'],
        ];
    }
}
