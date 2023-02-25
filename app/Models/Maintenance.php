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
        'assigned_to',
        'location',
        'has_been_disposed',
        'has_been_fixed'
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}