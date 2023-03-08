<?php

namespace MichelJonkman\Director\Menu\Elements;

use MichelJonkman\Director\Element\Elements\RootElement;
use MichelJonkman\Director\Menu\Elements\Traits\AddsMenuElementsTrait;

class RootMenuElement extends RootElement implements RootMenuElementInterface
{
    use AddsMenuElementsTrait;

    protected function getCorrectElementClass(): string
    {
        return MenuElementInterface::class;
    }
}