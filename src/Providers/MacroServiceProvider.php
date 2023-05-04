<?php

namespace MichelJonkman\Director\Providers;

use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class MacroServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Vite::macro('useHotFileFor', function (string $hotfile, callable $func) {
            $oldFile = Vite::hotFile();
            Vite::useHotFile($hotfile);
            $return = $func($this);
            Vite::useHotFile($oldFile);

            return $return;
        });
    }
}
