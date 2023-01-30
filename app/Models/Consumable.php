<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consumable extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_code',
        'property_name',
        'description',
        'cost',
        'quantity',
        'unit_of_measure'
    ];

    public function consumableHistories()
    {
        return $this->hasMany(ConsumableHistory::class);
    }
}
