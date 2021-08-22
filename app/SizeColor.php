<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SizeColor extends Model
{
    protected $guarded = [];

    function relationwithproduct()
    {
        return $this->hasOne('App\Product', 'id', 'product_id');
    }
}
