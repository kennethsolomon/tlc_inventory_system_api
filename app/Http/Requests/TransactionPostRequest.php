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
            'transaction_no' => 'nullable|string',
            'condition' => 'nullable|string',
            'transfer_type' => 'nullable|string',
            'transfer_type_others' => 'nullable|string',
            'reason_for_transfer' => 'nullable|string',
            'received_by' => 'nullable|string',
            'borrower_designation' => 'nullable|string',
            'borrower_agency' => 'nullable|string',
            'received_from' => 'nullable|string',
            'lender_designation' => 'nullable|string',
            'lender_agency' => 'nullable|string',
            'approved_by' => 'nullable|string',
            'approver_designation' => 'nullable|string',
            'item_data' => 'nullable|array',

            'deleted_at' => 'nullable',
        ];
    }
}
