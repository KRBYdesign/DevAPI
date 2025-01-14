<?php

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function (Request $request) : RedirectResponse|View {
    if ($request->hasCookie('user')) {
        // validate the user cookie then send to the home page
        return view('home');
    }

    return redirect('/login');
});

Route::get('/login', function (Request $request) : View {
   return view('login');
});

Route::get('/register', function (Request $request) : View {
   return view('register');
});
