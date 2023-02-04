<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NonConsumableHistoryPostRequest extends FormRequest
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
            'non_consumable_id' => 'required|exists:App\Models\NonConsumable,id',
            'employee_id' => 'required|exists:App\Models\Employee,id',
            'date_of_lending' => 'required|string',
            'due_by_date' => 'required|string',
            'condition_of_property' => 'required|string',
            'reason_for_lending' => 'required|string',
            'returned_date' => 'required|string',
            'returned_notes' => 'required|string',
        ];
    }
}
