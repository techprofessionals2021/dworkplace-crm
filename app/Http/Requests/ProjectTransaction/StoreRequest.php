<?php

namespace App\Http\Requests\ProjectTransaction;

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
        'projectable_id'      => 'required|integer',
        'projectable_type'    => 'required|string',
        'user_id'             => 'required|integer',
        'payment_method_id'   => 'required|integer',
        'currency_id'         => 'required|integer',
        'date'                => 'required|date',
        'amount'              => 'required|integer',
        ];
    }
}
