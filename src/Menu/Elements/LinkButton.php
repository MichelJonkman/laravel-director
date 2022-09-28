<?php

namespace MichelJonkman\Director\Menu\Elements;

/**
 * A simple button with a link
 */
class LinkButton extends IconTextElement
{
    protected string $typeName = 'LinkButton';

    protected ?string $url = null;

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): static
    {
        $this->url = $url;

        return $this;
    }

    public function getData(): array
    {
        return array_merge(parent::getData(), [
            'url' => $this->getUrl()
        ]);
    }

    public function getValidationRules(): array
    {
        return array_merge(parent::getValidationRules(), [
            'url' => 'required'
        ]);
    }
}
