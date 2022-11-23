<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_no',
        'condition',
        'transfer_type',
        'received_by',
        'borrower_designation',
        'borrower_agency',
        'received_from',
        'lender_designation',
        'lender_agency',
        'approved_by',
        'approver_designation',
        'item_data',
    ];
}
