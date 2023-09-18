<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/create', [DashboardController::class, 'create'])->name('dashboard.create');
        Route::post('/store', [DashboardController::class, 'store'])->name('dashboard.store');
        Route::get('/edit/{element}', [DashboardController::class, 'edit'])->name('dashboard.edit');
        Route::put('/update/{element}', [DashboardController::class, 'update'])->name('dashboard.update');
        Route::delete('/delete/{element}', [DashboardController::class, 'delete'])->name('dashboard.delete');
    });
});


Route::get('/error', [IndexController::class, 'error'])->name('error');
Route::get('/{element}', [IndexController::class, 'index'])->name('index');
