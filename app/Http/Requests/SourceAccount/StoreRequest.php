<?php

namespace App\Http\Requests\SourceAccount;

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
            'username' => 'nullable|string|max:255',
            'email'=>    'nullable|string|email',
            'brand_id' => 'required|exists:brands,id',
        ];
    }
}