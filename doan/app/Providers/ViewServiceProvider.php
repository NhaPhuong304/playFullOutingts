<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        // Share categories list with all user views
        view()->composer('*', function ($view) {
            $view->with('categoriesList', Category::where('is_delete', 0)->orderByDesc('id')->get());
        });

       
    }
}
