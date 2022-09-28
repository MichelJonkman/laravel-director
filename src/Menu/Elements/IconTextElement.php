<?php

namespace MichelJonkman\Director\Menu\Elements;


class IconTextElement extends TextElement
{
    protected string $typeName = 'IconTextElement';
    protected ?string $iconUrl = null;

    public function getIconUrl(): ?string
    {
        return $this->iconUrl;
    }

    public function setIconUrl(string $iconUrl): static
    {
        $this->iconUrl = $iconUrl;

        return $this;
    }

    public function getData(): array
    {
        return array_merge(parent::getData(), [
            'iconUrl' => $this->getIconUrl()
        ]);
    }

    public function getValidationRules(): array
    {
        return array_merge(parent::getValidationRules(), [
            'iconUrl' => 'required'
        ]);
    }
}
