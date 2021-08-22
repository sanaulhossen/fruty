<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_Detail extends Model
{
    protected $guarded = [];

    function product(){
        return $this->belongsTo('App\Product');
    }

}
