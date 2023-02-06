<?php

namespace MichelJonkman\Director\Element\Elements;


use JsonSerializable;
use MichelJonkman\Director\Element\Elements\Traits\HasChildren;
use MichelJonkman\Director\Element\Elements\Traits\HasChildrenInterface;
use MichelJonkman\Director\Exceptions\Element\InvalidElementException;
use MichelJonkman\Director\Exceptions\Element\MissingElementException;
use MichelJonkman\Director\Exceptions\Element\WrongElementClassException;

class RootElement extends Element implements RootElementInterface, JsonSerializable
{
    use HasChildren;

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
     * @template-covariant T of MichelJonkman\Director\Element\Elements\ElementInterface
     *
     * @param  class-string<T>  $elementClass
     *
     * @return T
     * @throws InvalidElementException
     * @throws MissingElementException
     */
    public function addElement(string $name, mixed $elementClass): ElementInterface
    {
        $element = app($elementClass, [
            'name' => $name,
            'root' => $this
        ]);

        if (!($element instanceof ElementInterface)) {
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
     * @template-covariant T of MichelJonkman\Director\Element\Elements\ElementInterface
     *
     * @param  class-string<T>|null  $elementClass  Use this to make the IDE understand what element it returns
     *
     * @return T
     * @throws MissingElementException
     * @throws WrongElementClassException
     */
    public function getElement(string $name, string $elementClass = null): ElementInterface
    {
        if (!isset($this->elements[$name])) {
            throw new MissingElementException("Element \"$name\" is not registered.");
        }

        $element = $this->elements[$name];

        if (!$element instanceof $elementClass) {
            $class = get_class($element);
            throw new WrongElementClassException("Element \"$name\" is of class \"$class\" not of class \"$elementClass\".");
        }

        return $this->elements[$name];
    }

    /**
     * @param  ElementInterface[]|string[]  $elements  The element or name of the element
     *
     * @throws MissingElementException
     * @throws WrongElementClassException
     */
    public function addToGroup(string $name, array $elements): static
    {
        $this->getElement($name, HasChildrenInterface::class)->addChildren($elements);

        return $this;
    }
}