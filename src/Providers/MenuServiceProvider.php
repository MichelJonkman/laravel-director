<?php

namespace MichelJonkman\Director\Providers;

use Illuminate\Support\ServiceProvider;
use MichelJonkman\Director\Director;
use MichelJonkman\Director\Menu\Elements\RootElement;

class MenuServiceProvider extends ServiceProvider
{
    public function boot(Director $director)
    {
        $director->menu()->modify('director', function (RootElement $menu) {
            $menu->addLink('director.dashboard')
                ->setUrl(route('director.dashboard.index'))
                ->setText('Dashboard')
                ->setTitle('Dashboard')
                ->setIconAsset('resources/js/Icons/house-fill.svg', Director::BUILD_DIRECTORY)
                ->setPosition(0);

            $menu->addLink('director.settings')
                ->setUrl(route('director.dashboard.test'))
                ->setText('Settings\'test\'')
                ->setTitle('Settings')
                ->setIconAsset('resources/js/Icons/gear-fill.svg', Director::BUILD_DIRECTORY)
                ->setPosition(100);
        });
    }
}
