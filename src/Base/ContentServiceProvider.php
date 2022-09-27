<?php

namespace MichelJonkman\Director\Base;

use MichelJonkman\Director\Base\Console\PublicCommand;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use MichelJonkman\Director\Base\Middleware\HandleInertiaRequests;

class ContentServiceProvider extends ServiceProvider
{

    public function register()
    {

    }

    public function boot(Director $director)
    {

    }
}
