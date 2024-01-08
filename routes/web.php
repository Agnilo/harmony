<?php

namespace Routes;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;

/*Route::get('/', function () {
    return view('home');
});*/


Route::get('/', [HomeController::class, 'index'])->name('home'); // Nukreipimas į HomeController index() metodą pagrindiniame puslapyje
Route::get('/apie', function () {
    return view('about');
});
Route::get('/susisiekti', function () {
    return view('contact');
});

Auth::routes();

Route::get('/pagrindinis', [DashboardController::class, 'index'])->name('dashboard');