<?php

namespace MichelJonkman\Director\Menu\Elements;


use MichelJonkman\Director\Element\Elements\Element;

class MenuElement extends Element implements MenuElementInterface
{
    protected string $typeName = 'Element';

    /** @var string[]|null */
    protected ?array $classes = [];

    public function getComponentUrl(): string
    {
        return "./Buttons/$this->typeName.vue";
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
    public function addClass(string $class): static
    {
        $this->classes[] = $class;

        return $this;
    }

    /**
     * Add extra CSS classes
     *
     * @param  string[]  $classes
     */
    public function addClasses(array $classes): static
    {
        $this->classes = array_merge($this->classes, $classes);

        return $this;
    }

    public function getValidationRules(): array
    {
        return [
            'typeName' => 'required',
            'componentUrl' => 'required',
            'classes' => 'nullable'
        ];
    }

    public function getData(): array
    {
        return [
            'typeName' => $this->getTypeName(),
            'componentUrl' => $this->getComponentUrl(),
            'classes' => $this->getClasses()
        ];
    }
}
