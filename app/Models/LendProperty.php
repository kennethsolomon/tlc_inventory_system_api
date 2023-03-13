<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LendProperty extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'property_code',
        'category',
        'date_of_lending',
        'borrower_id',
        'borrower_name',
        'location',
        'reason_for_lending',
        'is_lend',
        'user_id',
        'returned_date'
    ];
}
