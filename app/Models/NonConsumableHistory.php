<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NonConsumableHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'non_consumable_id',
        'employee_id',
        'date_of_lending',
        'due_by_date',
        'condition_of_property',
        'reason_for_lending',
        'returned_date',
        'returned_notes'
    ];
}
