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

    /**
     * Returns the value, this step is used to for example: unserialize data that was stored in the database
     */
    public function get(string $value): mixed {
        return $value;
    }

    /**
     * Sets the value, this step is used to for example: serialize data to be stored in the database
     */
    public function set(mixed $value): string {
        return $value;
    }

    protected function getComponentAssetUrl(): string
    {
        return "resources/package/js/Components/Settings/Elements/Settings/$this->typeName.vue";
    }

    public function registerSetting(): void
    {
        Director::settings()->registerSetting($this);
    }
}
