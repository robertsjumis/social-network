<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'last_name', 'email', 'password', "address", "image_location", "phone", "bio", "birthday", "slug"
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

    public function getRouteKeyName()
    {
        return "slug";
    }

//relations
    public function galleries()
    {
        return $this->hasMany(Gallery::class, "created_by");
    }

    public function posts()
    {
        return $this->hasMany(Post::class, "created_by");
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function friendsOf()
    {
        return $this->belongsToMany(
            User::class,
            'friend_links',
            'friend1_id',
            'friend2_id');
    }

    public function friendsTo()
    {
        return $this->belongsToMany(
            User::class,
            'friend_links',
            'friend2_id',
            'friend1_id');
    }

    public function follower()
    {
        return $this->belongsToMany(
            User::class,
            'followers',
            'follower_id',
            'follows_to_id');
    }

    public function followsTo()
    {
        return $this->belongsToMany(
            User::class,
            'followers',
            'follows_to_id',
            'follower_id');
    }

    public function friendInviteSenders()
    {
        return $this->belongsToMany(
            User::class,
            "friend_invitations",
            "invite_sender_id",
            "invite_recipient_id"
        );
    }

    public function friendInviteRecipients()
    {
        return $this->belongsToMany(
            User::class,
            "friend_invitations",
            "invite_recipient_id",
            "invite_sender_id"
        );
    }

// return fillables
    public function image_location(): string
    {
        return $this->image_location ? Storage::url($this->image_location, 'public') : asset("/default_profile_pic.jpg");
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
