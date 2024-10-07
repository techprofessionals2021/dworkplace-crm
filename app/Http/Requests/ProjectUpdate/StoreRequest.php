<?php

namespace App\Http\Requests\ProjectUpdate;

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
            'projectable_type' => 'required|string',
            'projectable_id' => 'required',
            'user_id' => 'required|exists:users,id',
            'status_id' => 'required|exists:statuses,id',
            'deadline' => 'required',
            'message' => 'required|string'
        ];
    }
}
