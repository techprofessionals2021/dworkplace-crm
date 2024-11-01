<?php

namespace App\Http\Requests\Department;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Update this if authorization logic is needed
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $departmentId = $this->route('department') ?? $this->input('id');

        return [
            'manager_id' => 'nullable|exists:users,id',
            'parent_department_id' => 'nullable|exists:departments,id',
            'name' => 'required|string|max:255',
            'slug' => [
                'nullable',
                'string',
                'max:255',
                'unique:departments,slug,' . $departmentId,
            ],
            'description' => 'nullable|string',
            'status_id' => 'required|exists:statuses,id',
            'type' => 'required|in:department,team',
            'is_projectable' => 'required|boolean',
        ];
    }

    /**
     * Customize the validation error messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'The department name is required.',
            'name.string' => 'The department name must be a string.',
            'name.max' => 'The department name may not be greater than 255 characters.',
            'status_id.required' => 'The status ID is required.',
            'status_id.exists' => 'The selected status ID is invalid.',
            'type.required' => 'The type is required.',
            'type.in' => 'The type must be either department or team.',
            'is_projectable.required' => 'The projectable flag is required.',
            'is_projectable.boolean' => 'The projectable flag must be true or false.',
            // Add other custom messages if needed
        ];
    }
}
