<?php

namespace MichelJonkman\Director\Providers;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\ServiceProvider;
use MichelJonkman\Director\Director;
use MichelJonkman\Director\Settings\Elements\RootSettingsElement;
use MichelJonkman\Director\Settings\Elements\TextElement;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * @throws BindingResolutionException
     */
    public function boot(Director $director): void
    {
        $director->settings()->modify('director', function (RootSettingsElement $settings) {
            $settings->addPage('index', 'General')->addChildren(
                [
                    $settings->addElement('test', TextElement::class, [
                        'text' => 'testing123'
                    ])
                ]
            );
            $settings->addPage('testing', 'Testing!')->addChildren(
                [
                    $settings->addElement('test', TextElement::class, [
                        'text' => 'Nieuwe testing! :O'
                    ])
                ]
            );
        });
    }
}
