<?php

namespace MichelJonkman\Director\Providers;

use Illuminate\Support\AggregateServiceProvider;

class DirectorServiceProvider extends AggregateServiceProvider
{
    protected $providers = [
        BindServiceProvider::class,
        ConfigServiceProvider::class,
        FrontendServiceProvider::class,
        ConsoleServiceProvider::class,
        RouteServiceProvider::class,
        ViewServiceProvider::class,
        MenuServiceProvider::class,
        DatabaseServiceProvider::class,
        MacroServiceProvider::class,
        SettingsServiceProvider::class,
    ];
}
