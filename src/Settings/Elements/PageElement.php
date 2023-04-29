<?php

namespace MichelJonkman\Director\Settings\Elements;

use MichelJonkman\Director\Element\Elements\Traits\HasChildren;

class PageElement extends SettingsElement implements PageElementsInterface
{
    use HasChildren;

    protected ?string $title = null;

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getData(): array
    {
        return array_merge(parent::getData(), [
            'title' => $this->getTitle()
        ]);
    }

    public function getValidationRules(): array
    {
        return array_merge(parent::getValidationRules(), [
            'title' => 'required'
        ]);
    }
}
