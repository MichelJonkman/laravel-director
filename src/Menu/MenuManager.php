<?php

namespace MichelJonkman\Director\Menu;


use Illuminate\Foundation\Application;
use MichelJonkman\Director\Director;
use MichelJonkman\Director\Element\ElementManager;
use MichelJonkman\Director\Exceptions\Element\ElementValidationException;
use MichelJonkman\Director\Exceptions\Element\MissingModificationException;
use MichelJonkman\Director\Menu\Elements\RootMenuElementInterface;

class MenuManager extends ElementManager
{
    /** @var MenuModification[] $modifications */
    protected array $modifications = [];

    /**
     * Adds a modification function, this functions receives a MenuBuilder instance
     */
    public function modify(string $key, callable $modificationFunction): MenuModification
    {
        return $this->modifications[$key] = new MenuModification($modificationFunction);
    }
}
