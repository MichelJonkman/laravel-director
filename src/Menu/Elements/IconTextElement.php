<?php

namespace MichelJonkman\Director\Menu\Elements;


class IconTextElement extends TextElement
{
    protected string $typeName = 'IconTextElement';
    protected string $iconUrl;

    public function __construct(string $name, int $position, string $text, string $iconUrl)
    {
        parent::__construct($name, $position, $text);

        $this->setIconUrl($iconUrl);
    }

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
