<?php

namespace MichelJonkman\Director\Menu;


use Closure;

class MenuModification
{
    protected Closure $modificationFunction;
    protected ?string $target = null;
    protected bool    $after  = false;

    /** @var MenuModification[] */
    protected array $afterChildren = [];
    /** @var MenuModification[] */
    protected array $beforeChildren = [];

    public function __construct(callable $modificationFunction)
    {
        $this->modificationFunction = $modificationFunction(...);
    }

    public function __invoke(MenuBuilder $builder): void
    {
        foreach ($this->beforeChildren as $beforeChild) {
            $beforeChild($builder);
        }

        ($this->modificationFunction)($builder);

        foreach ($this->afterChildren as $afterChild) {
            $afterChild($builder);
        }
    }

    public function after(string $target): static
    {
        $this->target = $target;
        $this->after = true;

        return $this;
    }

    public function before(string $target): static
    {
        $this->target = $target;
        $this->after = false;

        return $this;
    }

    public function getTarget(): ?string
    {
        return $this->target;
    }

    public function isAfter(): bool
    {
        return $this->after;
    }

    public function addBefore(MenuModification $modification): void
    {
        $this->beforeChildren[] = $modification;
    }

    public function addAfter(MenuModification $modification): void
    {
        $this->afterChildren[] = $modification;
    }
}
