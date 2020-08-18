<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InfoProduct extends Model
{
    protected $fillable = [
        'description', 'information', 'image', 'product_id', 'price', 'priceId', 'url_ml', 'url_am', 'url_ms'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
}
