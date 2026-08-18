<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Meal extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'meals';
    protected $fillable = ['category_id', 'name', 'slug', 'description', 'price', 'image', 'created_at', 'updated_at'];

    protected $casts = [
        'price' => 'float',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
