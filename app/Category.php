<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['category_name','category_description','category_photo'];

    function catrelationwithuser(){
    	return $this->hasOne('App\User','id','user_id');
    }

    function relationwithproduct()
    {
        return $this->hasOne('App\Product', 'id', 'category_id');
    }

}
