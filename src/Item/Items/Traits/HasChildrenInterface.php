<?php

namespace MichelJonkman\Director\Item\Items\Traits;

use MichelJonkman\Director\Item\Items\ItemInterface;
use MichelJonkman\Director\Exceptions\Item\MissingItemException;

interface HasChildrenInterface
{
    /**
     * @return ItemInterface[]
     */
    public function getChildren(): array;

    /**
     * @throws MissingItemException
     */
    public function getChild(string $name): ItemInterface;

    /**
     * @throws MissingItemException
     */
    public function addChild(ItemInterface $item): static;

    /**
     * @param  ItemInterface[]  $children
     *
     * @throws MissingItemException
     */
    public function addChildren(array $children): static;

    /**
     * @throws MissingItemException
     */
    public function removeChild(string $name): static;

    public function hasChild(string $name): bool;
}