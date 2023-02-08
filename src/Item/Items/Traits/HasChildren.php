<?php

namespace MichelJonkman\Director\Item\Items\Traits;

use MichelJonkman\Director\Item\Items\ItemInterface;
use MichelJonkman\Director\Exceptions\Item\MissingItemException;

trait HasChildren
{
    /** @var ItemInterface[] */
    protected array $children = [];

    /**
     * @return ItemInterface[]
     */
    public function getChildren(): array
    {
        return $this->children;
    }

    /**
     * @throws MissingItemException
     */
    public function getChild(string $name): ItemInterface
    {
        if (!isset($this->items[$name])) {
            throw new MissingItemException("Item \"$name\" is not registered in this group.");
        }

        return $this->items[$name];
    }

    /**
     * @throws MissingItemException
     */
    public function addChild(ItemInterface|string $item): static
    {
        $name = $item;

        if ($item instanceof ItemInterface) {
            $name = $item->getName();
        }

        $realItem = $this->root->getItem($name);

        $realItem->removeFromParent();
        $this->children[$name] = $realItem;
        $realItem->setParent($this);

        return $this;
    }

    /**
     * @param  ItemInterface[]|string[]  $children
     *
     * @throws MissingItemException
     */
    public function addChildren(array $children): static
    {
        foreach ($children as $child) {
            $this->addChild($child);
        }

        return $this;
    }

    /**
     * @throws MissingItemException
     */
    public function removeChild(string $name): static
    {
        if (!isset($this->children[$name])) {
            throw new MissingItemException("Can't remove \"$name\" because it's not registered.");
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
        $items = $this->children;
        uasort($items, fn(ItemInterface $a, ItemInterface $b) => $a->getPosition() <=> $b->getPosition());

        foreach ($items as $item) {
            $item->sort();
        }

        $this->children = $items;
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