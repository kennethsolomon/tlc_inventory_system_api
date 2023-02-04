<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NonConsumablePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'property_code' => 'required|string',
            'property_name' => 'required|string',
            'description' => 'required|string',
            'serial_number' => 'required|string',
            'cost' => 'required|integer',
            'location' => 'required|string',
            'date_of_purchased' => 'required|date',
            'warranty_expiration' => 'required|date',
            'end_of_life' => 'required|date',
            'status' => 'required|string',
            'assigned_to' => 'required|exists:App\Models\Employee,id',
        ];
    }
}
