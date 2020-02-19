<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function edit()
    {
        return view('/edit');
    }

    public function show() // shows one
    {
        return view("/{}");
    }
}
