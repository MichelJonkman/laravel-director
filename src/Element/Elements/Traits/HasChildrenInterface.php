<?php

namespace MichelJonkman\Director\Element\Elements\Traits;

use MichelJonkman\Director\Element\Elements\ElementInterface;
use MichelJonkman\Director\Exceptions\Element\MissingElementException;

interface HasChildrenInterface
{
    /**
     * @return ElementInterface[]
     */
    public function getChildren(): array;

    /**
     * @throws MissingElementException
     */
    public function getChild(string $name): ElementInterface;

    /**
     * @throws MissingElementException
     */
    public function addChild(ElementInterface $element): static;

    /**
     * @param  ElementInterface[]  $children
     *
     * @throws MissingElementException
     */
    public function addChildren(array $children): static;

    /**
     * @throws MissingElementException
     */
    public function removeChild(string $name): static;

    public function hasChild(string $name): bool;
}