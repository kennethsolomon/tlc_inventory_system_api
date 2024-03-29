<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_code',
        'serial_number',
        'purchase_date',
        // 'warranty_period',
        'brand',
        'unit_cost',
        'model',
        'category',
        'description',
        'assigned_to',
        'location',
        'status',
        'init_transfer',
        'maintenance',
        'maintenance_description',
        'reason_for_lending',
    ];


    public function propertyHistories()
    {
        return $this->hasMany(PropertyHistory::class);
    }

    public function lends()
    {
        return $this->hasMany(Lend::class);
    }

    public function maintenances()
    {
        return $this->hasMany(Maintenance::class);
    }
}
