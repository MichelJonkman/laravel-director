<?php

namespace MichelJonkman\Director\Settings\Elements\Settings;

use MichelJonkman\Director\Element\Elements\RootElementInterface;
use MichelJonkman\Director\Facades\Director;
use MichelJonkman\Director\Settings\Elements\SettingsElement;

abstract class SettingElement extends SettingsElement implements SettingElementInterface
{
    public function __construct(
        string $name,
        RootElementInterface $root,
        array $properties = []
    ) {
        parent::__construct($name, $root, $properties);

        $this->registerSetting();
    }

    protected mixed $default = null;

    public function setDefault(mixed $default): SettingElement
    {
        $this->default = $default;

        return $this;
    }

    public function getDefault(): mixed
    {
        return $this->default;
    }

    protected function getComponentAssetUrl(): string
    {
        return "resources/package/js/Components/Settings/Elements/Settings/$this->typeName.vue";
    }

    protected function registerSetting(): void
    {
        Director::settings()->registerSetting($this);
    }
}
