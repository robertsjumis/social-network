<?php

namespace App\Http\Controllers;

use App\Follower;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();

        $posts = DB::table("posts")
            ->crossJoin("followers", "posts.created_by", "=", "followers.follows_to_id")
            ->select("*")
            ->orderBy("posts.created_at", "desc")
            ->get();
                
        $users = DB::table("users")->get("*");

        return view("main", ["users" => $users, "user" => $user, "posts" => $posts]);
    }
}
