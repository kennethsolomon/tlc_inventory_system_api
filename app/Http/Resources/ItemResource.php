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
            'id' => (int)$this->id,
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
            'transaction_status' => $this->transaction_status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
            'assigned_person_info' => [
                'id' => (string)$this->assigned_person_info->id,
                'fname' => $this->assigned_person_info->fname,
                'mname' => $this->assigned_person_info->mname,
                'lname' => $this->assigned_person_info->lname,
                'office' => $this->assigned_person_info->office,
            ],
            'received_by_info' => [
                'id' => (string)$this->received_by_info->id,
                'fname' => $this->received_by_info->fname,
                'mname' => $this->received_by_info->mname,
                'lname' => $this->received_by_info->lname,
                'office' => $this->received_by_info->office,
            ],
            'received_from_info' => [
                'id' => (string)$this->received_from_info->id,
                'fname' => $this->received_from_info->fname,
                'mname' => $this->received_from_info->mname,
                'lname' => $this->received_from_info->lname,
                'office' => $this->received_from_info->office,
            ],
            'item_category_info' => [
                'id' => (string)$this->item_category_info->id,
                'name' => $this->item_category_info->name,
            ],
            'item_status' => ItemStatusResource::collection($this->whenLoaded('item_status')),
            'location_info' => [
                'id' => (string)$this->location_info->id,
                'name' => $this->location_info->name,
            ],
        ];
    }
}
