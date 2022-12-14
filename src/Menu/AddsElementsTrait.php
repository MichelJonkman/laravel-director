<?php

namespace MichelJonkman\Director\Menu;

use MichelJonkman\Director\Exceptions\Menu\InvalidElementException;
use MichelJonkman\Director\Exceptions\Menu\MissingElementException;
use MichelJonkman\Director\Menu\Elements\Element;
use MichelJonkman\Director\Menu\Elements\LinkButton;

trait AddsElementsTrait
{
    abstract public function addElement(string $name, mixed $elementClass): Element;

    /**
     * @throws InvalidElementException
     * @throws MissingElementException
     */
    public function addLink(string $name): LinkButton
    {
        return $this->addElement($name, LinkButton::class);
    }

}