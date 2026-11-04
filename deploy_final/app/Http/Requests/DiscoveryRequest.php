<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DiscoveryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'city' => ['nullable', 'string', 'max:255'],
            'age' => ['nullable', Rule::in(['all', '18-24', '25-34', '35-44', '45+'])],
            'min_age' => ['nullable', 'integer', 'min:18', 'max:120'],
            'max_age' => ['nullable', 'integer', 'min:18', 'max:120'],
            'age_min' => ['nullable', 'integer', 'min:18', 'max:120'],
            'age_max' => ['nullable', 'integer', 'min:18', 'max:120'],
        ];
    }
}
