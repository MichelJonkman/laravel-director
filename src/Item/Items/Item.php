<?php

namespace MichelJonkman\Director\Item\Items;


use Illuminate\Support\Facades\Validator;
use JsonSerializable;
use MichelJonkman\Director\Item\Items\Traits\HasChildrenInterface;
use MichelJonkman\Director\Exceptions\Item\ItemValidationException;
use MichelJonkman\Director\Exceptions\Item\MissingItemException;

class Item implements JsonSerializable, ItemInterface
{

    protected string                $name;
    protected RootItemInterface     $root;
    protected ?int                  $position = null;
    protected ?HasChildrenInterface $parent = null;

    public function __construct(string $name, RootItemInterface $root)
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
     * @throws ItemValidationException
     */
    public function validateData(array $data): array
    {
        if (!$this->parent) {
            throw new ItemValidationException("Item \"$this->name\" does not have a parent item.");
        }

        $validator = Validator::make($data, $this->getValidationRules());

        if ($validator->fails()) {
            throw new ItemValidationException($validator->messages()->toJson());
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
     * @throws ItemValidationException
     */
    public function toArray(): array
    {
        return $this->validateData($this->getData());
    }

    /**
     * @throws ItemValidationException
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    /**
     * This gets called when the items get sorted, use this to sort any children
     */
    public function sort(): void { }

    /**
     * This function gets called when an item gets removed from its parent item, do not call this directly
     * @throws MissingItemException
     * @see ItemsBuilder::removeItem() To remove an item
     */
    public function removeFromParent(): void
    {
        $this->parent?->removeChild($this->name);
    }
}
