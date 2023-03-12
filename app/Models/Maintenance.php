<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'property_code',
        'category',
        'purchase_date',
        'warranty_period',
        'assigned_to',
        'location',
        'has_been_disposed',
        'has_been_fixed',
        'custodian',
        'notes',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
