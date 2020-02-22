<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'last_name', 'email', 'password', "address", "image_location", "phone", "bio", "birthday"
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function image_location(): string
    {
        return $this->image_location ? asset($this->image_location) : asset("/default_profile_pic.jpg");
    }

    public function phone(): string
    {
        return $this->phone ?? "Not yet defined";
    }

    public function birthday(): string
    {
        return $this->birthday ?? "Not yet defined";
    }

    public function bio(): string
    {
        return $this->bio ?? "Not yet defined";
    }

    public function address(): string
    {
        return $this->address ?? "Not yet defined";
    }


}
