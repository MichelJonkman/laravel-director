<?php

namespace MichelJonkman\Director\Facades;

use Illuminate\Support\Facades\Facade;

/**
 *
 */
class Director extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \MichelJonkman\Director\Director::class;
    }
}