<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
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
        Gate::define('isAdmin', function ($user){
            if ($user->roles_id == '1') {
                return true;
            }

            return false;
        });

        Gate::define('isUser', function ($user){
            if ($user->roles_id == '2') {
                return true;
            }

            return false;
        });
    }
}
