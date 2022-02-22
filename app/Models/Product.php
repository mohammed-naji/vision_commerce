<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class)->withDefault();
    }

    public function rates()
    {
        return $this->hasMany(Rate::class);
    }

    public function features()
    {
        return $this->hasMany(Feature::class);
    }
}
