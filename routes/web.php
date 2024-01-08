<?php

namespace Routes;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BenefitsController;
use App\Http\Controllers\LeaveRequestController;
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

Route::middleware(['auth.redirect'])->group(function () {
    Route::get('/pagrindinis', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/privalumai', [BenefitsController::class, 'index'])->name('benefits');
    Route::get('/profilis', [ProfileController::class, 'index'])->name('profile');
    Route::get('/atostogos', [LeaveRequestController::class, 'index'])->name('leaveRequest');
});

// Route::get('/pagrindinis', [DashboardController::class, 'index'])
//     ->name('dashboard')
//     ->middleware('auth.redirect');

// Route::get('/privalumai', [BenefitsController::class, 'index'])
//     ->name('benefits')
//     ->middleware('auth.redirect');

// Route::get('/profilis', [ProfileController::class, 'index'])
//     ->name('profile')
//     ->middleware('auth.redirect');

// Route::get('/atostogos', [LeaveRequestController::class, 'index'])
//     ->name('leaveRequest')
//     ->middleware('auth.redirect');