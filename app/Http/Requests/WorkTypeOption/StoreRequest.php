<?php

namespace App\Http\Requests\WorkTypeOption;

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
            'work_type_id' => 'required|exists:work_types,id',
            'option_value' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'work_type_id.required' => 'The work type ID is required.',
            'work_type_id.exists' => 'The selected work type ID does not exist.',
            'option_value.required' => 'The option value is required.',
            'option_value.string' => 'The option value must be a string.',
            'option_value.max' => 'The option value may not be greater than 255 characters.',
        ];
    }
}
