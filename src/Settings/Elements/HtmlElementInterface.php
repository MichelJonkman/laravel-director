<?php

namespace MichelJonkman\Director\Settings\Elements;

interface HtmlElementInterface extends SettingsElementInterface
{
    public function getHtml(): ?string;

    public function setHtml(string $html): HtmlElement;

    public function getData(): array;

    public function getValidationRules(): array;
}
