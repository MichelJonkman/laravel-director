<?php

namespace MichelJonkman\Director\Providers;

use MichelJonkman\Director\Console\MenuCacheCommand;
use MichelJonkman\Director\Console\MenuClearCommand;
use MichelJonkman\Director\Console\PublicCommand;
use Illuminate\Support\ServiceProvider;

class ConsoleServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                PublicCommand::class,
                MenuClearCommand::class,
                MenuCacheCommand::class,
            ]);
        }
    }
}
