<?php

namespace App\Http\Requests\Currency;

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
            'symbol' => 'nullable|string',
            'conversion_rate' => 'nullable|float'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Currency name is required.',
            'name.string' => 'Name of Currecy is required',
            'name.max' => 'Name of currency should not exceed 255 characeters',
            'symbol.string' => 'Symbol of currency should only be a special character or currency symbol'
        ];
    }
}
