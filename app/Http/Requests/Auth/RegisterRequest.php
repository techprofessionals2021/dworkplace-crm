<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'contact' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'role_ids' => 'sometimes|array',
            'role_ids.*' => 'exists:roles,id', // Ensure each role ID exists
            'department_ids' => 'sometimes|array',
            'department_ids.*' => 'exists:departments,id', // Ensure each department ID exists

        ];
    }
}
