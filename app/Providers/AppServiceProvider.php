<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Gate;
use App\Enums\UserRole;

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
        Gate::define('admin-only', function ($user) {
            return $user->role === UserRole::Admin;
        });

        Gate::define('manage-orders', function ($user) {
            return in_array($user->role, [
                UserRole::Admin,
                UserRole::Staff,
            ]);
        });
    }
}
