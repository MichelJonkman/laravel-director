<?php

namespace MichelJonkman\Director\Element\Elements\Traits;

use MichelJonkman\Director\Element\Elements\ElementInterface;
use MichelJonkman\Director\Exceptions\Element\MissingElementException;

trait HasChildren
{
    /** @var ElementInterface[] */
    protected array $children = [];

    /**
     * @return ElementInterface[]
     */
    public function getChildren(): array
    {
        return $this->children;
    }

    /**
     * @throws MissingElementException
     */
    public function getChild(string $name): ElementInterface
    {
        if (!isset($this->elements[$name])) {
            throw new MissingElementException("Element \"$name\" is not registered in this group.");
        }

        return $this->elements[$name];
    }

    /**
     * @throws MissingElementException
     */
    public function addChild(ElementInterface|string $element): static
    {
        $name = $element;

        if ($element instanceof ElementInterface) {
            $name = $element->getName();
        }

        $realElement = $this->root->getElement($name);

        $realElement->removeFromParent();
        $this->children[$name] = $realElement;
        $realElement->setParent($this);

        return $this;
    }

    /**
     * @param  ElementInterface[]|string[]  $children
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

    public function hasChild(string $name): bool
    {
        return isset($this->children[$name]);
    }

    public function sort(): void
    {
        $elements = $this->children;
        uasort($elements, fn(ElementInterface $a, ElementInterface $b) => $a->getPosition() <=> $b->getPosition());

        foreach ($elements as $element) {
            $element->sort();
        }

        $this->children = $elements;
    }

    public function getData(): array
    {
        return array_merge(parent::getData(), [
            'children' => $this->getChildren()
        ]);
    }

    public function getValidationRules(): array
    {
        return array_merge(parent::getValidationRules(), [
            'children' => 'required|array'
        ]);
    }

    public function toArray(): array
    {
        $array = parent::toArray();

        foreach ($array['children'] as &$child) {
            $child = $child->toArray();
        }

        return $array;
    }
}