<?php

namespace MichelJonkman\Director\Element\Elements;


use Illuminate\Support\Facades\Validator;
use JsonSerializable;
use MichelJonkman\Director\Element\Elements\Traits\HasChildrenInterface;
use MichelJonkman\Director\Exceptions\Element\ElementValidationException;
use MichelJonkman\Director\Exceptions\Element\MissingElementException;

class Element implements JsonSerializable, ElementInterface
{

    protected string               $name;
    protected RootElementInterface $root;
    protected ?int                 $position = null;
    protected ?HasChildrenInterface $parent = null;

    public function __construct(string $name, RootElementInterface $root)
    {
        $this->name = $name;
        $this->root = $root;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(int $position): static
    {
        $this->position = $position;

        return $this;
    }

    public function getParent(): ?HasChildrenInterface
    {
        return $this->parent;
    }

    public function setParent(HasChildrenInterface $parent): static
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @throws ElementValidationException
     */
    public function validateData(array $data): array
    {
        if (!$this->parent) {
            throw new ElementValidationException("Element \"$this->name\" does not have a parent element.");
        }

        $validator = Validator::make($data, $this->getValidationRules());

        if ($validator->fails()) {
            throw new ElementValidationException($validator->messages()->toJson());
        }

        return $validator->validated();
    }

    public function getValidationRules(): array
    {
        return [
            'name' => 'required',
            'position' => 'nullable',
        ];
    }

    public function getData(): array
    {
        return [
            'name' => $this->getName(),
            'position' => $this->getPosition(),
        ];
    }

    /**
     * @throws ElementValidationException
     */
    public function toArray(): array
    {
        return $this->validateData($this->getData());
    }

    /**
     * @throws ElementValidationException
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    /**
     * This gets called when the elements get sorted, use this to sort any children
     */
    public function sort(): void { }

    /**
     * This function gets called when an element gets removed from its parent element, do not call this directly
     * @throws MissingElementException
     * @see ElementsBuilder::removeElement() To remove an element
     */
    public function removeFromParent(): void
    {
        $this->parent?->removeChild($this->name);
    }
}