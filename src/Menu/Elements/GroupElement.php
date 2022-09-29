<?php

namespace MichelJonkman\Director\Menu\Elements;


use MichelJonkman\Director\Exceptions\Menu\MissingElementException;

class GroupElement extends Element
{
    protected string $typeName = 'GroupElement';

    /** @var Element[] */
    protected array $children = [];

    /**
     * @return Element[]
     */
    public function getChildren(): array
    {
        return $this->children;
    }

    /**
     * @throws MissingElementException
     */
    public function addChild(Element $element): static
    {
        $element->removeFromParent();
        $this->children[$element->getName()] = $element;
        $element->setParent($this);

        return $this;
    }

    /**
     * @param  Element[]  $children
     *
     * @throws MissingElementException
     */
    public function addChildren(array $children): static
    {
        foreach ($children as $child) {
            $this->addChild($child);
        }

        return $this;
    }

    /**
     * @throws MissingElementException
     */
    public function removeChild(string $name): static
    {
        if (!isset($this->children[$name])) {
            throw new MissingElementException("Can't remove \"$name\" because it's not registered.");
        }

        unset($this->children[$name]);

        return $this;
    }

    public function sort(): void
    {
        $elements = $this->children;
        uasort($elements, fn(Element $a, Element $b) => $a->getPosition() <=> $b->getPosition());

        foreach ($elements as $element) {
            $element->sort();
        }

        $this->children = $elements;
    }
}