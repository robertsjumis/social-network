<?php

namespace App\Http\Controllers;

use App\FriendLink;
use App\Http\Requests\UploadImage;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function edit(User $user) // shows edit page
    {
        return view('/users/edit', ["user" => $user]);
    }

    public function show(User $user) // shows user's profile page
    {
        $showEditProfileButton = auth()->user() == $user ? true : false;

        //gathers friends
        $friendsIds = FriendLink::where("friend1_id", $user->id)
            ->pluck("friend2_id")
            ->toArray();

        $friends = [];

        foreach ($friendsIds as $friendId) {
            $friends[] = User::find($friendId);
        }

        return view("/users/profile", [
            "user" => $user,
            "showEditProfileButton" => $showEditProfileButton,
            "friends" => $friends
            ]); //TODO: pārtaisīt uz slug. pamācība pieejama day22/app/user.php failā
    }

    public function index() // show all
    {

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
        $userFillable = key(request()->only($user->getFillable()));

        $newValue = current(request()->only($user->getFillable()));

        $user->$userFillable = $newValue;

        $user->save();

        return redirect(route("edit.profile", ["user" => $user]));
    }

    public function destroy() // deletes the user
    {

    }
}
