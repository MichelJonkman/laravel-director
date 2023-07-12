<?php

namespace MichelJonkman\Director\Settings\Elements\Settings\Traits;

trait HasPlaceholder
{
    protected ?string $placeholder = null;

    public function setPlaceholder(?string $placeholder): static
    {
        $this->placeholder = $placeholder;

        return $this;
    }

    public function getPlaceholder(): ?string
    {
        return $this->placeholder;
    }
}
