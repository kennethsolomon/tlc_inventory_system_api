<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemList extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_name',
        'description',
        'cost',
        'type',
        'quantity',
        'purchaser',
        'item_category_id',
        'item_category_info'
    ];

    protected $appends = ['item_category_info'];

    public function getItemCategoryInfoAttribute()
    {
        return ItemCategory::find($this->item_category_id);
    }

    // Relationships
    public function itemCategory()
    {
        return $this->hasOne(ItemCategory::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
