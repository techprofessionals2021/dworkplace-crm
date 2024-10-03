<?php

namespace App\Http\Requests\project;

use Illuminate\Foundation\Http\FormRequest;

class ThreadRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'parent_id' => 'nullable|exists:project_threads,id',
            'threadable_type' => 'required|string',
            'threadable_id' => 'required',
            'message' => 'required|string',
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
