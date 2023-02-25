<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LendPropertyResource extends JsonResource
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
            'property_id' => $this->property_id,
            'property_code' => $this->property_code,
            'category' => $this->category,
            'date_of_lending' => $this->date_of_lending,
            'borrower_name' => $this->borrower_name,
            'location' => $this->location,
            'reason_for_lending' => $this->reason_for_lending,
            'is_lend' => $this->is_lend,
            'returned_date' => $this->returned_date,
            'created_at' => $this->created_at,
            'deleted_at' => $this->deleted_at,
            'updated_at' => $this->updated_at,
        ];
    }
}