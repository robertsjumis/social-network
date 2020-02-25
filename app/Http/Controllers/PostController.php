<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create()
    {
        $user = auth()->user();

        return view('/posts/create', ["user" => $user]);
    }
}
