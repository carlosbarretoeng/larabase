<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::redirect('/', '/login');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard');
    Route::get('/dashboard/stats', 'App\Http\Controllers\DashboardController@stats')->name('dashboard.stats');

    Route::middleware(['role:super-administrador'])->prefix('system')->group(function () {
        Route::resource('/users', App\Http\Controllers\UserController::class)->names('users');
    });
});
