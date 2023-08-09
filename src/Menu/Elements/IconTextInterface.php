<?php

namespace MichelJonkman\Director\Menu\Elements;

interface IconTextInterface
{
    public function getIconUrl(): ?string;

    public function setIconUrl(string $iconUrl): static;

    /**
     * Sets the icon using the Vite::asset() method, uses hot file 'dummy' as the dev server doesn't compile icons correctly
     */
    public function setIconAsset(string $iconPath, string $buildDirectory): static;

    public function getData(): array;

    public function getValidationRules(): array;
}
