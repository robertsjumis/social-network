<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{


    public function create()
    {
        $user = auth()->user();

        return view('/posts/create', ["user" => $user]);
    }

    public function store()
    {
        $user = auth()->user();

        $post = Post::create([
            'title' => request()->get("title"),
            'body' => request()->get("body"),
            "created_by" => $user->id,
            "created_at" => NOW()
        ]);

        return redirect("/");
    }

    public function index()
    {
        $user = auth()->user();

        $posts = DB::table("posts")->select("*")->orderBy("created_at", "desc")->get();

        $users = DB::table("users")->get("*");

        return view("main", ["users" => $users, "user" => $user, "posts" => $posts]);
    }

    public function show(Post $post)
    {

        $user = auth()->user();

        $showEditPostButton = auth()->user()->id == $post->created_by ? true : false;

        return view("posts/show", ["post" => $post, "user" => $user, "showEditPostButton" => $showEditPostButton]);
    }

}
