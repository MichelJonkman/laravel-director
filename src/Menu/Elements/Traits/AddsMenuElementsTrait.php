<?php

namespace MichelJonkman\Director\Menu;

use MichelJonkman\Director\Exceptions\Element\InvalidElementException;
use MichelJonkman\Director\Exceptions\Element\MissingElementException;
use MichelJonkman\Director\Menu\Elements\MenuElement;
use MichelJonkman\Director\Menu\Elements\LinkButton;

trait AddsMenuElementsTrait
{
    abstract public function addElement(string $name, mixed $elementClass): MenuElement;

    /**
     * @throws MissingElementException
     * @throws InvalidElementException
     */
    public function addLink(string $name): LinkButton
    {
        return $this->addElement($name, LinkButton::class);
    }

}