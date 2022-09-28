<?php

namespace MichelJonkman\Director\Menu\Elements;


class IconTextElement extends TextElement
{
    protected string $typeName = 'IconTextElement';
    protected ?string $iconUrl = null;

    public function getIconUrl(): string
    {
        return $this->iconUrl;
    }

    public function setIconUrl(string $iconUrl): static
    {
        $this->iconUrl = $iconUrl;

        return $this;
    }

    public function toArray(): array
    {
        return array_merge(parent::toArray(), [
            'iconUrl' => $this->getIconUrl()
        ]);
    }
}
