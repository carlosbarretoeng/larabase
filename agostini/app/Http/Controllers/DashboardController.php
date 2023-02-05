<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    function index () {
        return Inertia::render('Dashboard');
    }

    function stats (Request $request) {
        $metric = $request->get('metric');
        switch ($metric){
            case 'Chart_TempoParado':
                return [];
            default:
                return response(0);
        }
    }
}
