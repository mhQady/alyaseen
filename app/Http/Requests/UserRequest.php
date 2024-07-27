<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|min:3|max:255',
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($this->admin)],
            'password' => ['nullable', 'min:6', 'max:255', Rule::requiredIf(!(bool) $this->admin)],
            'roles' => ['array', 'min:1'],
            'roles.*' => ['string', 'exists:roles,name'],
        ];
    }

    public function validated($keys = null, $default = null): array
    {
        $data = parent::validated($keys, $default);

        if (!isset($data['password']))
            unset($data['password']);

        return $data;
    }
}
