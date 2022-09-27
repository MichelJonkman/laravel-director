<?php

namespace MichelJonkman\Director\Providers;

use Illuminate\Support\ServiceProvider;
use MichelJonkman\Director\Director;
use MichelJonkman\Director\Menu\MenuBuilder;
use MichelJonkman\Director\Menu\MenuManager;

class BindServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->scoped(Director::class, function () {
            return new Director();
        });

        $this->app->scoped(MenuManager::class, function () {
            return new MenuManager(app(MenuBuilder::class));
        });

        $this->app->bind(MenuBuilder::class, function () {
            return new MenuBuilder();
        });
    }
}
