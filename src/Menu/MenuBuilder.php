<?php

namespace MichelJonkman\Director\Menu;

use JsonSerializable;
use MichelJonkman\Director\Exceptions\Menu\InvalidElementException;
use MichelJonkman\Director\Menu\Elements\Element;

class MenuBuilder implements JsonSerializable
{
    protected array $elements = [];

    public function getMenu(): array
    {
        return $this->elements;
    }

    public function jsonSerialize(): array
    {
        return $this->getMenu();
    }

    /**
     * @throws InvalidElementException
     */
    public function addElement(string $name, string $elementClass): Element
    {
        $element = app($elementClass);

        if (!($element instanceof Element)) {
            throw new InvalidElementException("Element of class \"$elementClass\" is not a valid menu element.");
        }

        $element->setName($name);
        $this->elements[$name] = $element;

        return $element;
    }
}
