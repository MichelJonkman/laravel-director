<?php

namespace MichelJonkman\Director\Settings\Elements;

use Illuminate\Support\Facades\Vite;
use Illuminate\Support\Str;
use MichelJonkman\Director\Director;
use MichelJonkman\Director\Element\Elements\Traits\HasChildren;

class PageElement extends SettingsElement implements PageElementInterface
{
    use HasChildren;

    protected string $typeName = 'PageElement';
    protected ?string $title = null;

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getSlug(): ?string
    {
        return Str::slug($this->name);
    }

    public function getData(): array
    {
        return array_merge(parent::getData(), [
            'title' => $this->getTitle(),
            'slug' => $this->getSlug(),
            'isPage' => true,
            'active' => false
        ]);
    }

    public function getValidationRules(): array
    {
        return array_merge(parent::getValidationRules(), [
            'title' => 'required',
            'slug' => 'required',
            'isPage' => 'required',
            'active' => 'required'
        ]);
    }
}
