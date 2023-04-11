<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LoanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => (string)$this->id,
            'transaction_no' => $this->transaction_no,
            'lender_name' => $this->lender_name,
            'lender_agency' => $this->lender_agency,
            'lender_designation' => $this->lender_designation,
            'borrower_agency' => $this->borrower_agency,
            'borrower_designation' => $this->borrower_designation,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'purpose_of_loan' => $this->purpose_of_loan,
            'condition' => $this->condition,
            'item_data' => $this->item_data,
            'created_at' => $this->created_at,
            'deleted_at' => $this->deleted_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
