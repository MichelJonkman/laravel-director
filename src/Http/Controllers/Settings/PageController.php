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
class PageController extends Controller
{
    /**
     * @throws ElementValidationException
     * @throws MissingModificationException
     */
    public function __invoke(string $slug = null)
    {
        return Inertia::render('Settings/Page', [
            'settings' => Director::settings()->getMenu(),
            'slug' => $slug
        ]);
    }
}
