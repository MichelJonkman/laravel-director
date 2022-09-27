<?php

namespace MichelJonkman\Director\Menu\Buttons;


use JsonSerializable;

class IconButton extends Button
{
    protected string $typeName = 'IconButton';
    protected string $iconUrl;

    public function __construct(string $name, string $title, int $position, string $iconUrl)
    {
        parent::__construct($name, $title, $position);

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
            'iconUrl' => $this->iconUrl
        ]);
    }
}
