<?php

namespace App\Providers;

use App\Models\Post;
use App\Policies\PostPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Post::class => PostPolicy::class,
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Gate thủ công
        Gate::define('edit-post', function ($user, $post) {
            return $user->id === $post->user_id || $user->is_admin;
        });

         Gate::define('destroy-post', function ($user, $post) {
            return $user->id === $post->user_id || $user->is_admin;
        });
    }
}
