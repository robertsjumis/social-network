<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'body', "created_by"
    ];

    public function user()
    {
        return $this->belongsTo(User::class, "id");
    }

//    public function likes()
//    {
//        return $this->morphToMany(Like::class, "liked_content", "likes", "like_id", "id");
//    }

}
