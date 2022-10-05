<?php

namespace MichelJonkman\Director\Http\Controllers\Settings;

use Inertia\Inertia;
use MichelJonkman\Director\Http\Controllers\Controller;

/**
 *
 */
class OverviewController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Settings/Overview');
    }
}