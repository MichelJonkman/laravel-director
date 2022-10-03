<?php

namespace MichelJonkman\Director\Menu\Elements;


use MichelJonkman\Director\Exceptions\Menu\InvalidElementException;
use MichelJonkman\Director\Exceptions\Menu\MissingElementException;

interface RootElementInterface extends GroupElementInterface
{
    public function __construct(string $name, RootElementInterface $root = null);

    public function getMenu(): array;

    public function jsonSerialize(): array;

    /**
     * @template-covariant T of MichelJonkman\Director\Menu\Elements\Element
     *
     * @param  class-string<T>  $elementClass
     *
     * @return T
     * @throws InvalidElementException
     * @throws MissingElementException
     */
    public function addElement(string $name, mixed $elementClass): Element;

    /**
     * @throws MissingElementException
     */
    public function removeElement(string $name): static;

    /**
     * @template-covariant T of MichelJonkman\Director\Menu\Elements\Element
     *
     * @param  class-string<T>|null  $elementClass  Use this to make the IDE understand what element it returns
     *
     * @return T
     * @throws MissingElementException
     */
    public function getElement(string $name, string $elementClass = null): Element;

    /**
     * @param  ElementInterface[]|string[]  $elements  The element or name of the element
     *
     * @throws MissingElementException
     */
    public function addToGroup(string $name, array $elements): static;
}