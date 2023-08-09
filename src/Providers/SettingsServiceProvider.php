<?php

namespace MichelJonkman\Director\Providers;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\ServiceProvider;
use MichelJonkman\Director\Director;
use MichelJonkman\Director\Settings\Elements\RootSettingsElement;
use MichelJonkman\Director\Settings\Elements\HtmlElement;
use MichelJonkman\Director\Settings\Elements\Settings\TextSetting;

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
                    $settings->addElement('director.index.title', HtmlElement::class, [
                        'html' => '<h1>General settings</h1>'
                    ]),
                    $settings->addElement('director.index.textTest', TextSetting::class, [
                        'default' => 'Default text',
                        'label' => 'Text input test'
                    ]),
                ]
            );
            $settings->addPage('director.testPage', 'Test page')->addChildren(
                [
                    $settings->addElement('director.testPage.content', HtmlElement::class, [
                        'html' => '<h1 class="mb-5">Test page contents</h1>'
                    ])
                ]
            );
        });
    }
}
