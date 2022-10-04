<?php

namespace MichelJonkman\Director\Providers;

use Illuminate\Support\ServiceProvider;
use MichelJonkman\Director\Director;
use MichelJonkman\Director\Menu\Elements\RootElement;
use MichelJonkman\Director\Menu\Elements\RootElementInterface;
use MichelJonkman\Director\Menu\MenuManager;

class BindServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->scoped(Director::class, function () {
            return new Director(app());
        });

        $this->app->scoped(MenuManager::class, function () {
            return new MenuManager(app(RootElementInterface::class));
        });

        $this->app->alias(MenuManager::class, 'menu');

        $this->app->bind(RootElementInterface::class, function () {
            return new RootElement('root', null);
        });
    }
}
