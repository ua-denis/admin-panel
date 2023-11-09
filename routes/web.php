<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/logout', [AuthenticatedSessionController::class, 'destroy']);

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified', 'can:access-profile'])
    ->name('dashboard');

Route::middleware(['auth', 'verified', 'can:access-admin'])->prefix('admin-panel')->group(function () {
    Route::get('/', [NewsController::class, 'index'])->name('news.index');
    Route::get('/edit/{id}', [NewsController::class, 'edit'])->name('news.edit');
    Route::put('/update/{id}', [NewsController::class, 'update'])->name('news.update');
    Route::get('/create', [NewsController::class, 'create'])->name('news.create');
    Route::post('/store', [NewsController::class, 'store'])->name('news.store');
    Route::delete('/destroy/{id}', [NewsController::class, 'destroy'])->name('news.destroy');
});

Route::middleware(['auth', 'verified', 'can:access-profile'])->prefix('profile')->group(function () {
    Route::get('/', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/edit/{id}', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/update/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/upload-photo', [ProfileController::class, 'uploadPhoto'])->name('profile.upload-photo');
    Route::delete('/delete/{id}', [ProfileController::class, 'destroy'])->name('profile.delete');
});

require __DIR__.'/auth.php';
