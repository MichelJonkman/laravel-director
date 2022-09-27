<?php

namespace MichelJonkman\Director;

use MichelJonkman\Director\Console\PublicCommand;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use MichelJonkman\Director\Middleware\HandleInertiaRequests;

class DirectorServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'director');

        $this->app->scoped(Director::class, function ($app) {
            return new Director();
        });
    }

    public function boot(Director $director)
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

            $director->publicPublish(__DIR__ . '/../build/director/director', 'director');

            $this->commands([
                PublicCommand::class,
            ]);
        }
    }
}
