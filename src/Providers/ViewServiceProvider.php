<?php

namespace MichelJonkman\Director\Providers;

use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'director');
    }
}
