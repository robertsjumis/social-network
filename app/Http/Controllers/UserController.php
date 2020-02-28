<?php

namespace App\Http\Controllers;

use App\FriendLink;
use App\Gallery;
use App\Http\Requests\UploadImage;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function edit(User $user) // shows edit page
    {
        return view('/users/edit', ["user" => $user]);
    }

    public function show(User $viewedUser) // shows user's profile page
    {
        $user = auth()->user();

        $showEditProfileButton = $user == $viewedUser ? true : false;

        //gathers friends
        $friends = $viewedUser->friendsTo()->get();

        //gathers galleries
        $galleries = $viewedUser->galleries()->get();

        //gathers posts
        $posts = Post::where("created_by", $viewedUser->id)->get();

        return view("/users/profile", [
            "user" => $user,
            "viewedUser" => $viewedUser,
            "showEditProfileButton" => $showEditProfileButton,
            "friends" => $friends,
            "galleries" => $galleries,
            "posts" => $posts
        ]);
    }

    public function updateImage(UploadImage $request, User $user) // post request in edit page
    {
        $user->update([
            "image_location" => request()->file("image")->store("profile_pictures", "public")
        ]);

        $user->save();

        return redirect(route("edit.profile", ["user" => $user]));
    }

    public function update(User $user) //TODO: jāuztaisa Request klasi, kas validē inputus
    {
        $user->update([
            "name" => request()->name,
            "last_name" => request()->last_name,
            "email" => request()->email,
            "address" => request()->address,
            "phone" => request()->phone,
            "bio" => request()->bio,
            "birthday" => request()->birthday,
            "slug" => request()->name . request()->last_name . "-" . $user->id,
            "updated_at" => NOW()
        ]);

        return redirect(route("edit.profile", ["user" => $user]));
    }

    public function updatePassword(User $user)
    {
        $user->update([
            'password' => Hash::make(request()->password),
        ]);
        return redirect(route("edit.profile", ["user" => $user]));
    }

}
