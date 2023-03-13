<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
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
        'is_approved',
        'notes',
    ];
    protected $appends = ['flagged_date'];

    public function getFlaggedDateAttribute()
    {
        return $this->updated_at->toDayDateTimeString();
    }

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function scopeIsApproved($query)
    {
        return $query->whereIsApproved(true);
    }
}
