<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NonConsumableResource extends JsonResource
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
            'property_code' => $this->property_code,
            'property_name' => $this->property_name,
            'description' => $this->description,
            'serial_number' => $this->serial_number,
            'cost' => $this->cost,
            'location' => $this->location,
            'date_of_purchased' => $this->date_of_purchased,
            'warranty_expiration' => $this->warranty_expiration,
            'life_expectancy' => $this->life_expectancy,
            'status' => $this->status,
            'assigned_to' => $this->assigned_to,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            // 'assigned_to_info' => [
            //     'id' => (string)$this->assigned_to_info->id,
            //     // 'name' => $this->item_category_info->name,
            // ],
        ];
    }
}
