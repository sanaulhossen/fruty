<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
	protected $guarded = [];

    function relationwithuser(){
    	return $this->hasOne('App\User','id','user_id');
    }
    
    function relationwithproduct(){
    	return $this->hasMany('App\Product','product_type_id', 'id');
    }
}
