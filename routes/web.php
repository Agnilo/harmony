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

Route::middleware(['auth.redirect', 'verified'])->group(function () {
    Route::get('/pagrindinis', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/privalumai', [BenefitsController::class, 'index'])->name('benefits');
    Route::get('/profilis', [ProfileController::class, 'index'])->name('profile');
    Route::get('/atostogos', [LeaveRequestController::class, 'index'])->name('leaveRequest');
    Route::get('/kolegos', [ColleaguesController::class, 'index'])->name('colleagues');
});

Route::middleware(['can:edit-users'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/naudotojai', [UserController::class, 'index'])->name('admin.users.index');

        Route::get('/naudotojai/{user}/redaguoti', [UserController::class, 'edit'])->name('admin.users.edit');
        Route::put('/naudotojai/{user}', [UserController::class, 'update'])->name('admin.users.update');

        Route::get('/naudotojai/sukurti', [UserController::class, 'create'])->name('admin.users.create');
        Route::post('/naudotojai', [UserController::class, 'store'])->name('admin.users.store');

        Route::delete('/naudotojai/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    });
});