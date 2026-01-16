<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\KroController;


// Login Routes
Route::get('/', function () {
    return redirect('login');
});
Route::get('/login', function () {
    return view('login');
});
Route::post('/login', [UserController::class, 'login'])->name('login');

// Dashboard Routes
Route::resource('dashboard', DashboardController::class);

// Settings Routes
Route::prefix('settings')->group(function () {
    Route::resource('program', ProgramController::class);
    Route::resource('kro', KroController::class);
});