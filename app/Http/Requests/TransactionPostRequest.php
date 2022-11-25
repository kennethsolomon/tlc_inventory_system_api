<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionPostRequest extends FormRequest
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
            'transaction_no' => 'string',
            'condition' => 'string',
            'transfer_type' => 'string',
            'transfer_type_others' => 'nullable|string',
            'reason_for_transfer' => 'string',
            'received_by' => 'string',
            'borrower_designation' => 'string',
            'borrower_agency' => 'string',
            'received_from' => 'string',
            'lender_designation' => 'string',
            'lender_agency' => 'string',
            'approved_by' => 'string',
            'approver_designation' => 'string',
            'item_data' => 'array',
        ];
    }
}
