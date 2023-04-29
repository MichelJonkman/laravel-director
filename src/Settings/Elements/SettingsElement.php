<?php

namespace MichelJonkman\Director\Settings\Elements;


use MichelJonkman\Director\Director;
use MichelJonkman\Director\Element\Elements\Element;
use Vite;

class SettingsElement extends Element implements SettingsElementInterface
{
    protected string $typeName = 'Element';

    /** @var string[]|null */
    protected ?array $classes = [];

    public function getComponentUrl(): string
    {
        return Vite::useHotFileFor(Director::BUILD_HOT_FILE, function () {
            return Vite::asset(
                "resources/package/js/Components/Layout/Dashboard/Sidebar/Nav/Buttons/$this->typeName.vue",
                Director::BUILD_DIRECTORY
            );
        });
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
