<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'property_name',
        'purchaser',
        'property_code',
        'description',
        'serial_number',
        'date_acquired',
        'date_received',
        'quantity',
        'cost',
        // With Relationships
        'location_id',
        'item_category_id',
        'received_by_id',
        'received_from_id',
        'assigned_person_id',
        'item_status_id',
    ];

    protected $appends = ['assigned_person_info', 'item_category_info', 'item_status_info', 'location_info'];

    // Appends
    public function getAssignedPersonInfoAttribute()
    {
        return Employee::find($this->assigned_person_id);
    }

    public function getReceivedFromInfoAttribute()
    {
        return Employee::find($this->received_from_id);
    }
    public function getReceivedByInfoAttribute()
    {
        return Employee::find($this->received_by_id);
    }

    public function getItemCategoryInfoAttribute()
    {
        return ItemCategory::find($this->item_category_id);
    }

    public function getItemStatusInfoAttribute()
    {
        return ItemStatus::find($this->item_status_id);
    }

    public function getLocationInfoAttribute()
    {
        return Location::find($this->location_id);
    }


    // Relationships
    public function location()
    {
        return $this->hasOne(Location::class);
    }

    public function itemCategory()
    {
        return $this->hasOne(ItemCategory::class);
    }

    public function receivedBy()
    {
        return $this->hasOne(Employee::class);
    }

    public function receivedFrom()
    {
        return $this->hasOne(Employee::class);
    }

    public function assignedPerson()
    {
        return $this->hasOne(Employee::class);
    }

    public function status()
    {
        return $this->hasOne(ItemStatus::class);
    }
}
