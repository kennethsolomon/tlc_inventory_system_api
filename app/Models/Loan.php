<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Loan extends Model
{
    use HasFactory;
    use SoftDeletes;

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
        'item_data',
        'deleted_at',
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
                $item_->delete();

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

                $item_ = Item::withTrashed()->find($item['id']);
                $item_->transaction_status = null;
                $item_->restore();
                $item_->save();
            }
        });
    }
}
