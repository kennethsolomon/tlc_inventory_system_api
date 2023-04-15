<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'type',
        'property_name',
        'purchaser',
        'property_code',
        'description',
        'serial_number',
        'date_acquired',
        'date_received',
        'quantity',
        'cost',
        // With Relationships
        'location_id',
        'item_category_id',
        'received_by_id',
        'received_from_id',
        'assigned_person_id',
        'item_status_id',
        'deleted_at',
    ];

    protected $appends = ['assigned_person_info', 'item_category_info', 'item_status_info', 'location_info'];

    // protected static function boot()
    // {
    //     parent::boot();

    //     $closure = function ($questionnaire) {
    //         // Code here
    //     };

    //     static::created($closure);

    //     static::updated($closure);

    //     static::deleted($closure);
    // }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            $model->formatPropertyCode($model);
            $model->addItemList($model);
            $model->addItemCategoryCount($model);
        });

        // static::updated(function ($model) {
        //     $model->addItemList($model);
        // });
    }

    // Appends
    public function getAssignedPersonInfoAttribute()
    {
        return Employee::find($this->assigned_person_id);
    }

    public function getReceivedFromInfoAttribute()
    {
        return Employee::find($this->received_from_id);
    }
    public function getReceivedByInfoAttribute()
    {
        return Employee::find($this->received_by_id);
    }

    public function getItemCategoryInfoAttribute()
    {
        return ItemCategory::find($this->item_category_id);
    }

    public function getItemStatusInfoAttribute()
    {
        return ItemStatus::find($this->item_status_id);
    }

    public function getLocationInfoAttribute()
    {
        return Location::find($this->location_id);
    }


    // Relationships
    public function location()
    {
        return $this->hasOne(Location::class);
    }

    public function itemCategory()
    {
        return $this->hasOne(ItemCategory::class);
    }

    public function receivedBy()
    {
        return $this->hasOne(Employee::class);
    }

    public function receivedFrom()
    {
        return $this->hasOne(Employee::class);
    }

    public function assignedPerson()
    {
        return $this->hasOne(Employee::class);
    }

    public function status()
    {
        return $this->hasOne(ItemStatus::class);
    }

    public function formatPropertyCode($model)
    {
        Item::update(['property_code' => $model->property_code . str_pad($model->id, 5, '0', STR_PAD_LEFT)]);
    }

    public function addItemList($model)
    {
        $item_list = ItemList::whereDescription($model->description);

        if ($item_list->exists()) {
            $item_list_data = $item_list->first();
            $item_list_data->quantity +=  1;
            $item_list_data->save();
        } else {
            $item_list_data = new ItemList;
            $item_list_data->property_name = $model->property_name;
            $item_list_data->description = $model->description;
            $item_list_data->cost = $model->cost;
            $item_list_data->type = $model->type;
            $item_list_data->purchaser = $model->purchaser;
            $item_list_data->item_category_id = $model->item_category_id;
            $item_list_data->quantity = 1;
            $item_list_data->save();
        }
    }

    public function addItemCategoryCount($model)
    {
        $item_category = ItemCategory::whereId($model->item_category_id)->first();

        $item_category->count += 1;
        if ($model->type == 'Consumable') {
            $item_category->consumable_count += 1;
        } else if ($model->type == 'Non-Consumable') {
            $item_category->non_consumable_count += 1;
        }
        $item_category->save();
    }
}
