<?php

namespace Routes;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

/*Route::get('/', function () {
    return view('home');
});*/


Route::get('/', [HomeController::class, 'index'])->name('home'); // Nukreipimas į HomeController index() metodą pagrindiniame puslapyje
