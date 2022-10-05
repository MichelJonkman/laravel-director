<?php

use Illuminate\Support\Facades\Route;
use MichelJonkman\Director\Http\Controllers\Dashboard\IndexController as DashboardIndexController;
use MichelJonkman\Director\Http\Controllers\Settings\OverviewController;

Route::get('/', DashboardIndexController::class)->name('dashboard.index');
Route::get('/test', \MichelJonkman\Director\Http\Controllers\Dashboard\TestController::class)->name('dashboard.test');
Route::get('/settings', OverviewController::class)->name('settings.overview');
