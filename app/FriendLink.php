<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FriendLink extends Model
{
    protected $fillable = [
        "friend1_id", "friend2_id"
    ];

    public function user()
    {
        return $this->belongsTo(User::class, "id");
    }

    public function users()
    {
        return $this->hasMany(User::class, "id");
    }
}
