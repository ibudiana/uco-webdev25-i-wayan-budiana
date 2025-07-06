<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        Gate::define('manage-transactions', function (User $user) {
            return $user->hasRole('admin');
        });

        Gate::define('manage-blog-posts', function (User $user) {
            return $user->hasRole('admin') || $user->hasRole('editor');
        });

        Gate::define('manage-users', function (User $user) {
            return $user->hasRole('admin');
        });
    }
}
