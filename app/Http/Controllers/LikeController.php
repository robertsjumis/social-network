<?php

namespace App\Http\Controllers;

use App\Gallery;
use App\Like;
use App\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function likePost(Post $post)
    {
        $user = auth()->user();

        var_dump($post);

        Like::create([
            "liked_by_id" => $user->id,
            "liked_content_id" => $post->id,
            "liked_content_type" => "post"
        ]);

        return redirect(route("post.show", $post));

    }

    public function likeGallery(Gallery $gallery)
    {
        $user = auth()->user();

        Like::create([
            "liked_by_id" => $user->id,
            "liked_content_id" => $gallery->id,
            "liked_content_type" => "gallery"
        ]);

        return redirect(route("gallery.show", $gallery));

    }

}
