<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class AuthController extends Controller
{
    function login()
    {
        return Inertia::render('Auth/Login', [
            'canRegister' => Route::has('register')
        ]);
    }

    function register()
    {
        return Inertia::render('Auth/RecoveryPassword', []);
    }

    function recovery()
    {
        return $this->register();
    }
}
