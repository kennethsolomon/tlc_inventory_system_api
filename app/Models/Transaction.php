<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_no',
        'condition',
        'transfer_type',
        'reason_for_transfer',
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

    protected $casts = [
        'item_data' => 'array',
    ];

    public static function boot()
    {
        parent::boot();

        self::created(function ($model) {
            foreach ($model->item_data as $key => $item) {
                $item_list = ItemList::whereDescription($item['description'])->first();
                Log::debug($item_list);
                if ($item_list->quantity > 0) {
                    $item_list->quantity -= 1;
                    $item_list->save();
                } else {
                    throw new Exception("Not enough stock, Invalid Operation.", 500);
                }
            }
        });
    }
}
