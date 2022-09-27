<?php

namespace MichelJonkman\Director\Menu;

use JsonSerializable;

class MenuBuilder implements JsonSerializable
{
    protected array $elements = [];

    public function addLink(string $name, string $iconLink, string $content, string $url, int $position): void
    {
        $this->elements[$name] = [
            'iconLink' => $iconLink,
            'content' => $content,
            'url' => $url,
            'position' => $position,
        ];
    }

    public function getMenu(): array
    {
        return $this->elements;
    }


    public function jsonSerialize()
    {
        return $this->getMenu();
    }
}