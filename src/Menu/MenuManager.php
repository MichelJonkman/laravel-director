<?php

namespace MichelJonkman\Director\Menu;


use Illuminate\Foundation\Application;
use MichelJonkman\Director\Director;
use MichelJonkman\Director\Exceptions\Menu\ElementValidationException;
use MichelJonkman\Director\Exceptions\Menu\MissingModificationException;
use MichelJonkman\Director\Menu\Elements\RootElementInterface;

class MenuManager
{
    /** @var MenuModification[] $modifications */
    protected array $modifications = [];

    protected array $cachedMenu = [];

    public function __construct(protected Application $app, protected Director $director, protected RootElementInterface $rootElement) { }

    /**
     * Adds a modification function, this functions receives a MenuBuilder instance
     */
    public function modify(string $key, callable $modificationFunction): MenuModification
    {
        return $this->modifications[$key] = new MenuModification($modificationFunction);
    }

    /**
     * @return MenuModification[]
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
     * @throws ElementValidationException
     * @throws MissingModificationException
     */
    public function getMenu(): array {
        if($this->director->menuIsCached()) {
            return $this->cachedMenu;
        }

        return $this->getRoot()->toArray();
    }
}
