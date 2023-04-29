<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use MichelJonkman\Director\Http\Controllers\Dashboard\IndexController as DashboardIndexController;
use MichelJonkman\Director\Http\Controllers\Dashboard\TestController;
use MichelJonkman\Director\Http\Controllers\Settings\PageController;

Route::get('/', function () {
    return redirect()->route('director.dashboard.index');
});
Route::get('/dashboard', DashboardIndexController::class)->name('dashboard.index');
Route::get('/test', TestController::class)->name('dashboard.test');
Route::get('/fieldtypes', function () { return Inertia::render('FieldtypeExample'); })->name('dashboard.fieldtypes');
Route::get('/settings/{slug?}', PageController::class)->name('settings.page');
