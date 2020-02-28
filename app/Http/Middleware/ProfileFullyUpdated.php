<?php

namespace App\Http\Middleware;

use Closure;

class ProfileFullyUpdated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = auth()->user();

        if (
            ! $user->address ||
            ! $user->phone ||
            ! $user->bio ||
            ! $user->birthday
        )
        {
            return redirect(route("edit.profile", $user));
        }

        return $next($request);
    }
}
