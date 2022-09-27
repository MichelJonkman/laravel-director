<?php

namespace MichelJonkman\Director\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use MichelJonkman\Director\Middleware\HandleInertiaRequests;

class RouteServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Route::prefix(config('director.route_prefix'))
            ->name('director.')
            ->middleware([config('director.route_middleware'), HandleInertiaRequests::class])
            ->group(function () {
                $this->loadRoutesFrom(__DIR__.'/../../routes/admin.php');
            });
    }
}
