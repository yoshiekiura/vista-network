<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HPImage extends Model
{
    protected $fillable = [
        'product_id','image'
    ];

    public function image(){
        return $this->belongsTo(HashPower::class);
    }
}
