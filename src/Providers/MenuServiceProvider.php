<?php

namespace MichelJonkman\Director\Providers;

use Illuminate\Support\ServiceProvider;
use MichelJonkman\Director\Director;
use MichelJonkman\Director\Menu\MenuBuilder;
use Vite;

class MenuServiceProvider extends ServiceProvider
{
    public function boot(Director $director)
    {
        $director->menu()->modify(function (MenuBuilder $builder) {
            $builder->addLink(
                'director.home',
                Vite::useHotFile(public_path('null'))->asset('resources/js/Icons/house-fill2.svg', 'director/director'),
                'Home',
                route('director.dashboard.index'),
                0
            );
        });
    }
}
