<?php

namespace App\Http\Controllers;

use App\Gallery;
use App\Http\Requests\UploadImage;
use App\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function upload(UploadImage $request, Gallery $gallery)
    {
        Image::create([
            "gallery_id" => $gallery->id,
            "image_location" => request()->file("image")->store("galleries/" . $gallery->id, "public")
        ]);

        return redirect("/gallery/" . $gallery->id . "/edit");
    }

    public function show(Gallery $gallery, Image $image)
    {
        $user = auth()->user();

        return view("gallery/images/show", ["user" => $user, "gallery" => $gallery, "image" => $image]);
    }

    public function destroy(Gallery $gallery, Image $image)
    {
        $image->delete();

        return redirect(route("gallery.edit", $gallery));
    }
}
