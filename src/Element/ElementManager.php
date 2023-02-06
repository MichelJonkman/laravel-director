<?php

namespace MichelJonkman\Director\Element;


use Illuminate\Foundation\Application;
use MichelJonkman\Director\Director;
use MichelJonkman\Director\Element\Elements\RootElementInterface;
use MichelJonkman\Director\Exceptions\Element\ElementValidationException;
use MichelJonkman\Director\Exceptions\Element\MissingModificationException;

class ElementManager
{
    /** @var ElementModification[] $modifications */
    protected array $modifications = [];

    protected array $cachedMenu = [];

    public function __construct(protected Application $app, protected Director $director, protected RootElementInterface $rootElement) { }

    /**
     * Adds a modification function, this functions receives a ElementsBuilder instance
     */
    public function modify(string $key, callable $modificationFunction): ElementModification
    {
        return $this->modifications[$key] = new ElementModification($modificationFunction);
    }

    /**
     * @return ElementModification[]
     * @throws MissingModificationException
     */
    public function orderModifications(): array
    {
        $modifications = [];

        foreach ($this->modifications as $modification) {
            if ($target = $modification->getTarget()) {
                if (!isset($this->modifications[$target])) {
                    throw new MissingModificationException("Target modification \"$target\" is not registered.");
                }

                if ($modification->isAfter()) {
                    $this->modifications[$target]->addAfter($modification);
                    continue;
                }

                $this->modifications[$target]->addBefore($modification);
                continue;
            }

            $modifications[] = $modification;
        }

        return $modifications;
    }

    /**
     * Runs the modifications and returns the builder
     * @throws MissingModificationException
     */
    public function getRoot(): RootElementInterface
    {
        foreach ($this->orderModifications() as $modification) {
            $modification($this->rootElement);
        }

        return $this->rootElement;
    }

    /**
     * @throws MissingModificationException
     * @throws ElementValidationException
     */
    public function getMenu(): array {
        if($this->director->menuIsCached()) {
            return $this->cachedMenu;
        }

        return $this->getRoot()->toArray();
    }

    /**
     * Used when in the menu cache file
     */
    public function setMenuCache(array $cache): void
    {
        $this->cachedMenu = $cache;
    }
}
