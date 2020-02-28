<?php

namespace App\Http\Controllers;

use App\Like;
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

        Post::create([
            'title' => request()->get("title"),
            'body' => request()->get("body"),
            "created_by" => $user->id,
            "created_at" => NOW()
        ]);

        return redirect("/");
    }

    public function show(Post $post)
    {
        $user = auth()->user();

        $showEditPostButton = auth()->user()->id == $post->created_by ? true : false;

        $likeCount = count(Like::where([
            "liked_content_id" => $post->id,
            "liked_content_type" => "post"
        ])->get());

        return view("posts/show", [
            "post" => $post,
            "likeCount" => $likeCount,
            "user" => $user,
            "showEditPostButton" => $showEditPostButton
        ]);
    }

    public function edit(Post $post)
    {
        $user = auth()->user();

        return view('/posts/edit', ["post" => $post, "user" => $user]);
    }

    public function update(Post $post)
    {
        $user = auth()->user();

        $post->update([
            "title" => request()->title,
            "body" => request()->body,
            "updated_at" => NOW()
        ]);

        return redirect(route("post.show", ["post" => $post]));
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect("/");
    }

}
