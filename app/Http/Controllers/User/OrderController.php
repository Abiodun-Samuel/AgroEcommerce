<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function trackOrder(Request $request)
    {
        return Inertia::render('Home', [
            // 'canLogin' => Route::has('login'),
            // 'canRegister' => Route::has('register'),
            // 'laravelVersion' => Application::VERSION,
            // 'phpVersion' => PHP_VERSION,

        ]);
    }
}