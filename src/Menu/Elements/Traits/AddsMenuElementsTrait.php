<?php

namespace MichelJonkman\Director\Menu\Elements\Traits;

use MichelJonkman\Director\Element\Elements\ElementInterface;
use MichelJonkman\Director\Exceptions\Element\InvalidElementException;
use MichelJonkman\Director\Exceptions\Element\MissingElementException;
use MichelJonkman\Director\Menu\Elements\LinkButton;

trait AddsMenuElementsTrait
{
    abstract public function addElement(string $name, mixed $elementClass): ElementInterface;

    /**
     * @throws MissingElementException
     * @throws InvalidElementException
     */
    public function addLink(string $name): LinkButton
    {
        return $this->addElement($name, LinkButton::class);
    }

}