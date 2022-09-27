<?php

namespace MichelJonkman\Director\Providers;

use MichelJonkman\Director\Console\PublicCommand;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use MichelJonkman\Director\Middleware\HandleInertiaRequests;

class ConfigServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/config.php', 'director');
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../../config/config.php' => config_path('director/config.php'),
            ], 'config');
        }
    }
}
