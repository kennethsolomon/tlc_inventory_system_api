<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NonConsumableHistoryResource extends JsonResource
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
            'non_consumable_id' => $this->non_consumable_id,
            'employee_id' => $this->employee_id,
            'date_of_lending' => $this->date_of_lending,
            'due_by_date' => $this->due_by_date,
            'condition_of_property' => $this->condition_of_property,
            'reason_for_lending' => $this->reason_for_lending,
            'returned_date' => $this->returned_date,
            'returned_notes' => $this->returned_notes,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
