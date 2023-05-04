<?php

namespace MichelJonkman\Director\Settings\Elements;

use Illuminate\Support\Facades\Vite;
use Illuminate\Support\Str;
use MichelJonkman\Director\Director;
use MichelJonkman\Director\Element\Elements\Traits\HasChildren;

class SettingsMenuElement extends SettingsElement implements SettingsMenuElementInterface
{
    protected string $typeName = 'SettingsMenuElement';

    public function getData(): array
    {
        return array_merge(parent::getData(), [
            'isMenu' => true
        ]);
    }

    public function getValidationRules(): array
    {
        return array_merge(parent::getValidationRules(), [
            'isMenu' => 'required'
        ]);
    }
}
