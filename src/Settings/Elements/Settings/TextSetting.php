<?php

namespace MichelJonkman\Director\Settings\Elements\Settings;

use MichelJonkman\Director\Settings\Elements\Settings\Traits\HasLabel;
use MichelJonkman\Director\Settings\Elements\Settings\Traits\HasPlaceholder;

class TextSetting extends SettingElement
{
    use HasLabel, HasPlaceholder;

    protected string $typeName = 'TextSetting';

    public function getData(): array
    {
        return array_merge(parent::getData(), [
            'label' => $this->getLabel(),
            'placeholder' => $this->getPlaceholder()
        ]);
    }

    public function getValidationRules(): array
    {
        return array_merge(parent::getValidationRules(), [
            'label' => 'nullable',
            'placeholder' => 'nullable'
        ]);
    }
}
