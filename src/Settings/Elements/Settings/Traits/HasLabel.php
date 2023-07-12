<?php

namespace MichelJonkman\Director\Settings\Elements\Settings\Traits;

trait HasLabel
{
    protected ?string $label = null;

    public function setLabel(?string $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }
}
