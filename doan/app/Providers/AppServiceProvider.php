<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\ServiceProvider;

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
        // Disable SSL verification for development environment
        // if (config('app.env') === 'local' && env('CURL_VERIFY_SSL', true) === false) {
        //     \Illuminate\Support\Facades\Http::withoutVerifying();
        // }
        view()->composer('layouts.user.user', function ($view) {
            $view->with('categories', Category::all());
        });
    }
}

