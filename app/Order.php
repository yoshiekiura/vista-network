<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'order_id',
        'user_id',
        'payment_type',
        'product_id',
        'product_price',
        'qty',
        'total',
        'status'
    ];

    public function member()
    {
        return $this->hasOne(User::class, 'id', 'user_id')->withDefault();
    }

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id')->withDefault();
    }
}
