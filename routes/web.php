<?php

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function (Request $request) : RedirectResponse|View {
    if ($request->session()->has('registered-user')) {
        // send to dashboard with newly registered user
        $user = $request->session()->get('registered-user');

        return redirect()->route('dashboard')->with('user', $user);
    } else if ($request->hasCookie('auth-cookie')) {
        $userCookie = $request->cookie('auth-cookie');

        // validate the cookie and send to the dashboard
        return redirect()->route('dashboard')->with('user', $userCookie);
    }

    return redirect('/login');
})->name('home');

Route::controller(\App\Http\Controllers\AuthController::class)->group(function () {
    Route::get('/login', 'viewLogin')->name('login');
    Route::post('/login', 'tryLogin');
    Route::get('/register', 'viewRegister')->name('register');
    Route::post('/register', 'tryRegister');
});

Route::get('/dashboard', function(Request $request) : View|RedirectResponse
{
    if ($request->session()->has('user')) {
        return view('dashboard');
    }

    return redirect('/login');
})->name('dashboard');
