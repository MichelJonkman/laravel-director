<?php

namespace MichelJonkman\Director\Menu\Elements;

/**
 * A simple button with a link
 */
class LinkButton extends IconTextElement
{
    protected string $typeName = 'LinkButton';

    protected ?string $url = null;
    protected ?string $target = null;
    protected ?string $title = null;

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): static
    {
        $this->url = $url;

        return $this;
    }

    public function getTarget(): ?string
    {
        return $this->target;
    }

    public function setTarget(string $target): static
    {
        $this->target = $target;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getData(): array
    {
        return array_merge(parent::getData(), [
            'url' => $this->getUrl(),
            'target' => $this->getTarget(),
            'title' => $this->getTitle()
        ]);
    }

    public function getValidationRules(): array
    {
        return array_merge(parent::getValidationRules(), [
            'url' => 'required',
            'target' => 'nullable',
            'title' => 'nullable'
        ]);
    }
}
