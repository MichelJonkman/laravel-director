<?php

namespace MichelJonkman\Director\Settings\Elements;

class HtmlElement extends SettingsElement implements HtmlElementInterface
{
    protected string $typeName = 'HtmlElement';

    protected ?string $html = null;

    public function getHtml(): ?string
    {
        return $this->html;
    }

    public function setHtml(string $html): HtmlElement
    {
        $this->html = $html;

        return $this;
    }

    public function getData(): array
    {
        return array_merge(parent::getData(), [
            'html' => $this->getHtml()
        ]);
    }

    public function getValidationRules(): array
    {
        return array_merge(parent::getValidationRules(), [
            'html' => 'required'
        ]);
    }
}
