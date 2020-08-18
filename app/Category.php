<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class,'categories_product');
    }

    public function brands()
    {
        return $this->belongsToMany(Brand::class,'brand');
    }

    public function subcategories()
    {
        return $this->belongsToMany(Subcategory::class,'subcategories_category');
    }
}
