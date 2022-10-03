<?php

namespace MichelJonkman\Director\Menu;


use Closure;
use MichelJonkman\Director\Menu\Elements\RootElementInterface;

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

    public function __invoke(RootElementInterface $rootElement): void
    {
        foreach ($this->beforeChildren as $beforeChild) {
            $beforeChild($rootElement);
        }

        ($this->modificationFunction)($rootElement);

        foreach ($this->afterChildren as $afterChild) {
            $afterChild($rootElement);
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
