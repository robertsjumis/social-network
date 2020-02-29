<?php

namespace App\Policies;

use App\Post;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
//
    }

    public function editPost(User $user, Post $post)
    {
        $user = auth()->user();

        return (int) $user->id === (int) $post->created_by ?
            Response::allow()
            : Response::deny('Jāni, nelauz manu aplikāciju.');
    }
}
