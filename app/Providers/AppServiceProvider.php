<?php

namespace App\Providers;

use App\Gallery;
use App\Policies\GalleryPolicy;
use App\Policies\PostPolicy;
use App\Policies\UserPolicy;
use App\Post;
use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{

    protected $policies = [
        User::class => UserPolicy::class,
        Post::class => PostPolicy::class,
        Gallery::class => GalleryPolicy::class
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
       $this->registerPolicies();
    }
}
