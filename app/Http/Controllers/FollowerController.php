<?php

namespace App\Http\Controllers;

use App\Follower;
use App\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function store(User $user)
    {
        $follower = auth()->user();

        Follower::create([
            "follower_id" => $follower->id,
            "follows_to_id" => $user->id
        ]);

        return redirect(route("user.profile", $user->slug));
    }

    public function unfollow(User $user)
    {
        $follower = auth()->user();

        Follower::where(["follower_id" => $follower->id],["follows_to_id" => $user->id])->delete();

        return redirect(route("user.profile", $user->slug));
    }
}
