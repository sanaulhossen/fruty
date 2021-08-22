<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = ['slider_title','slider_sub_title','slider_description','slider_photo'];

    function SliderTorelationwithuser(){
    	return $this->hasOne('App\User','id','user_id');
    }
}
