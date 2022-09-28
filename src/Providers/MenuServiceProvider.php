<?php

namespace MichelJonkman\Director\Providers;

use Illuminate\Support\ServiceProvider;
use MichelJonkman\Director\Director;
use MichelJonkman\Director\Menu\Elements\Element;
use MichelJonkman\Director\Menu\Elements\TextElement;
use MichelJonkman\Director\Menu\Elements\IconTextElement;
use MichelJonkman\Director\Menu\Elements\LinkButton;
use MichelJonkman\Director\Menu\MenuBuilder;
use Vite;

class MenuServiceProvider extends ServiceProvider
{
    public function boot(Director $director)
    {
        $director->menu()->modify(function (MenuBuilder $builder) {
            $builder->addElement('director.linkButton', Element::class)->setPosition(0);


/*            $builder->addButton(
                new LinkButton(
                    'director.linkbutton',
                    'LinkButton',
                    0,
                    Vite::useHotFile(public_path('null'))->asset('resources/js/Icons/house-fill.svg', 'director/director'),
                    route('director.dashboard.index')
                )
            );

            $builder->addButton(
                new TextElement(
                    'director.button',
                    'Button',
                    20
                )
            );

            $builder->addButton(
                new IconTextElement(
                    'director.iconbutton',
                    'IconButton',
                    10,
                    Vite::useHotFile(public_path('null'))->asset('resources/js/Icons/house-fill.svg', 'director/director')
                )
            );*/
        });
    }
}
