<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_no',
        'lender_name',
        'lender_agency',
        'lender_designation',
        'borrower_name',
        'borrower_agency',
        'borrower_designation',
        'start_date',
        'end_date',
        'purpose_of_loan',
        'condition',
    ];
}
