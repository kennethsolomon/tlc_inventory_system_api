<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;

class Transaction extends Model
{
    use HasFactory;
    use SoftDeletes;

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

                $item_ = Item::find($item['id']);
                $item_->transaction_status = 'transfered';
                $item_->save();

                Log::debug($item_list);
                if ($item_list->quantity > 0) {
                    $item_list->quantity -= 1;
                    $item_list->save();
                } else {
                    throw new Exception("Not enough stock, Invalid Operation.", 500);
                }
            }
        });
        self::deleted(function ($model) {
            foreach ($model->item_data as $key => $item) {
                $item_list = ItemList::whereDescription($item['description'])->first();
                $item_list->quantity += 1;
                $item_list->save();
            }
        });
    }
}
