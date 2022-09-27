<?php

namespace MichelJonkman\Director\Menu;


class MenuManager
{
    protected array $modifications = [];

    public function __construct(protected MenuBuilder $builder) {}

    /**
     * Adds a modification function, this functions receives a MenuBuilder instance
     */
    public function modify(callable $modificationFunction): void
    {
        $this->modifications[] = $modificationFunction;
    }

    /**
     * Runs the modifications and returns the builder
     */
    public function getMenu(): MenuBuilder
    {
        foreach ($this->modifications as $modification) {
            $modification($this->builder);
        }

        return $this->builder;
    }
}