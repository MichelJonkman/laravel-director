<?php

use Illuminate\Support\Facades\Route;
use MichelJonkman\Director\Http\Controllers\Dashboard\IndexController as DashboardIndexController;

Route::get('/', DashboardIndexController::class)->name('dashboard.index');
