<?php

namespace MichelJonkman\Director\Menu\Elements;


use MichelJonkman\Director\Element\Elements\Traits\HasChildrenInterface;

interface GroupMenuElementInterface extends MenuElementInterface, HasChildrenInterface
{
    public function getTitle(): ?string;

    public function setTitle(string $title): static;

    public function getData(): array;

    public function getValidationRules(): array;
}
