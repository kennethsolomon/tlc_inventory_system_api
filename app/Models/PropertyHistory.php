<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'transfer_date',
        'assigned_to',
        'location',
        'status',
    ];


    public function consumable()
    {
        return $this->belongsTo(Consumable::class);
    }

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

}
