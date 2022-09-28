<?php

namespace MichelJonkman\Director\Menu\Elements;

/**
 * A simple button with a link
 */
class LinkButton extends IconTextElement
{
    protected string $typeName = 'LinkButton';

    protected string $url;

    public function __construct(string $name, int $position, string $text, string $iconUrl, string $url)
    {
        parent::__construct($name, $position, $text, $iconUrl);

        $this->setUrl($url);
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): static
    {
        $this->url = $url;

        return $this;
    }

    public function toArray(): array
    {
        return array_merge(parent::toArray(), [
            'url' => $this->getUrl()
        ]);
    }
}
