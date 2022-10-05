<?php

namespace MichelJonkman\Director\Providers;

use Illuminate\Foundation\Application;
use MichelJonkman\Director\Director;
use MichelJonkman\Director\Http\Controllers\Settings\Overview2Controller;
use MichelJonkman\Director\Http\Controllers\Settings\OverviewController;
use MichelJonkman\Director\Menu\Elements\RootElement;
use MichelJonkman\Director\Menu\Elements\RootElementInterface;
use MichelJonkman\Director\Menu\MenuManager;

class BindServiceProvider extends ServiceProvider
{
    public function registerService()
    {
        $this->app->scoped(Director::class, function (Application $app) {
            return new Director($app, $app->make('files'));
        });

        $this->app->scoped(MenuManager::class, function (Application $app) {
            return new MenuManager($app, $app->make(Director::class), $app->make(RootElementInterface::class));
        });

        $this->app->alias(MenuManager::class, 'menu');

        $this->app->bind(RootElementInterface::class, function () {
            return new RootElement('root', null);
        });
    }
}
