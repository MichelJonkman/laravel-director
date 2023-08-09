<?php

namespace MichelJonkman\Director\Menu\Elements;

interface TextInterface
{
    public function getText(): ?string;

    public function setText(string $text): Text;

    public function getData(): array;

    public function getValidationRules(): array;
}
