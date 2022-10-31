<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemPostRequest extends FormRequest
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
            'type' => 'required|string',
            'property_name' => 'required|string',
            'purchaser' => 'required|string',
            'property_code' => 'required|string',
            'description' => 'required|string',
            'serial_number' => 'required|string',
            'date_acquired' => 'required|date',
            'date_received' => 'required|date',
            'quantity' => 'required|integer',
            'cost' => 'required|integer',

            'location_id' => 'required|exists:App\Models\Location,id',
            'item_category_id' => 'required|exists:App\Models\ItemCategory,id',
            'received_by_id' => 'required|exists:App\Models\Employee,id',
            'received_from_id' => 'required|exists:App\Models\Employee,id',
            'assigned_person_id' => 'required|exists:App\Models\Employee,id',
            'item_status_id' => 'required|exists:App\Models\ItemStatus,id',
        ];
    }
}
