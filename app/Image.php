<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    protected $fillable = [
        "gallery_id", "image_location"
    ];

    public function image_location(): string
    {
        return Storage::url($this->image_location, 'public');
    }

}


