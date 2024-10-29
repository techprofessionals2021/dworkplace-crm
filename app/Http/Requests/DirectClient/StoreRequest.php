<?php

namespace App\Http\Requests\DirectClient;

use Illuminate\Foundation\Http\FormRequest;

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
        return [
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'contact' => 'nullable|string|max:20'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The client name is required.',
            'name.string' => 'The client name must be a string.',
            'name.max' => 'The client name may not be greater than 255 characters.',
            'email.email' => 'The email must be a valid email address.',
            'email.max' => 'The email may not be greater than 255 characters.',
            'contact.string' => 'The contact must be a string.',
            'contact.max' => 'The contact may not be greater than 20 characters.',
        ];
    }
}
