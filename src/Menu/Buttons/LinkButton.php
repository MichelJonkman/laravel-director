<?php

namespace MichelJonkman\Director\Menu\Buttons;

/**
 * A simple button with a link
 */
class LinkButton extends IconButton
{
    protected string $typeName = 'LinkButton';

    protected string $url;

    public function __construct(string $name, string $title, int $position, string $iconUrl, string $url)
    {
        parent::__construct($name, $title, $position, $iconUrl);

        $this->setUrl($url);
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return LinkButton
     */
    public function setUrl(string $url): static
    {
        $this->url = $url;

        return $this;
    }

    public function toArray(): array
    {
        return array_merge(parent::toArray(), [
            'url' => $this->url
        ]);
    }
}
