<?php

namespace MichelJonkman\Director\Menu;

use JsonSerializable;
use MichelJonkman\Director\Exceptions\Menu\InvalidElementException;
use MichelJonkman\Director\Menu\Elements\Element;

class MenuBuilder implements JsonSerializable
{
    /**
     * @var Element[]
     */
    protected array $elements = [];

    public function getMenu(): array
    {
        $elements = $this->elements;
        usort($elements, fn(Element $a, Element $b) => $a->getPosition() <=> $b->getPosition());

        foreach ($elements as $element) {
            $element->sort();
        }

        return $elements;
    }

    public function jsonSerialize(): array
    {
        return $this->getMenu();
    }

    /**
     * @template-covariant T of MichelJonkman\Director\Menu\Elements\Element
     * @param T $elementClass
     *
     * @return T
     * @throws InvalidElementException
     */
    public function addElement(string $name, mixed $elementClass): Element
    {
        $element = app($elementClass, [
            'name' => $name
        ]);

        if (!($element instanceof Element)) {
            throw new InvalidElementException("Element of class \"$elementClass\" is not a valid menu element.");
        }

        $this->elements[$name] = $element;

        return $element;
    }
}
