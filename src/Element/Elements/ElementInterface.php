<?php

namespace MichelJonkman\Director\Element\Elements;

use MichelJonkman\Director\Element\Elements\Traits\HasChildrenInterface;
use MichelJonkman\Director\Exceptions\Element\ElementValidationException;
use MichelJonkman\Director\Exceptions\Element\MissingElementException;

interface ElementInterface
{
    public function __construct(string $name, RootElementInterface $root);

    public function getName(): ?string;

    public function getPosition(): ?int;
    public function setPosition(int $position): static;

    public function getParent(): ?HasChildrenInterface;
    public function setParent(HasChildrenInterface $parent): static;

    /**
     * @throws ElementValidationException
     */
    public function validateData(array $data): array;

    public function getValidationRules(): array;

    public function getData(): array;

    /**
     * @throws ElementValidationException
     */
    public function toArray(): array;

    /**
     * @throws ElementValidationException
     */
    public function jsonSerialize(): array;

    /**
     * This gets called when the elements get sorted, use this to sort any children
     */
    public function sort(): void;

    /**
     * This function gets called when an element gets removed from its parent element, do not call this directly
     * @see RootElementInterface::removeElement() To remove an element
     *
     * @throws MissingElementException
     */
    public function removeFromParent(): void;

}