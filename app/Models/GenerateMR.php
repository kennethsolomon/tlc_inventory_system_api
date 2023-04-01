<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenerateMR extends Model
{
    use HasFactory;

    protected $fillable = [
        'selected',
        'type',
    ];

    protected $casts = [
        'selected' => 'array',
    ];

    protected $appends = ['mr_number', 'f_date'];

    public function getMrNumberAttribute()
    {
        return 'MIS' . '-' . $this->created_at->format('Y') . '-' . sprintf("%03s", $this->id);
    }

    public function getFDateAttribute()
    {
        return $this->created_at->format('F d, Y');
    }
}
