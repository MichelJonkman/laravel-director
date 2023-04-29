<?php

namespace MichelJonkman\Director\Settings\Elements\Traits;

use MichelJonkman\Director\Element\Elements\ElementInterface;
use MichelJonkman\Director\Element\Elements\RootElementInterface;
use MichelJonkman\Director\Exceptions\Element\InvalidElementException;
use MichelJonkman\Director\Exceptions\Element\MissingElementException;
use MichelJonkman\Director\Settings\Elements\PageElement;

trait AddsSettingsElementsTrait
{

    /**
     * @see RootElementInterface::addElement
     * @template-covariant T of ElementInterface
     *
     * @param  class-string<T>  $elementClass
     *
     * @return T
     * @throws InvalidElementException
     * @throws MissingElementException
     */
    abstract public function addElement(string $name, mixed $elementClass, array $properties = []): ElementInterface;

    /**
     * @throws MissingElementException
     * @throws InvalidElementException
     */
    public function addPage(string $name, string $title): PageElement
    {
        return $this->addElement($name, PageElement::class, [
            'title' => $title
        ]);
    }

}
