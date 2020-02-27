<?php

namespace App\Http\Controllers;

use App\Gallery;
use App\Http\Requests\UploadImage;
use App\Image;
use App\Like;
use App\User;
use Illuminate\Http\Request;
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

        $images = Image::where("gallery_id", $gallery->id)
            ->pluck("image_location")
            ->toArray();

        $newImages = [];

        foreach($images as $image)
        {
            $newImages[] = Storage::url($image);
        }

        return view('/gallery/edit', ["user" => $user, "images" => $newImages, "gallery" => $gallery]);
    }

    public function update(Gallery $gallery)
    {
        $gallery->update([
            "title" => request()->title,
            "updated_at" => NOW()
        ]);
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

        $images = Image::where("gallery_id", $gallery->id)
            ->pluck("image_location")
            ->toArray();

        $newImages = [];

        foreach($images as $image)
        {
            $newImages[] = Storage::url($image);
        }

        $likeCount = count(Like::where(["liked_content_id" => $gallery->id, "liked_content_type" => "gallery"])->get());


        return view("/gallery/show", [
            "user" => $user,
            "images" => $newImages,
            "gallery" => $gallery,
            "likeCount" => $likeCount
        ]);
    }

}
