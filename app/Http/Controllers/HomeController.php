<?php

namespace App\Http\Controllers;

use App\Post;
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

        $posts = DB::table("posts")->select("*")->orderBy("created_at", "desc")->get();

        //$content = DB::table("galleries")->select("id", "created_at", "created_by")->orderBy("created_at", "desc")->union($posts)->get();

        //Post::join("galleries", 'posts.created_at', '=', 'galleries.created_at')->select("*")->get();

        //var_dump($content);

        $users = DB::table("users")->get("*");

        return view("main", ["users" => $users, "user" => $user, "posts" => $posts]);
    }
}
