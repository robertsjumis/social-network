<?php

namespace App\Policies;

use App\Gallery;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class GalleryPolicy
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

    public function editGallery(User $user, Gallery $gallery)
    {
        $user = auth()->user();

        return (int) $user->id === (int) $gallery->created_by ?
            Response::allow()
            : Response::deny('Jāni, nelauz manu aplikāciju.');
    }
}
