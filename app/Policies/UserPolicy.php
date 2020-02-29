<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserPolicy
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

    public function updateUser(User $user, User $authUser)
    {
        return (int) $user->id === (int) $authUser->id ? Response::allow()
            : Response::deny('Jāni, nelauz manu aplikāciju.');
    }

}
