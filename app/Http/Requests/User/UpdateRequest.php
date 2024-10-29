<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
        $userId = $this->route('user'); 
        return [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($userId), // Ignore the current user's email
            ],
            'contact' => 'required|string|max:255',
            'role_ids' => 'sometimes|array',
            'role_ids.*' => 'exists:roles,id', // Ensure each role ID exists
            'department_ids' => 'sometimes|array',
            'department_ids.*' => 'exists:departments,id', // Ensure each department ID exists

        ];
    }
}
