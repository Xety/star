<?php

use App\Http\Controllers\DashboardController;
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

// Home page
Route::get('/', function () {
    return view('welcome');
});

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// Authenticated Routes
Route::middleware('auth')->group(function () {
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Star Routes
    Route::get('/star/create', [StarController::class, 'create'])->name('star.create');
    Route::post('/star/store', [StarController::class, 'store'])->name('star.store');

    Route::get('/star/edit/{id}', [StarController::class, 'edit'])->name('star.edit');
    Route::patch('/star/update/{id}', [StarController::class, 'update'])->name('star.update');

    Route::delete('/star/destroy/{id}', [StarController::class, 'destroy'])->name('star.destroy');
});

require __DIR__ . '/auth.php';
