<?php

namespace App\Http\Controllers;

use App\Gallery;
use App\Http\Requests\UploadImage;
use App\Image;
use App\Like;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function create()
    {
        $user = auth()->user();

        return view('/gallery/create', ["user" => $user]);
    }

    public function store()
    {
        $user = auth()->user();

        $gallery = Gallery::create([
            'title' => request()->get("title"),
            "created_by" => $user->id,
            "created_at" => NOW()
        ]);

        return redirect(route("gallery.edit", $gallery));
    }

    public function edit(Gallery $gallery)
    {
        $user = auth()->user();

        $this->authorize("editGallery", [$gallery]);

        $images = $gallery->images()->get();

        return view('/gallery/edit', ["user" => $user, "images" => $images, "gallery" => $gallery]);
    }

    public function update(Gallery $gallery)
    {
        $this->authorize("editGallery", [$gallery]);

        $gallery->update([
            "title" => request()->title,
            "updated_at" => NOW()
        ]);

        $gallery->save();

        return redirect("edit.gallery", $gallery);
    }

    public function uploadImage(Gallery $gallery, UploadImage $request, User $user) //upload image
    {
        $user->update([
            "image_location" => request()->file("image")->store("galleries", "public")
        ]);

        $user->save();

        return redirect(route("gallery.edit", ["user" => $user]));
    }

    public function show(Gallery $gallery)
    {
        $user = auth()->user();

        $images = $gallery->images()->get();

        $showEditButton = auth()->user()->id == $gallery->created_by ? true : false;

        $likeCount = count(Like::where([
            "liked_content_id" => $gallery->id,
            "liked_content_type" => "Gallery"
        ])->get());

        $hasLiked = DB::table("likes")
            ->select("liked_by_id")
            ->where(["liked_content_id" => $gallery->id], ["liked_content_type" => "Gallery"])->get();

        $showLikeButton = true;
        if ($hasLiked->contains('liked_by_id', $user->id)) {
            $showLikeButton = false;
        }

        return view("/gallery/show", [
            "user" => $user,
            "images" => $images,
            "showEditButton" => $showEditButton,
            "showLikeButton" => $showLikeButton,
            "gallery" => $gallery,
            "likeCount" => $likeCount
        ]);
    }

    public function destroy(Gallery $gallery)
    {
        $user = auth()->user();

        $this->authorize("editGallery", [$gallery]);

        $gallery->delete();

        return redirect("/");
    }

}
