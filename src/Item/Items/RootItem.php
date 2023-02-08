<?php

namespace MichelJonkman\Director\Item\Items;


use JsonSerializable;
use MichelJonkman\Director\Item\Items\Traits\HasChildren;
use MichelJonkman\Director\Item\Items\Traits\HasChildrenInterface;
use MichelJonkman\Director\Exceptions\Item\InvalidItemException;
use MichelJonkman\Director\Exceptions\Item\MissingItemException;
use MichelJonkman\Director\Exceptions\Item\WrongItemClassException;

class RootItem extends Item implements RootItemInterface, JsonSerializable
{
    use HasChildren;

    /**
     * @var Item[]
     */
    protected array $items = [];

    public function __construct(string $name, RootItemInterface $root = null)
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
     * @template-covariant T of MichelJonkman\Director\Item\Items\ItemInterface
     *
     * @param  class-string<T>  $itemClass
     *
     * @return T
     * @throws InvalidItemException
     * @throws MissingItemException
     */
    public function addItem(string $name, mixed $itemClass): ItemInterface
    {
        $item = app($itemClass, [
            'name' => $name,
            'root' => $this
        ]);

        if (!($item instanceof ItemInterface)) {
            throw new InvalidItemException("Item of class \"$itemClass\" is not a valid menu item.");
        }

        $this->items[$name] = $item;
        $this->addChild($item);

        return $item;
    }

    public function removeItem(string $name): static
    {
        $this->items[$name]->removeFromParent();
        unset($this->items[$name]);

        return $this;
    }

    /**
     * @template-covariant T of MichelJonkman\Director\Item\Items\ItemInterface
     *
     * @param  class-string<T>|null  $itemClass  Use this to make the IDE understand what item it returns
     *
     * @return T
     * @throws MissingItemException
     * @throws WrongItemClassException
     */
    public function getItem(string $name, string $itemClass = null): ItemInterface
    {
        if (!isset($this->items[$name])) {
            throw new MissingItemException("Item \"$name\" is not registered.");
        }

        $item = $this->items[$name];

        if (!$item instanceof $itemClass) {
            $class = get_class($item);
            throw new WrongItemClassException("Item \"$name\" is of class \"$class\" not of class \"$itemClass\".");
        }

        return $this->items[$name];
    }

    /**
     * @param  ItemInterface[]|string[]  $items  The item or name of the item
     *
     * @throws MissingItemException
     * @throws WrongItemClassException
     */
    public function addToGroup(string $name, array $items): static
    {
        $this->getItem($name, HasChildrenInterface::class)->addChildren($items);

        return $this;
    }
}