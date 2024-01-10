<?php

namespace Routes;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BenefitsController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ColleaguesController;
use Illuminate\Support\Facades\Auth;


/*Route::get('/', function () {
    return view('home');
});*/


// Route::get('/', [HomeController::class, 'index'])->name('home'); // Nukreipimas į HomeController index() metodą pagrindiniame puslapyje
// Route::get('/apie', function () {
//     return view('about');
// });
// Route::get('/susisiekti', function () {
//     return view('contact');
// });

Route::middleware(['guest'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/apie', function () { return view('about'); });
    Route::get('/susisiekti', function () { return view('contact'); });
});

Auth::routes();

Route::middleware(['auth.redirect'])->group(function () {
    Route::get('/pagrindinis', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/privalumai', [BenefitsController::class, 'index'])->name('benefits');
    Route::get('/profilis', [ProfileController::class, 'index'])->name('profile');
    Route::get('/atostogos', [LeaveRequestController::class, 'index'])->name('leaveRequest');
    Route::get('/kolegos', [ColleaguesController::class, 'index'])->name('colleagues');
});

Route::middleware(['can:edit-users'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    });
});