<?php

namespace MichelJonkman\Director\Item;


use Closure;
use MichelJonkman\Director\Item\Items\RootItemInterface;

class ItemModification
{
    protected Closure $modificationFunction;
    protected ?string $target = null;
    protected bool    $after  = false;

    /** @var self[] */
    protected array $afterChildren = [];
    /** @var self[] */
    protected array $beforeChildren = [];

    public function __construct(callable $modificationFunction)
    {
        // (...) turns the given callable into a Closure
        $this->modificationFunction = $modificationFunction(...);
    }

    /**
     * Runs the modification and it's children
     */
    public function __invoke(RootItemInterface $rootItem): void
    {
        foreach ($this->beforeChildren as $beforeChild) {
            $beforeChild($rootItem);
        }

        ($this->modificationFunction)($rootItem);

        foreach ($this->afterChildren as $afterChild) {
            $afterChild($rootItem);
        }
    }

    /**
     * Runs this modification after the target modification
     */
    public function after(string $target): static
    {
        $this->target = $target;
        $this->after = true;

        return $this;
    }

    /**
     * Runs this modification before the target modification
     */
    public function before(string $target): static
    {
        $this->target = $target;
        $this->after = false;

        return $this;
    }

    /**
     * Gets the name of the target
     */
    public function getTarget(): ?string
    {
        return $this->target;
    }

    /**
     * Returns if the modification is after the target, otherwise it's before
     */
    public function isAfter(): bool
    {
        return $this->after;
    }

    /**
     * Adds a modification to be run before this one
     */
    public function addBefore(ItemModification $modification): void
    {
        $this->beforeChildren[] = $modification;
    }

    /**
     * Adds a modification to be run after this one
     */
    public function addAfter(ItemModification $modification): void
    {
        $this->afterChildren[] = $modification;
    }
}
