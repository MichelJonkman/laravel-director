<?php

namespace MichelJonkman\Director\Providers;


class ConfigServiceProvider extends ServiceProvider
{
    public function registerService()
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
