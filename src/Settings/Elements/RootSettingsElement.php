<?php

namespace MichelJonkman\Director\Settings\Elements;

use MichelJonkman\Director\Element\Elements\RootElement;
use MichelJonkman\Director\Menu\Elements\Traits\AddsMenuElementsTrait;

class RootSettingsElement extends RootElement implements RootSettingsElementInterface
{

    protected function getCorrectElementClass(): string
    {
        return SettingsElementInterface::class;
    }
}
