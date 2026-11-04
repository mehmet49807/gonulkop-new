<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SettingsUpdateRequest extends FormRequest
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
            'email_notifications' => ['sometimes', 'boolean'],
            'push_notifications' => ['sometimes', 'boolean'],
            'new_match_notifications' => ['sometimes', 'boolean'],
            'message_notifications' => ['sometimes', 'boolean'],
            'profile_visibility' => ['sometimes', 'required', Rule::in(['public', 'members', 'private'])],
            'show_online' => ['sometimes', 'boolean'],
            'show_location' => ['sometimes', 'boolean'],
        ];
    }
}
