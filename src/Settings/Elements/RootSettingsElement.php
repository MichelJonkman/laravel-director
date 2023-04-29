<?php

namespace MichelJonkman\Director\Settings\Elements;

use MichelJonkman\Director\Element\Elements\RootElement;
use MichelJonkman\Director\Exceptions\Element\ElementValidationException;
use MichelJonkman\Director\Exceptions\Settings\InvalidPageException;
use MichelJonkman\Director\Settings\Elements\Traits\AddsSettingsElementsTrait;

class RootSettingsElement extends RootElement implements RootSettingsElementInterface
{
    use AddsSettingsElementsTrait;

    protected function getCorrectElementClass(): string
    {
        return SettingsElementInterface::class;
    }

    /**
     * @throws ElementValidationException
     * @throws InvalidPageException
     */
    public function toArray(): array
    {
        foreach ($this->getChildren() as $child) {
            if(!$child instanceof PageElementInterface) {
                throw new InvalidPageException("All top level elements in settings should be pages. $child->name is not a page element.");
            }
        }

        return parent::toArray();
    }
}
