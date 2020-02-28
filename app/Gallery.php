<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = [
        'title', "created_by"
    ];

    public function user()
    {
        return $this->belongsTo(User::class, "id");
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
