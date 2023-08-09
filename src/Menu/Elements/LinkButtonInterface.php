<?php

namespace MichelJonkman\Director\Menu\Elements;


/**
 * A simple button with a link
 */
interface LinkButtonInterface
{
    public function getUrl(): ?string;

    public function setUrl(string $url): static;

    public function getTarget(): ?string;

    public function setTarget(string $target): static;

    public function getTitle(): ?string;

    public function setTitle(?string $title): static;

    public function getData(): array;

    public function getValidationRules(): array;
}
