<?php

namespace App\Http\Controllers;

use App\Gallery;
use Illuminate\Http\Request;

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

        return view('/gallery/edit', ["user" => $user, "gallery" => $gallery]);
    }

}
