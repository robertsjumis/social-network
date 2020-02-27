<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = [
        "liked_by_id", "liked_content_id", "liked_content_type"
    ];
}
