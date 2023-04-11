<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ConsumableHistoryResource extends JsonResource
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
            'consumable_id' => $this->consumable_id,
            'received_by_id' => $this->received_by_id,
            'agency' => $this->agency,
            'check_out_date' => (string)$this->check_out_date,
            'quantity' => (string)$this->quantity,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'consumable_info' => [
                'id' => (string)$this->consumable_info->id,
                'property_code' => $this->consumable_info->property_code,
                'property_name' => $this->consumable_info->property_name,
                'description' => $this->consumable_info->description,
                'cost' => $this->consumable_info->cost,
                'quantity' => $this->consumable_info->quantity,
                'unit_of_measure' => $this->consumable_info->unit_of_measure,
            ],
        ];
    }
}
