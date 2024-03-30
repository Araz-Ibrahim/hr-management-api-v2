<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class RouteMacroServiceProvider extends ServiceProvider
{
    /**
     * Register a macro to define resourceful routes along with a custom list route for a controller.
     *
     * This macro simplifies the process of defining resourceful routes along with a custom "list" route
     * for a controller in Laravel applications.
     *
     * @param string $uri The base URI for the resource routes.
     * @param string $controller The controller class handling the resource operations.
     * @return void
     */
    public function register()
    {
        Route::macro('resourceAndList', function ($uri, $controller) {

            // Define "list" route
            Route::get("{$uri}/list", "{$controller}@list")->name("{$uri}.list");

            // Define route for calling controller methods
            Route::get("{$uri}/call-function/{method}", "{$controller}@callMethod")->name("{$uri}.call-function");
            Route::post("{$uri}/call-function/{method}", "{$controller}@callMethod")->name("{$uri}.call-post-function");

            // Define standard resource routes
            Route::post($uri, "{$controller}@store")->name("{$uri}.store");
            Route::put("{$uri}/{id}", "{$controller}@update")->name("{$uri}.update");
            Route::delete("{$uri}/{id}", "{$controller}@destroy")->name("{$uri}.destroy");
            Route::get("{$uri}/{id}", "{$controller}@show")->name("{$uri}.show");
            Route::get($uri, "{$controller}@index")->name("{$uri}.index");

        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
