<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Category extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'categories';
    protected $fillable = ['name', 'slug', 'description', 'created_at', 'updated_at'];

    public function meals()
    {
        return $this->hasMany(Meal::class, 'category_id');
    }
}
