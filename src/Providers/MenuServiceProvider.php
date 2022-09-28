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
            $builder->addElement('director.element', Element::class)->setPosition(20);

            $builder->addElement('director.textElement', TextElement::class)
                ->setText('Text Element')
                ->addClass('bg-danger')
                ->setPosition(30);

            $builder->addElement('director.iconTextElement', IconTextElement::class)
                ->setText('Icon Text Element')
                ->setIconAsset('resources/js/Icons/house-fill.svg', Director::BUILD_DIRECTORY)
                ->setPosition(10);

            $builder->addElement('director.linkButton', LinkButton::class)
                ->setText('Link Button')
                ->setUrl(route('director.dashboard.test'))
                ->setIconAsset('resources/js/Icons/house-fill.svg', Director::BUILD_DIRECTORY)
                ->setPosition(0);

            $builder->addElement('director.linkButton2', LinkButton::class)
                ->setText('Link Button 2')
                ->setUrl('https://google.com/')
                ->setTarget('_blank')
                ->setTitle('Google')
                ->setIconAsset('resources/js/Icons/house-fill.svg', Director::BUILD_DIRECTORY)
                ->setPosition(50);
        });
    }
}
