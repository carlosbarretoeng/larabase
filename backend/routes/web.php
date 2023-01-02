<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Auth/Login', [
        'canRegister' => Route::has('register')
    ]);
})->name('auth.login');

Route::get('/recovery', function () {
    return Inertia::render('Auth/RecoveryPassword', [
    ]);
})->name('auth.recovery');

