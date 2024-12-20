<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'thumbnail_img',
        'product_cnt',
    ];

    // Relationship: A category has many products
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    // Increment or decrement product count when adding/removing products
    public function incrementProductCount()
    {
        $this->increment('product_cnt');
    }

    public function decrementProductCount()
    {
        if ($this->product_cnt > 0) {
            $this->decrement('product_cnt');
        }
    }
}

