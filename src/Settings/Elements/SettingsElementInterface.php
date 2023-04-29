<?php

namespace MichelJonkman\Director\Settings\Elements;

use MichelJonkman\Director\Element\Elements\ElementInterface;

interface SettingsElementInterface extends ElementInterface
{
    /**
     * Returns the URL of the vue component it should load, relative url is only accepted if the element is in the root project
     */
    public function getComponentUrl(): string;

    public function getTypeName(): string;

    /**
     * @return string[]|null
     */
    public function getClasses(): ?array;

    /**
     * Set extra CSS classes
     *
     * @param  string[]|null  $classes
     */
    public function setClasses(?array $classes): static;

    /**
     * Add extra CSS class
     */
    public function addClass(string $class): static;

    /**
     * Add extra CSS classes
     *
     * @param  string[]  $classes
     */
    public function addClasses(array $classes): static;

}
