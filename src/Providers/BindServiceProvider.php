<?php

namespace MichelJonkman\Director\Providers;

use Illuminate\Support\ServiceProvider;

class BindServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->scoped(Director::class, function () {
            return new Director();
        });
    }
}
