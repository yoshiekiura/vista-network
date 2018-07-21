<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = ['id'];

    public function product(){
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    public function ship_pro()
    {
        return $this->belongsTo(ProductShipment::class)->withDefault();
    }

    public function product_trans()
    {
        return $this->belongsTo(Order::class)->withDefault();
    }

    public function installment()
    {
        return $this->belongsTo(PaymentInstallment::class)->withDefault();
    }
}
