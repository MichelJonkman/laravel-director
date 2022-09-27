<?php

namespace MichelJonkman\Director\Menu\Buttons;


use JsonSerializable;

class Button implements JsonSerializable
{
    protected string $typeName = 'Button';

    protected string $name;
    protected string $title;
    protected int    $position;

    public function __construct(string $name, string $title, int $position)
    {
        $this->setName($name);
        $this->setTitle($title);
        $this->setPosition($position);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getPosition(): int
    {
        return $this->position;
    }

    public function setPosition(int $position): static
    {
        $this->position = $position;

        return $this;
    }

    public function getTypeName(): string
    {
        return $this->typeName;
    }

    public function toArray(): array
    {
        return [
            'typeName' => $this->getTypeName(),
            'name' => $this->getName(),
            'title' => $this->getTitle(),
            'position' => $this->getPosition(),
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
