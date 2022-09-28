<?php

namespace MichelJonkman\Director\Menu\Elements;


use JsonSerializable;

class Element implements JsonSerializable
{
    protected string $typeName = 'Element';

    protected string $name;
    protected int    $position;

    public function __construct(string $name, int $position)
    {
        $this->setName($name);
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
            'position' => $this->getPosition(),
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
