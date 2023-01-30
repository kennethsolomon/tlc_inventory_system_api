<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConsumablePostRequest extends FormRequest
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
            'property_name' => 'string',
            'description' => 'required|string',
            'cost' => 'required|integer',
            'quantity' => 'required|integer',
            'unit_of_measure' => 'required|string',
        ];
    }
}
