<?php

use App\Http\Controllers\ConditionController;
use App\Http\Controllers\ScheduleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GrowfridgeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',
    [GrowfridgeController::class, 'getLastValuesWelcome']
);

Route::get('/dashboard',
    [GrowfridgeController::class, 'getLastValues'])
    ->middleware(['auth'])->name('dashboard');

Route::resource('conditions',ConditionController::class);

Route::resource('schedule',ScheduleController::class);

require __DIR__.'/auth.php';
