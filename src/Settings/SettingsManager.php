<?php

namespace MichelJonkman\Director\Settings;


use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\DB;
use MichelJonkman\Director\Director;
use MichelJonkman\Director\Element\ElementManager;
use MichelJonkman\Director\Exceptions\Element\ElementValidationException;
use MichelJonkman\Director\Exceptions\Element\MissingModificationException;
use MichelJonkman\Director\Exceptions\Settings\MissingSettingException;
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

    /**
     * @throws MissingModificationException|MissingSettingException
     */
    public function get(string $name, mixed $default = null): mixed
    {
        $this->modifyRoot();

        if (!isset($this->settings[$name])) {
            throw new MissingSettingException("Setting $name does not exist.");
        }

        $value = DB::table('settings')->where('name', $name)->value('value');

        if ($value === null) {
            return $default;
        }

        return $this->settings[$name]->get($value);
    }

    /**
     * @throws MissingSettingException
     * @throws MissingModificationException
     */
    public function set(string $name, mixed $value): void
    {
        $this->modifyRoot();

        if (!isset($this->settings[$name])) {
            throw new MissingSettingException("Setting $name does not exist.");
        }

        DB::table('settings')
            ->updateOrInsert([
                'name' => $name
            ], [
                'value' => $this->settings[$name]->set($value)
            ]);
    }
}
