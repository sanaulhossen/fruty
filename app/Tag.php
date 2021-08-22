<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['tag_name','tag_description'];

    function relation_with_user(){

        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
