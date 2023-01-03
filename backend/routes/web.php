<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::name('auth.')->controller(App\Http\Controllers\AuthController::class)->group(function() {
    Route::get('/', 'login')->name('login');
    Route::get('/register', 'register')->name('register');
    Route::get('/recovery', 'recovery')->name('recovery');
});

Route::prefix('/dashboard')->name('dashboard.')->controller(App\Http\Controllers\DashboardController::class)->group(function() {
    Route::get('/', 'index')->name('index');
});