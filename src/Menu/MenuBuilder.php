<?php

namespace MichelJonkman\Director\Menu;

use JsonSerializable;
use MichelJonkman\Director\Exceptions\Menu\InvalidElementException;
use MichelJonkman\Director\Exceptions\Menu\MissingElementException;
use MichelJonkman\Director\Menu\Elements\Element;
use MichelJonkman\Director\Menu\Elements\GroupElement;

class MenuBuilder implements JsonSerializable
{
    /**
     * @var Element[]
     */
    protected array $elements = [];
    protected GroupElement $root;

    public function __construct() {
        $this->root = new GroupElement('root');
    }

    public function getMenu(): array
    {
        $this->root->sort();
        return $this->root->getChildren();
    }

    public function jsonSerialize(): array
    {
        return $this->getMenu();
    }

    /**
     * @template-covariant T of MichelJonkman\Director\Menu\Elements\Element
     *
     * @param  class-string<T>  $elementClass
     *
     * @return T
     * @throws InvalidElementException
     * @throws MissingElementException
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
        $this->root->addChild($element);

        return $element;
    }

    /**
     * @throws MissingElementException
     */
    public function removeElement(string $name): static
    {
        $this->elements[$name]->removeFromParent();
        unset($this->elements[$name]);

        return $this;
    }

    /**
     * @template-covariant T of MichelJonkman\Director\Menu\Elements\Element
     *
     * @param class-string<T>|null $elementClass Use this to make the IDE understand what element it returns
     *
     * @return T
     * @throws MissingElementException
     */
    public function getElement(string $name, string $elementClass = null): Element
    {
        if (!isset($this->elements[$name])) {
            throw new MissingElementException("Element \"$name\" does is not registered.");
        }

        return $this->elements[$name];
    }
}
