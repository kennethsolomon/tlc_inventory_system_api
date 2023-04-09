<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MaintenanceResource extends JsonResource
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
            'user_id' => $this->user_id,
            'property_id' => $this->property_id,
            'property_code' => $this->property_code,
            'category' => $this->category,
            'category' => $this->category,
            'purchase_date' => $this->purchase_date,
            // 'warranty_period' => $this->warranty_period,
            'assigned_to' => $this->assigned_to,
            'location' => $this->location,
            'has_been_disposed' => $this->has_been_disposed,
            'has_been_fixed' => $this->has_been_fixed,
            'custodian' => $this->custodian,
            'is_approved' => $this->is_approved,
            'notes' => $this->notes,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'frequency' => $this->frequency,
            'part' => $this->part,
            'schedule_date' => $this->schedule_date,
            'flagged_date' => $this->flagged_date,
            'description' => $this->description,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
