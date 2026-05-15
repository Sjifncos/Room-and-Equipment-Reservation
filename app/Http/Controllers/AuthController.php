<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Inertia\Inertia;

class AuthController extends Controller {

  public function showLogin() {
    return Inertia::render('Auth/Login');
  }

  public function login(Request $request) {
    $request->validate([
      'email'    => ['required', 'email'],
      'password' => ['required'],
    ]);

    // Rate limit key: email + IP
    $key = Str::lower($request->email) . '|' . $request->ip();

    if (RateLimiter::tooManyAttempts($key, 5)) {
      $seconds = RateLimiter::availableIn($key);

      return back()->withErrors([
        'email' => "Too many login attempts. Please try again in {$seconds} seconds.",
      ]);
    }

    if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
      RateLimiter::clear($key); // reset on successful login
      $request->session()->regenerate();
      return redirect()->intended('/dashboard');
    }

    RateLimiter::hit($key, 60); // increment attempts, decay in 60 seconds
    $remaining = 5 - RateLimiter::attempts($key);

    return back()->withErrors([
      'email' => "These credentials do not match our records. {$remaining} attempt(s) remaining.",
    ]);
  }

  public function logout(Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
  }
}