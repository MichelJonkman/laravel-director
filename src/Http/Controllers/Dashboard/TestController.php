<?php

namespace MichelJonkman\Director\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class TestController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Test');
    }
}
