<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'fname',
        'mname',
        'lname',
        'office',
    ];
    protected $appends = ['fullname'];

    public function getFullnameAttribute()
    {
        return $this->fname . ' ' . $this->mname . ' ' . $this->lname;
    }
}
