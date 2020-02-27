<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function show()
    {
        $user = auth()->user();

        return view("messages", ["user" => $user]);
    }
}
