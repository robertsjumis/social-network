<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    protected $fillable = [
      "follower_id", "follows_to_id"
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
