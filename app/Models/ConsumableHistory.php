<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsumableHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'consumable_id',
        'received_by_id',

        'agency',
        'check_out_date',
        'quantity'
    ];

    protected $appends = ['consumable_info', 'received_by_info'];

    public function getConsumableInfoAttribute()
    {
        return Consumable::find($this->consumable_id);
    }

    public function getReceivedByInfoAttribute()
    {
        return Employee::find($this->received_by_info);
    }

    public function consumable()
    {
        return $this->belongsTo(Consumable::class);
    }
}
