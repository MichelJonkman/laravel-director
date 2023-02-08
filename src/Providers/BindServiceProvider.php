<?php

namespace MichelJonkman\Director\Providers;

use Illuminate\Foundation\Application;
use MichelJonkman\Director\Director;
use MichelJonkman\Director\Menu\Elements\RootMenuElement;
use MichelJonkman\Director\Menu\Elements\RootMenuElementInterface;
use MichelJonkman\Director\Menu\MenuManager;

class BindServiceProvider extends ServiceProvider
{
    public function registerService()
    {
        $this->app->scoped(Director::class, function (Application $app) {
            return new Director($app, $app->make('files'));
        });

        $this->app->scoped(MenuManager::class, function (Application $app) {
            return new MenuManager($app, $app->make(Director::class), $app->make(RootMenuElementInterface::class));
        });

        $this->app->alias(MenuManager::class, 'menu');

        $this->app->bind(RootMenuElementInterface::class, function () {
            return new RootMenuElement('root', null);
        });
    }
}
