<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::middleware(['guest'])->group(function() {
    Route::get('/register', [AuthenticationController::class, 'registerPage'])->name('register.index');
    Route::post('/register', [AuthenticationController::class, 'register'])->name('register.submit');
    Route::post('/checkSponsor', [AuthenticationController::class, 'checkSponsor'])->name('register.checkSponsor');

    Route::get('/login', [AuthenticationController::class, 'loginPage'])->name('login.index');
    Route::post('/login', [AuthenticationController::class, 'login'])->name('login.submit');
});

Route::middleware(['auth'])->group(function() {
    Route::get('/logout', [AuthenticationController::class, 'logout'])->name('auth.logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::middleware(['admin'])->group(function() {
        Route::prefix('admin')->group(function () {

        });
    });
});
