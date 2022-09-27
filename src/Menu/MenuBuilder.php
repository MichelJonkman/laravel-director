<?php

namespace MichelJonkman\Director\Menu;

use JsonSerializable;
use MichelJonkman\Director\Menu\Buttons\Button;

class MenuBuilder implements JsonSerializable
{
    protected array $elements = [];

    public function addButton(Button $button): void
    {
        $this->elements[$button->getName()] = $button;
    }

    public function getMenu(): array
    {
        return $this->elements;
    }

    public function jsonSerialize(): array
    {
        return $this->getMenu();
    }
}
