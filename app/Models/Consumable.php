<?php

namespace App\Models;

use Exception;
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
    public static function boot()
    {
        parent::boot();

        self::updating(function ($model) {
            info($model->quantity);
            if ($model->quantity < 0) {
                throw new Exception("Not enough stock, Invalid Operation.", 500);
            }
        });
    }

    public function consumableHistories()
    {
        return $this->hasMany(ConsumableHistory::class);
    }
}
