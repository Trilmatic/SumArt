<?php

use App\Http\Controllers\AutomationController;
use App\Http\Controllers\Automations\CheckSourceController;
use App\Http\Controllers\Automations\CreateController;
use App\Http\Controllers\Automations\IndexController;
use App\Http\Controllers\Automations\StoreController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::prefix('automations')->name('automations.')->group(function () {
        Route::get('/',IndexController::class)->name('index');
        Route::get('/create', CreateController::class)->name('create');
        Route::post('/source/check',  CheckSourceController::class)->name('source.check');
        Route::post('/store',  StoreController::class)->name('store');
    });
});
