<?php

namespace MichelJonkman\Director\Menu\Elements;


use MichelJonkman\Director\Element\Elements\Traits\HasChildren;

class GroupMenuElement extends MenuElement implements GroupMenuElementInterface
{
    use HasChildren;

    protected string $typeName = 'GroupElement';
}