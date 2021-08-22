<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   	protected $guarded = [];

   	function relationwithcategory(){
    	return $this->hasOne('App\Category','id','category_id');
    }

    function relationwithTag(){
    	return $this->hasOne('App\Tag','id','tag_id');
    }

    function relationwithtype(){
    	return $this->hasOne('App\ProductType','id','product_type_id');
    }

    function relationwithproduct_images(){
        return $this->hasMany('App\Product_image', 'product_id', 'id');
    }

}
