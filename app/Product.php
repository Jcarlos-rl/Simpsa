<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title', 'code', 'priceDis', 'pricePub', 'stripeId', 'brand_id', 'slug'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class,'brand_id');
    }

    public function info()
    {
        return $this->hasOne(InfoProduct::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class,'categories_product');
    }

    public function subcategories()
    {
        return $this->belongsToMany(Subcategory::class,'subcategories_product');
    }

    public function labels()
    {
        return $this->belongsToMany(Label::class,'labels_product');
    }

    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }
}
