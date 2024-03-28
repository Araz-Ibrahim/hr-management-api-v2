<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class RouteMacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        Route::macro('resourceAndList', function ($uri, $controller) {

            Route::get("{$uri}/list", "{$controller}@list")->name("{$uri}.list");
            Route::get("{$uri}/get-view", "{$controller}@getView")->name("{$uri}.get-view");
            Route::get("{$uri}/call-function/{method}", "{$controller}@callMethod")->name("{$uri}.call-function");
            Route::post("{$uri}/call-function/{method}", "{$controller}@callMethod")->name("{$uri}.call-post-function");
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
