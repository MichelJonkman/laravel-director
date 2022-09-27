<?php

namespace MichelJonkman\Director\Providers;

use Illuminate\Support\AggregateServiceProvider;

class DirectorServiceProvider extends AggregateServiceProvider
{
    protected $providers = [
        BindServiceProvider::class,
        ConfigServiceProvider::class,
        FrontendServiceProvider::class,
        RouteServiceProvider::class,
        RouteServiceProvider::class,
        ViewServiceProvider::class,
        MenuServiceProvider::class,
    ];
}
