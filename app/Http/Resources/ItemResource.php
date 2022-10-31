<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
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
            'type' => (string)$this->type,
            'property_name' => (string)$this->property_name,
            'purchaser' => (string)$this->purchaser,
            'property_code' => (string)$this->property_code,
            'description' => (string)$this->description,
            'serial_number' => (string)$this->serial_number,
            'date_acquired' => $this->date_acquired,
            'date_received' => $this->date_received,
            'quantity' => $this->quantity,
            'cost' => $this->cost,
            'location_id' => $this->location_id,
            'item_category_id' => $this->item_category_id,
            'received_by_id' => $this->received_by_id,
            'received_from_id' => $this->received_from_id,
            'assigned_person_id' => $this->assigned_person_id,
            'item_status_id' => $this->item_status_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
