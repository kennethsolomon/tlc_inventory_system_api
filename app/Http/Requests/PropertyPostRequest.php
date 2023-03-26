<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropertyPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
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
            'serial_number' => 'required|string',
            'purchase_date' => 'required|string',
            // 'warranty_period' => 'required|string',
            'brand' => 'required|string',
            'model' => 'required|string',
            'category' => 'required|string',
            'description' => 'required|string',
            'maintenance' => 'string',
            'maintenance_description' => 'string',

            'assigned_to' => 'nullable|string',
            'location' => 'nullable|string',
            'status' => 'nullable|string',
        ];
    }
}
