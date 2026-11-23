<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function () {
    // Rota de login
    Route::get('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
    Route::post('/login', [App\Http\Controllers\AuthController::class, 'loginSubmit'])->name('login.submit');
});

Route::middleware(['auth'])->group(function () {
    // Rota de logout
    Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

    // Rota de troca de senha
    Route::get('/change-password', [App\Http\Controllers\AuthController::class, 'changePassword'])->name('change-password');
    Route::post('/change-password', [App\Http\Controllers\AuthController::class, 'changePasswordSubmit'])->name('change-password.submit');

    // Rota de dashboard
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});
