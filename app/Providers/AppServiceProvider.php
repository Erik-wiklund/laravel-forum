<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

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
        View::composer('layouts.navigation', function ($view) {
            // Fetch the currently authenticated user or null if no user is logged in
            $user = auth()->user();
    
            // Share the $user variable with the navigation view
            $view->with('user', $user);
        });

        Paginator::useBootstrapFive();
    }
}
