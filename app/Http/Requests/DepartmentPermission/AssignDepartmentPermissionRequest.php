<?php

namespace App\Http\Requests\DepartmentPermission;

use Illuminate\Foundation\Http\FormRequest;

class AssignDepartmentPermissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Adjust this based on your authorization logic
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'role_id' => 'required|exists:roles,id',
            'permission_ids' => 'required|exists:permissions,id',
            'department_id' => 'required|exists:departments,id',
        ];
    }
}
