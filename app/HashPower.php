<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HashPower extends Model
{
    protected $fillable = [
        'title','price','description','status','created_at','updated_at'
    ];

    public function product(){
        return $this->hasMany(HPImage::class, 'product_id', 'id');
    }

    public function hptransaction()
    {
        return $this->belongsTo(HashPower::class)->withDefault();
    }
}
