<?php

namespace MichelJonkman\Director\Menu\Elements;


use Illuminate\Support\Facades\Validator;
use JsonSerializable;
use MichelJonkman\Director\Exceptions\Menu\ElementValidationException;

class Element implements JsonSerializable
{
    protected string $typeName = 'Element';

    protected string $name;
    protected ?int    $position = null;

    /** @var string[]|null */
    protected ?array $classes = [];

    public function __construct(string $name) {
        $this->name = $name;
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

    public function getTypeName(): string
    {
        return $this->typeName;
    }

    /**
     * @return string[]|null
     */
    public function getClasses(): ?array
    {
        return array_unique($this->classes);
    }

    /**
     * Set extra CSS classes
     *
     * @param  string[]|null  $classes
     */
    public function setClasses(?array $classes): static
    {
        $this->classes = $classes;

        return $this;
    }

    /**
     * Add extra CSS class
     */
    public function addClass(string $class): static {
        $this->classes[] = $class;

        return $this;
    }

    /**
     * Add extra CSS classes
     *
     * @param string[] $classes
     */
    public function addClasses(array $classes): static {
        $this->classes = array_merge($this->classes, $classes);

        return $this;
    }

    /**
     * @throws ElementValidationException
     */
    public function validateData(array $data): array
    {
        $validator = Validator::make($data, $this->getValidationRules());

        if ($validator->fails()) {
            throw new ElementValidationException($validator->messages()->toJson());
        }

        return $validator->validated();
    }

    public function getValidationRules(): array
    {
        return [
            'typeName' => 'required',
            'name' => 'required',
            'position' => 'required',
            'classes' => 'nullable',
        ];
    }

    public function getData(): array
    {
        return [
            'typeName' => $this->getTypeName(),
            'name' => $this->getName(),
            'position' => $this->getPosition(),
            'classes' => $this->getClasses()
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
    public function sort(): void {}
}
