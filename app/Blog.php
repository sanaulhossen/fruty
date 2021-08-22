<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $guarded = [];

    // Likes
    public function likes()
    {
        return $this->hasMany('App\LikeDislike', 'post_id')->sum('like');
    }
    // Dislikes
    public function dislikes()
    {
        return $this->hasMany('App\LikeDislike', 'post_id')->sum('dislike');
    }

    function relation_with_blog_category()
    {
        return $this->hasOne(BlogCategory::class, 'id', 'blogCategory_id');
    }

    function relation_with_user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

}
