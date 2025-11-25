<?php

namespace App\Providers;

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
        if (config('app.env') === 'local' && env('CURL_VERIFY_SSL', true) === false) {
            \Illuminate\Support\Facades\Http::withoutVerifying();
        }
    }
}

