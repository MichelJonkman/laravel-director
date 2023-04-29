<?php

namespace MichelJonkman\Director\Http\Controllers\Settings;

use Inertia\Inertia;
use MichelJonkman\Director\Exceptions\Element\ElementValidationException;
use MichelJonkman\Director\Exceptions\Element\MissingModificationException;
use MichelJonkman\Director\Facades\Director;
use MichelJonkman\Director\Http\Controllers\Controller;

/**
 *
 */
class OverviewController extends Controller
{
    /**
     * @throws ElementValidationException
     * @throws MissingModificationException
     */
    public function __invoke()
    {
        return Inertia::render('Settings/Overview', [
            'settings' => Director::settings()->getMenu()
        ]);
    }
}
