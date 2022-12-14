<?php

namespace MichelJonkman\Director\Providers;

use Illuminate\Support\ServiceProvider;
use MichelJonkman\Director\Director;
use MichelJonkman\Director\Menu\Elements\GroupElement;
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

            $menu->addElement('grouptest', GroupElement::class)->addChildren([
                $menu->addLink('director.settings')
                    ->setUrl(route('director.settings.overview'))
                    ->setText('Settings')
                    ->setTitle('Settings')
                    ->setIconAsset('resources/js/Icons/gear-fill.svg', Director::BUILD_DIRECTORY)
                    ->setPosition(100)
            ])->setPosition(10);
        });

        $this->registerCache($director);
    }

    protected function registerCache(Director $director)
    {
        if ($director->menuIsCached()) {
            $this->app->booted(function () use ($director) {
                require $director->getCachedMenuPath();
            });
        }
    }
}
