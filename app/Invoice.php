<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'rfc', 'razon_social', 'cfdi', 'calle', 'colonia', 'municipio', 'cp', 'estado', 'email', 'order_id'
    ];

    public function user()
    {
        return $this->belongsTo(Order::class,'order_id');
    }
}
