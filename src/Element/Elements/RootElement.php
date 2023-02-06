<?php

namespace MichelJonkman\Director\Element\Elements;


use JsonSerializable;
use MichelJonkman\Director\Exceptions\Element\InvalidElementException;
use MichelJonkman\Director\Exceptions\Element\MissingElementException;

class RootElement extends GroupElement implements RootElementInterface, JsonSerializable
{
    /**
     * @var Element[]
     */
    protected array $elements = [];

    public function __construct(string $name, RootElementInterface $root = null)
    {
        parent::__construct($name, $this);
    }

    public function getSorted(): array
    {
        $this->sort();

        return $this->getChildren();
    }

    public function  toArray(): array
    {
        $children = $this->getSorted();

        foreach ($children as &$child) {
            $child = $child->toArray();
        }

        return [
            'children' => $children,
        ];
    }

    /**
     * @template-covariant T of MichelJonkman\Director\Elements\Elements\Element
     *
     * @param  class-string<T>  $elementClass
     *
     * @return T
     * @throws InvalidElementException
     */
    public function addElement(string $name, mixed $elementClass): Element
    {
        $element = app($elementClass, [
            'name' => $name,
            'root' => $this
        ]);

        if (!($element instanceof Element)) {
            throw new InvalidElementException("Element of class \"$elementClass\" is not a valid menu element.");
        }

        $this->elements[$name] = $element;
        $this->addChild($element);

        return $element;
    }

    public function removeElement(string $name): static
    {
        $this->elements[$name]->removeFromParent();
        unset($this->elements[$name]);

        return $this;
    }

    /**
     * @template-covariant T of MichelJonkman\Director\Elements\Elements\Element
     *
     * @param  class-string<T>|null  $elementClass  Use this to make the IDE understand what element it returns
     *
     * @return T
     * @throws MissingElementException
     */
    public function getElement(string $name, string $elementClass = null): Element
    {
        if (!isset($this->elements[$name])) {
            throw new MissingElementException("Element \"$name\" is not registered.");
        }

        return $this->elements[$name];
    }

    /**
     * @param  ElementInterface[]|string[]  $elements  The element or name of the element
     *
     * @throws MissingElementException
     */
    public function addToGroup(string $name, array $elements): static
    {
        $this->getElement($name, GroupElementInterface::class)->addChildren($elements);

        return $this;
    }
}