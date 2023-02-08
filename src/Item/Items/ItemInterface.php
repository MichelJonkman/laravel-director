<?php

namespace MichelJonkman\Director\Item\Items;

use MichelJonkman\Director\Item\Items\Traits\HasChildrenInterface;
use MichelJonkman\Director\Exceptions\Item\ItemValidationException;
use MichelJonkman\Director\Exceptions\Item\MissingItemException;

interface ItemInterface
{
    public function __construct(string $name, RootItemInterface $root);

    public function getName(): ?string;

    public function getPosition(): ?int;
    public function setPosition(int $position): static;

    public function getParent(): ?HasChildrenInterface;
    public function setParent(HasChildrenInterface $parent): static;

    /**
     * @throws ItemValidationException
     */
    public function validateData(array $data): array;

    public function getValidationRules(): array;

    public function getData(): array;

    /**
     * @throws ItemValidationException
     */
    public function toArray(): array;

    /**
     * @throws ItemValidationException
     */
    public function jsonSerialize(): array;

    /**
     * This gets called when the items get sorted, use this to sort any children
     */
    public function sort(): void;

    /**
     * This function gets called when an item gets removed from its parent item, do not call this directly
     * @throws MissingItemException
     *@see RootItemInterface::removeItem() To remove an item
     *
     */
    public function removeFromParent(): void;

}