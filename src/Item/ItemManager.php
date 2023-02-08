<?php

namespace MichelJonkman\Director\Item;


use Illuminate\Foundation\Application;
use MichelJonkman\Director\Director;
use MichelJonkman\Director\Item\Items\RootItemInterface;
use MichelJonkman\Director\Exceptions\Item\ItemValidationException;
use MichelJonkman\Director\Exceptions\Item\MissingModificationException;

class ItemManager
{
    /** @var ItemModification[] $modifications */
    protected array $modifications = [];

    protected array $cachedMenu = [];

    public function __construct(protected Application $app, protected Director $director, protected RootItemInterface $rootItem) { }

    /**
     * Adds a modification function, this functions receives a ItemsBuilder instance
     */
    public function modify(string $key, callable $modificationFunction): ItemModification
    {
        return $this->modifications[$key] = new ItemModification($modificationFunction);
    }

    /**
     * @return ItemModification[]
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
    public function getRoot(): RootItemInterface
    {
        foreach ($this->orderModifications() as $modification) {
            $modification($this->rootItem);
        }

        return $this->rootItem;
    }

    /**
     * @throws MissingModificationException
     * @throws ItemValidationException
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
