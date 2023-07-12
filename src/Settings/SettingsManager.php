<?php

namespace MichelJonkman\Director\Settings;


use Illuminate\Foundation\Application;
use MichelJonkman\Director\Director;
use MichelJonkman\Director\Element\ElementManager;
use MichelJonkman\Director\Exceptions\Element\ElementValidationException;
use MichelJonkman\Director\Exceptions\Element\MissingModificationException;
use MichelJonkman\Director\Menu\Elements\RootMenuElementInterface;
use MichelJonkman\Director\Settings\Elements\Settings\SettingElement;
use MichelJonkman\Director\Settings\Elements\Settings\SettingElementInterface;

class SettingsManager extends ElementManager
{
    /** @var SettingsModification[] $modifications */
    protected array $modifications = [];

    /** @var SettingElementInterface[] $settings */
    protected array $settings = [];

    /**
     * Adds a modification function, this functions receives a SettingsModification instance
     */
    public function modify(string $key, callable $modificationFunction): SettingsModification
    {
        return $this->modifications[$key] = new SettingsModification($modificationFunction);
    }

    public function registerSetting(SettingElementInterface $setting): void
    {
        $this->settings[$setting->getName()] = $setting;
    }
}
