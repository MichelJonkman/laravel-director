<?php

namespace MichelJonkman\Director\Middleware;

use Director;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'director::app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     *
     * @param  Request  $request
     *
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @param  Request  $request
     *
     * @return array
     */
    public function share(Request $request): array
    {
        $firstLoad = $request->inertia() ? [] : [
            'menu' => fn() => Director::menu()->getElements()
        ];

        return array_merge(parent::share($request), $firstLoad, [
            'flash' => [
                'toasts' => fn() => $request->session()->get('toasts')
            ]
        ]);
    }
}
