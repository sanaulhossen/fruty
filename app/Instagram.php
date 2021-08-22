<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instagram extends Model
{
    protected $guarded = [];
    function relation_with_user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
