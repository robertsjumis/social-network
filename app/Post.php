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
        $this->belongsTo(User::class);
    }

}
