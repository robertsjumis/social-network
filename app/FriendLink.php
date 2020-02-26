<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FriendLink extends Model
{
    protected $fillable = [
        "friend1_id", "friend2_id"
    ];
}
