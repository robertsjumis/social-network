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

    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }


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
/* kaa uztaisit slug url:
jaunu user kontolieri,
show(User $user) {
[$id, $name] = explode("-", $slug);

return User;
}

jaunu route:
Route::get("/{user}", "UsersConstroller@show"); sho routu vajag pedejo lapaa

vai

show(string $slug) {
[$id, $name] = explode("-", $slug);

return User::findOrFail($id);
}

jaunu route:
Route::get("/{slug}", "UsersConstroller@show"); sho routu vajag pedejo lapaa


--route binding:

RouteServiceProvider

boot()

Route::bind("user , function($value) {
return User::where("name",..... no dokumentacijas

*/
