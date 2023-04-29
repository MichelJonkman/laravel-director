<?php

namespace MichelJonkman\Director\Element\Elements;

use JsonSerializable;
use MichelJonkman\Director\Element\Elements\Traits\HasChildrenInterface;
use MichelJonkman\Director\Exceptions\Element\InvalidElementException;
use MichelJonkman\Director\Exceptions\Element\MissingElementException;

interface RootElementInterface extends ElementInterface, HasChildrenInterface, JsonSerializable
{
    public function __construct(string $name, RootElementInterface $root = null);

    public function getSorted(): array;

    public function jsonSerialize(): array;

    /**
     * @template-covariant T of ElementInterface
     *
     * @param  class-string<T>  $elementClass
     *
     * @return T
     * @throws InvalidElementException
     * @throws MissingElementException
     */
    public function addElement(string $name, mixed $elementClass, array $properties = []): ElementInterface;

    /**
     * @throws MissingElementException
     */
    public function removeElement(string $name): static;

    /**
     * @template-covariant T of ElementInterface
     *
     * @param  class-string<T>|null  $elementClass  Use this to make the IDE understand what element it returns
     *
     * @return T
     * @throws MissingElementException
     */
    public function getElement(string $name, string $elementClass = null): ElementInterface;

    /**
     * @param  ElementInterface[]|string[]  $elements  The element or name of the element
     *
     * @throws MissingElementException
     */
    public function addToGroup(string $name, array $elements): static;
}
