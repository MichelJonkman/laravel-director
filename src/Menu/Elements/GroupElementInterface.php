<?php

namespace MichelJonkman\Director\Menu\Elements;


use MichelJonkman\Director\Exceptions\Menu\MissingElementException;

interface GroupElementInterface extends ElementInterface
{
    /**
     * @return Element[]
     */
    public function getChildren(): array;

    /**
     * @throws MissingElementException
     */
    public function addChild(Element $element): static;

    /**
     * @param  Element[]  $children
     *
     * @throws MissingElementException
     */
    public function addChildren(array $children): static;

    /**
     * @throws MissingElementException
     */
    public function removeChild(string $name): static;
}