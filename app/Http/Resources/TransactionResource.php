<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
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
            'condition' => $this->condition,
            'transfer_type' => $this->transfer_type,
            'transfer_type_others' => $this->transfer_type_others,
            'reason_for_transfer' => $this->reason_for_transfer,
            'received_by' => $this->received_by,
            'borrower_designation' => $this->borrower_designation,
            'borrower_agency' => $this->borrower_agency,
            'received_from' => $this->received_from,
            'lender_designation' => $this->lender_designation,
            'lender_agency' => $this->lender_agency,
            'approved_by' => $this->approved_by,
            'approver_designation' => $this->approver_designation,
            'item_data' => $this->item_data,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
