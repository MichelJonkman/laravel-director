<?php

namespace MichelJonkman\Director\Menu\Elements;


class Text extends MenuElement implements TextInterface
{
    protected string $typeName = 'TextElement';

    protected ?string $text = null;

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): Text
    {
        $this->text = $text;

        return $this;
    }

    public function getData(): array
    {
        return array_merge(parent::getData(), [
            'text' => $this->getText()
        ]);
    }

    public function getValidationRules(): array
    {
        return array_merge(parent::getValidationRules(), [
            'text' => 'required'
        ]);
    }
}
