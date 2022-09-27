<?php

use Illuminate\Support\Facades\Route;
use MichelJonkman\Director\Base\Http\Controllers\Dashboard\IndexController as DashboardIndexController;

Route::get('/', DashboardIndexController::class)->name('dashboard.index');
