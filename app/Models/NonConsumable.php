<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NonConsumable extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_code',
        'property_name',
        'description',
        'serial_number',
        'cost',
        'location',
        'date_of_purchased',
        'warranty_expiration',
        'life_expectancy',
        'status',
        'assigned_to'
    ];

    public function nonConsumableHistories()
    {
        return $this->hasMany(NonConsumableHistory::class);
    }
}
