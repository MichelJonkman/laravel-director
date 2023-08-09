<?php

namespace MichelJonkman\Director\Providers;

use Illuminate\Support\ServiceProvider;
use MichelJonkman\Director\Director;
use MichelJonkman\Director\Menu\Elements\GroupMenuElement;
use MichelJonkman\Director\Menu\Elements\RootMenuElement;
use MichelJonkman\Director\Menu\Elements\Text;
use MichelJonkman\DirectorExample\MenuExportExampleText;

class MenuServiceProvider extends ServiceProvider
{
    public function boot(Director $director)
    {
        $director->menu()->modify('director', function (RootMenuElement $menu) {
            $menu->addLink('director.dashboard')
                ->setUrl(route('director.dashboard.index'))
                ->setText('Dashboard')
                ->setTitle('Dashboard')
                ->setIconAsset('resources/package/js/Icons/house-fill.svg', Director::BUILD_DIRECTORY)
                ->setPosition(0);

            $menu->addElement('director.system', GroupMenuElement::class)->addChildren([
                $menu->addLink('director.system.settings')
                    ->setUrl(route('director.settings.page'))
                    ->setText('Settings')
                    ->setTitle('Settings')
                    ->setIconAsset('resources/package/js/Icons/gear-fill.svg', Director::BUILD_DIRECTORY)
                    ->setPosition(100)
            ])->setTitle('System')->setPosition(10);
        });

        $this->registerCache($director);
    }

    protected function registerCache(Director $director)
    {
        if ($director->elementsAreCached()) {
            $this->app->booted(function () use ($director) {
                require $director->getCachedElementsPath();
            });
        }
    }
}
