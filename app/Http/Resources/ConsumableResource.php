<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ConsumableResource extends JsonResource
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
            'cost' => (string)$this->cost,
            'quantity' => (string)$this->quantity,
            'unit_of_measure' => (string)$this->unit_of_measure,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
