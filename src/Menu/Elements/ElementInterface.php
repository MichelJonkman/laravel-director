<?php

namespace MichelJonkman\Director\Menu\Elements;

use MichelJonkman\Director\Exceptions\Menu\ElementValidationException;
use MichelJonkman\Director\Exceptions\Menu\MissingElementException;

interface ElementInterface
{
    public function __construct(string $name, RootElementInterface $root);

    public function getName(): ?string;

    public function getPosition(): ?int;
    public function setPosition(int $position): static;

    public function getTypeName(): string;

    /**
     * @return string[]|null
     */
    public function getClasses(): ?array;

    /**
     * Set extra CSS classes
     *
     * @param  string[]|null  $classes
     */
    public function setClasses(?array $classes): static;

    /**
     * Add extra CSS class
     */
    public function addClass(string $class): static;

    /**
     * Add extra CSS classes
     *
     * @param  string[]  $classes
     */
    public function addClasses(array $classes): static;

    public function getParent(): ?GroupElementInterface;
    public function setParent(GroupElementInterface $parent): Element;

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
     * @see MenuBuilder::removeElement() To remove an element
     *
     * @throws MissingElementException
     */
    public function removeFromParent(): void;

}