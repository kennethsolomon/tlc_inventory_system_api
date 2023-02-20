<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PropertyResource extends JsonResource
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
            'id' => $this->id,
            'property_code' => $this->property_code,
            'serial_number' => $this->serial_number,
            'purchase_date' => $this->purchase_date,
            'warranty_period' => $this->warranty_period,
            'brand' => $this->brand,
            'model' => $this->model,
            'category' => $this->category,
            'description' => $this->description,
            'assigned_to' => $this->assigned_to,
            'location' => $this->location,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'deleted_at' => $this->deleted_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
