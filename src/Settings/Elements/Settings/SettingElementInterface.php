<?php namespace MichelJonkman\Director\Settings\Elements\Settings;

interface SettingElementInterface
{
    public function setDefault(mixed $default): SettingElement;

    public function getDefault(): mixed;

    /**
     * Returns the value, this step is used to for example: unserialize data that was stored in the database
     */
    public function get(string $value): mixed;

    /**
     * Sets the value, this step is used to for example: serialize data to be stored in the database
     */
    public function set(mixed $value): string;
}