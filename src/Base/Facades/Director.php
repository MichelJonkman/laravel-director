<?php

namespace MichelJonkman\Director\Base\Facades;

use Illuminate\Support\Facades\Facade;

/**
 *
 */
class Director extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \MichelJonkman\Director\Base\Director::class;
    }
}