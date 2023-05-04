<?php

namespace MichelJonkman\Director\Menu\Elements;

use Director;
use MichelJonkman\Director\Element\Elements\Element;
use Vite;

class MenuElement extends Element implements MenuElementInterface
{
    protected string $typeName = 'Element';

    /** @var string[]|null */
    protected ?array $classes = [];

    public function getComponentUrl(): string
    {
        return Vite::useHotFileFor(
            Director::getBuildHotFile(),
            fn() => Vite::asset(
                "resources/package/js/Components/Layout/Dashboard/Sidebar/Nav/Buttons/$this->typeName.vue",
                Director::getBuildDirectory()
            )
        );
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
        return array_merge(parent::getValidationRules(), [
            'typeName' => 'required',
            'componentUrl' => 'required',
            'classes' => 'nullable'
        ]);
    }

    public function getData(): array
    {
        return array_merge(parent::getData(), [
            'typeName' => $this->getTypeName(),
            'componentUrl' => $this->getComponentUrl(),
            'classes' => $this->getClasses()
        ]);
    }
}
