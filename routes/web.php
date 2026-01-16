<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;


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