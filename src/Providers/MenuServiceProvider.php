<?php

namespace MichelJonkman\Director\Providers;

use Illuminate\Support\ServiceProvider;
use MichelJonkman\Director\Director;
use MichelJonkman\Director\Menu\Elements\Element;
use MichelJonkman\Director\Menu\Elements\GroupElement;
use MichelJonkman\Director\Menu\Elements\RootElementInterface;
use MichelJonkman\Director\Menu\Elements\TextElement;
use MichelJonkman\Director\Menu\Elements\IconTextElement;
use MichelJonkman\Director\Menu\Elements\LinkButton;

class MenuServiceProvider extends ServiceProvider
{
    public function boot(Director $director)
    {
        $director->menu()->modify('test', function (RootElementInterface $builder) {
            $builder->removeElement('director.iconTextElement');

            $builder->getElement('director.linkButton2', LinkButton::class)->setPosition(-1)->setUrl('/');

            $builder->addToGroup('director.group', [
                $builder->addElement('director.group.linkButton3', LinkButton::class)
                    ->setText('Group link Button 3')
                    ->setUrl(route('director.dashboard.test'))
                    ->setIconAsset('resources/js/Icons/house-fill.svg', Director::BUILD_DIRECTORY)
                    ->setPosition(30),
            ]);
        })->after('Director');

        $director->menu()->modify('Director', function (RootElementInterface $builder) {
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


            $builder->addElement('director.group', GroupElement::class)
                ->addChildren([
                    $builder->addElement('director.group.linkButton', LinkButton::class)
                        ->setText('Group link Button')
                        ->setUrl(route('director.dashboard.test'))
                        ->setIconAsset('resources/js/Icons/house-fill.svg', Director::BUILD_DIRECTORY)
                        ->setPosition(0),
                    $builder->addElement('director.group.linkButton', LinkButton::class)
                        ->setText('Group link Button replace')
                        ->setUrl(route('director.dashboard.test'))
                        ->setPosition(-1),
                ])
                ->setPosition(20);
        });
    }
}
