<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = [
        'quantity','unit', 'warehouse', 'comments', 'product_id'
    ];
}
