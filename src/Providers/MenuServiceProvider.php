<?php

namespace MichelJonkman\Director\Providers;

use Illuminate\Support\ServiceProvider;
use MichelJonkman\Director\Director;
use MichelJonkman\Director\Menu\Buttons\Button;
use MichelJonkman\Director\Menu\Buttons\IconButton;
use MichelJonkman\Director\Menu\Buttons\LinkButton;
use MichelJonkman\Director\Menu\MenuBuilder;
use Vite;

class MenuServiceProvider extends ServiceProvider
{
    public function boot(Director $director)
    {
        $director->menu()->modify(function (MenuBuilder $builder) {
            $builder->addButton(
                new LinkButton(
                    'director.linkbutton',
                    'LinkButton',
                    0,
                    Vite::useHotFile(public_path('null'))->asset('resources/js/Icons/house-fill.svg', 'director/director'),
                    route('director.dashboard.index')
                )
            );

            $builder->addButton(
                new Button(
                    'director.button',
                    'Button',
                    20
                )
            );

            $builder->addButton(
                new IconButton(
                    'director.iconbutton',
                    'IconButton',
                    10,
                    Vite::useHotFile(public_path('null'))->asset('resources/js/Icons/house-fill.svg', 'director/director')
                )
            );
        });
    }
}
