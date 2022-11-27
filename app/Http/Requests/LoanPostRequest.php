<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoanPostRequest extends FormRequest
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
            'lender_name' => 'string',
            'lender_agency' => 'string',
            'lender_designation' => 'string',
            'borrower_name' => 'string',
            'borrower_agency' => 'string',
            'borrower_designation' => 'string',
            'start_date' => 'string',
            'end_date' => 'string',
            'purpose_of_loan' => 'string',
            'condition' => 'string',
            'item_data' => 'array',

            'deleted_at' => 'nullable',
        ];
    }
}
