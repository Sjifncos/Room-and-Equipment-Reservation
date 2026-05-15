<?php

use App\Http\Controllers\AuthController;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect('/login'));

Route::get('/login', [AuthController::class, 'showLogin'])
  ->name('login')->middleware('guest');

Route::post('/login', [AuthController::class, 'login'])
  ->middleware('throttle:10,1'); // hard cap: 10 requests/min regardless

Route::post('/logout', [AuthController::class, 'logout'])
  ->name('logout')->middleware('auth');

Route::middleware('auth')->group(function () {
  Route::get('/dashboard', fn() => Inertia::render('Dashboard'))
    ->name('dashboard');
});