<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemsOrder extends Model
{
    protected $fillable = [
        'price', 'quantity', 'order_id', 'product_id'
    ];

    public function order()
    {
        return $this->belongsTo(Orders::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
}
