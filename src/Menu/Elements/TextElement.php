<?php

namespace MichelJonkman\Director\Menu\Elements;


class TextElement extends Element
{
    protected string $typeName = 'TextElement';

    protected ?string $text = null;

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): TextElement
    {
        $this->text = $text;

        return $this;
    }

    public function toArray(): array
    {
        return array_merge(parent::toArray(), [
            'text' => $this->getText()
        ]);
    }
}
