<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'subtotal', 'shipping', 'total', 'channel', 'payment', 'slug'
    ];

    public function items()
    {
        return $this->hasMany(ItemsOrder::class);
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }

}
