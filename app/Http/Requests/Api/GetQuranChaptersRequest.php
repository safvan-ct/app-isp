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
            'all'          => ['nullable', 'boolean'],
            'minimal'      => ['nullable', 'boolean'],
            'revelation'   => ['nullable', 'string', 'in:all,mecca,meccan,median,medinan'],
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $merge = [];
        if ($this->has('all')) {
            $merge['all'] = filter_var($this->input('all'), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
        }
        if ($this->has('minimal')) {
            $merge['minimal'] = filter_var($this->input('minimal'), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
        }
        if ($this->has('active')) {
            $merge['active'] = filter_var($this->input('active'), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
        }
        if ($this->has('revelation')) {
            $merge['revelation'] = strtolower($this->input('revelation'));
        }

        if (! empty($merge)) {
            $this->merge($merge);
        }
    }
}
