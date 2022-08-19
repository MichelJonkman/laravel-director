<?php

namespace MichelJonkman\Director\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function __invoke()
    {
        return 'test';
    }
}
