<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

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

    }

    public function show(Post $post)
    {

    }

}
