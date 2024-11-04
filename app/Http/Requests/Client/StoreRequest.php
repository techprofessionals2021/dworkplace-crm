<?php

namespace App\Http\Requests\Client;

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
        $clientId = $this->route('client') ?? $this->input('id');

        return [
            'source_account_id' => 'nullable|exists:source_accounts,id',
            'name' => 'required|string|max:255',
            'username' => [
                'nullable',
                'string',
                'max:255',
                'unique:clients,username,' . $clientId,
            ],
            'email' => ['nullable','email','max:255','unique:clients,email,' . $clientId,],
            'contact_no' => 'nullable|max:20',
        ];
    }

    public function messages()
    {
        return [
            'source_account_id.exists' => 'The selected source account is invalid.',
            'name.required' => 'Client name field is required.',
            'name.string' => 'Client name must be a string.',
            'name.max' => 'Client name may not be greater than 255 characters.',
            'username.required' => 'Client username field is required.',
            'username.string' => 'Client username must be a string.',
            'username.max' => 'Client username may not be greater than 255 characters.',
            'username.unique' => 'Client username has already been taken.',
            'email.email' => 'The email must be a valid email address.',
            'email.max' => 'The email may not be greater than 255 characters.',
            'contact_no.max' => 'The contact number may not be greater than 20 characters.',
        ];
    }
}
