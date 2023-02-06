<?php

namespace MichelJonkman\Director\Element;


use Closure;
use MichelJonkman\Director\Element\Elements\RootElementInterface;

class ElementModification
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

    public function addBefore(ElementModification $modification): void
    {
        $this->beforeChildren[] = $modification;
    }

    public function addAfter(ElementModification $modification): void
    {
        $this->afterChildren[] = $modification;
    }
}
