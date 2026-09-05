<?php
namespace App\Http\Requests\Course;

use App\Enums\CourseType;
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
        $courseId = $this->route('course')?->id ?? $this->input('id');

        return [
            'slug'        => ['required', 'string', 'max:255', Rule::unique('courses', 'slug')->ignore($courseId)],
            'type'        => ['required', Rule::enum(CourseType::class)],
            'coming_soon' => ['nullable', 'boolean'],
        ];
    }
}
