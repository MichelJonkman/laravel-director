<?php

namespace MichelJonkman\Director;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use JetBrains\PhpStorm\ArrayShape;
use MichelJonkman\Director\Middleware\HandleInertiaRequests;

class DirectorServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'director');
    }

    public function boot()
    {
        Route::prefix(config('director.route_prefix'))
            ->name('director.')
            ->middleware([config('director.route_middleware'), HandleInertiaRequests::class])
            ->group(function () {
                $this->loadRoutesFrom(__DIR__.'/../routes/admin.php');
            });

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'director');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('director/config.php'),
            ], 'config');

            $this->publishes([
                __DIR__.'/../public' => public_path(),
            ], 'laravel-assets');
        }
    }
}
