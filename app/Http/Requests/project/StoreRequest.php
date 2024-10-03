<?php

namespace App\Http\Requests\project;

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
    // public function rules(): array
    // {
    //     return [
    //         'general' => 'required|array',
    //         'financial' => 'required|array',
    //         'other.departments' => 'required|array',
    //         'other.salespersons' => 'required|array',
    //         // 'attachments'=>'required|array',
    //         // 'work_types' => 'nullable|array',
    //     ];
    // }
    public function rules(): array
    {
        return [
            'general' => 'required|array',
            'financial' => 'required|array',
            'other.departments' => 'required|array',
            'other.salespersons' => 'required|array',
            'attachments' => 'array', // Make sure this is present
            // 'attachments.*' => 'file|mimes:jpg,png,pdf,docx', // Validate the file types
        ];
    }




}
