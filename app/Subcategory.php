<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $fillable = [
        'name'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class,'subcategories_product');
    }

    public function brands()
    {
        return $this->belongsToMany(Brand::class,'brand');
    }

    public function categories()
    {
        return $this->belongsToMany(Brand::class,'brand');
    }
}
