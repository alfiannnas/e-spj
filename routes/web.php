<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\KroController;
use App\Http\Controllers\RoController;
use App\Http\Controllers\KomponenController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\BelanjaHeaderController;

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

// Belanja Redesain Routes
Route::post('belanja-redesain/storeProgram', [BelanjaHeaderController::class, 'storeProgram'])->name('belanja-redesain.storeProgram');
Route::post('belanja-redesain/{belanjaHeader}/store-kro', [BelanjaHeaderController::class, 'storeKro'])->name('belanja-redesain.storeKro');
Route::post('belanja-redesain/{belanjaHeader}/store-ro', [BelanjaHeaderController::class, 'storeRo'])->name('belanja-redesain.storeRo');
Route::post('belanja-redesain/{belanjaHeader}/store-komponen', [BelanjaHeaderController::class, 'storeKomponen'])->name('belanja-redesain.storeKomponen');
Route::post('belanja-redesain/{belanjaHeader}/store-subkomponen', [BelanjaHeaderController::class, 'storeSubkomponen'])->name('belanja-redesain.storeSubkomponen');
Route::resource('belanja-redesain', BelanjaHeaderController::class);

// Settings Routes
Route::prefix('settings')->group(function () {
    Route::resource('program', ProgramController::class);
    Route::resource('kro', KroController::class);
    Route::resource('ro', RoController::class);
    Route::resource('komponen', KomponenController::class);
    Route::resource('akun', AkunController::class);
});