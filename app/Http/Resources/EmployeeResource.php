<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
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
            'fullname' => $this->fullname,
            'fname' => $this->fname,
            'mname' => $this->mname,
            'lname' => (string)$this->lname,
            'office' => (string)$this->office,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
