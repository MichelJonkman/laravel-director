<?php

namespace MichelJonkman\Director\Item\Items;

use MichelJonkman\Director\Item\Items\Traits\HasChildrenInterface;
use MichelJonkman\Director\Exceptions\Item\InvalidItemException;
use MichelJonkman\Director\Exceptions\Item\MissingItemException;

interface RootItemInterface extends ItemInterface, HasChildrenInterface
{
    public function __construct(string $name, RootItemInterface $root = null);

    public function getSorted(): array;

    public function jsonSerialize(): array;

    /**
     * @template-covariant T of MichelJonkman\Director\Item\Items\ItemInterface
     *
     * @param  class-string<T>  $itemClass
     *
     * @return T
     * @throws InvalidItemException
     * @throws MissingItemException
     */
    public function addItem(string $name, mixed $itemClass): ItemInterface;

    /**
     * @throws MissingItemException
     */
    public function removeItem(string $name): static;

    /**
     * @template-covariant T of MichelJonkman\Director\Item\Items\ItemInterface
     *
     * @param  class-string<T>|null  $itemClass  Use this to make the IDE understand what item it returns
     *
     * @return T
     * @throws MissingItemException
     */
    public function getItem(string $name, string $itemClass = null): ItemInterface;

    /**
     * @param  ItemInterface[]|string[]  $items  The item or name of the item
     *
     * @throws MissingItemException
     */
    public function addToGroup(string $name, array $items): static;
}