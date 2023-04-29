<?php

namespace MichelJonkman\Director\Settings\Elements;

use MichelJonkman\Director\Element\Elements\Traits\HasChildrenInterface;
use MichelJonkman\Director\Menu\Elements\MenuElementInterface;

interface PageElementInterface extends MenuElementInterface, HasChildrenInterface
{
    public function getTitle(): ?string;

    public function setTitle(?string $title): static;

    /**
     * URL slug used on settings page, recommended to use name
     */
    public function getSlug(): ?string;
}
