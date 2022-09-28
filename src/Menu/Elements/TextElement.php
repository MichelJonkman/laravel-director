<?php

namespace MichelJonkman\Director\Menu\Elements;


class TextElement extends Element
{
    protected string $typeName = 'TextElement';

    protected string $text;

    public function __construct(string $name, int $position, string $text)
    {
        parent::__construct($name, $position);

        $this->setText($text);
    }

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
