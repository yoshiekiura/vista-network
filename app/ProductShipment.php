<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductShipment extends Model
{
    protected $guarded = ['id'];

    public function ship_product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id')->withDefault();
    }

    public function ship_user()
    {
        return $this->hasOne(User::class, 'id', 'user_id')->withDefault();
    }
}
