<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\NetworkController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TestController;
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
Route::get('/test', [TestController::class, 'index']);

Route::middleware(['guest'])->group(function() {
    Route::get('/register', [AuthenticationController::class, 'registerPage'])->name('register.index');
    Route::post('/register', [AuthenticationController::class, 'register'])->name('register.submit');
    Route::post('/checkSponsor', [AuthenticationController::class, 'checkSponsor'])->name('register.checkSponsor');

    Route::get('/login', [AuthenticationController::class, 'loginPage'])->name('login.index');
    Route::post('/loginSubmit', [AuthenticationController::class, 'login'])->name('login.submit');
});

Route::middleware(['auth'])->group(function() {
    Route::get('/logout', [AuthenticationController::class, 'logout'])->name('auth.logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/earnings/{type?}', [IncomeController::class, 'index'])->name('income.index');
    Route::get('/orders/{type?}', [OrderController::class, 'index'])->name('orders.index');

    Route::get('/network', [NetworkController::class, 'index'])->name('network.index');
    Route::post('/network/getGenealogy', [NetworkController::class, 'getGenealogy'])->name('network.getGenealogy');

    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::post('/products/purchaseWinnersGem', [ProductController::class, 'purchaseWinnersGem'])->name('products.purchaseWinnersGem');
    Route::post('/products/placeOrder', [ProductController::class, 'placeOrder'])->name('products.placeOrder');

    Route::get('/account', [DashboardController::class, 'index'])->name('account.index');
    Route::get('/transfers', [DashboardController::class, 'index'])->name('transfers.index');
    Route::get('/conversions', [DashboardController::class, 'index'])->name('conversions.index');
    Route::get('/withdrawals', [DashboardController::class, 'index'])->name('withdrawals.index');
    Route::get('/terminal', [DashboardController::class, 'index'])->name('terminal.index');

    Route::middleware(['admin'])->group(function() {
        Route::prefix('admin')->group(function () {

        });
    });
});
