<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function edit() // shows edit page
    {
        return view('/edit');
    }

    public function show(User $user) // shows one
    {
        return view("/profile", ["user" => $user]); //TODO: pārtaisīt uz slug. pamācība pieejama day22/app/user.php failā
    }

    public function index() // show all
    {

    }

    public function update() // post request in edit page
    {

    }

    public function destroy() // deletes the user
    {

    }
}
