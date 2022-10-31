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
