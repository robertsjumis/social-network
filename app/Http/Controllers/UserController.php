<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function edit(User $user) // shows edit page
    {
        return view('/edit', ["user" => $user]);
    }

    public function show(User $user) // shows user's profile page
    {
        return view("/profile", ["user" => $user]); //TODO: pārtaisīt uz slug. pamācība pieejama day22/app/user.php failā
    }

    public function index() // show all
    {

    }

    public function update(User $user) // post request in edit page
    {
        // TODO: japieliek validacija bildei, image un dimensijas. to dara, izveidojot request klasi pgp artisanmake:request, un tajaa ievietojot validatoru, lidzigi kaa paroleem

        $image_path = Storage::url(request()->file("image")->store("/public/profile_pictures"));

        $user->image_location = $image_path;

        $user->save();

        return redirect("/" . $user->id);
    }

    public function destroy() // deletes the user
    {

    }
}
