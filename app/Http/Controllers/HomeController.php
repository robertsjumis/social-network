<?php

namespace App\Http\Controllers;

use App\Follower;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();

        $postAuthors = $user->follower()->get();

        $posts = DB::table("posts")
            ->select("*")
            ->whereIn("created_by", $postAuthors
                ->pluck("id")
                ->toArray())
            ->orderBy("created_at", "desc")
            ->get();

        return view("main", ["postAuthors" => $postAuthors, "user" => $user, "posts" => $posts]);
    }
}
