<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConsumableHistoryPostRequest extends FormRequest
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
            'consumable_id' => 'required|exists:App\Models\Consumable,id',
            'received_by_id' => 'required|exists:App\Models\Employee,id',
            'agency' => 'requried|string',
            'check_out_date' => 'required|string',
            'quantity' => 'required|integer',
        ];
    }
}
