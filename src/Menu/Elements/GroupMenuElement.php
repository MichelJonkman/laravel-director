<?php

namespace MichelJonkman\Director\Menu\Elements;


use MichelJonkman\Director\Element\Elements\Traits\HasChildren;

class GroupMenuElement extends MenuElement implements GroupMenuElementInterface
{
    use HasChildren;

    protected string $typeName = 'GroupElement';

    protected ?string $title = null;

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getData(): array
    {
        return array_merge(parent::getData(), [
            'title' => $this->getTitle(),
            'children' => $this->getChildren(),
        ]);
    }

    public function getValidationRules(): array
    {
        return array_merge(parent::getValidationRules(), [
            'title' => 'required',
            'children' => 'required',
        ]);
    }
}
