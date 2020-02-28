<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = [
        "liked_by_id", "liked_content_id", "liked_content_type"
    ];

    public function user()
    {
        return $this->belongsTo(User::class, "liked_by_id");
    }
}
