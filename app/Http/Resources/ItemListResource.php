<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemListResource extends JsonResource
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
            'description' => (string)$this->description,
            'purchaser' => (string)$this->purchaser,
            'quantity' => $this->quantity,
            'cost' => $this->cost,
            'item_category_id' => $this->item_category_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'item_category_info' => [
                'id' => (string)$this->item_category_info->id,
                'name' => $this->item_category_info->name,
            ],
        ];
    }
}
