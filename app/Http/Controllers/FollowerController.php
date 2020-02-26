<?php

namespace App\Http\Controllers;

use App\Follower;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function store(int $followToId)
    {
        $user = auth()->user();

        Follower::create([
            "follower_id" => $user->id,
            "follows_to_id" => $followToId
        ]);

        return redirect(route("user.profile", $followToId));
    }
}
