<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/home');
    }
    return view('welcome');
});

Auth::routes(['login' => true, 'logout' => true, 'register' => true, 'reset' => true, 'confirm' => true, 'verify' => true]);

Route::get('/home', [HomeController::class, 'index'])->name('home');