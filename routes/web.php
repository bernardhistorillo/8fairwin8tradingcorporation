<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ConversionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\NetworkController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\WithdrawalController;
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
Route::get('/artisan', [TestController::class, 'artisan']);

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

    Route::get('/network', [NetworkController::class, 'index'])->name('network.index');
    Route::post('/network/getGenealogy', [NetworkController::class, 'getGenealogy'])->name('network.getGenealogy');

    Route::get('/products', [ProductController::class, 'index'])->name('products.index');

    Route::prefix('orders')->group(function () {
        Route::get('/{type?}', [OrderController::class, 'index'])->name('orders.index');
        Route::post('/viewItems', [OrderController::class, 'viewItems'])->name('orders.viewItems');
        Route::post('/updateProofOfPayment', [OrderController::class, 'updateProofOfPayment'])->name('orders.updateProofOfPayment');
        Route::post('/purchaseWinnersGem', [OrderController::class, 'purchaseWinnersGem'])->name('orders.purchaseWinnersGem');
        Route::post('/placeOrder', [OrderController::class, 'placeOrder'])->name('orders.placeOrder');
    });

    Route::prefix('transfers')->group(function () {
        Route::get('/{type?}', [TransferController::class, 'index'])->name('transfers.index');
        Route::post('/checkReceiver', [TransferController::class, 'checkReceiver'])->name('transfers.checkReceiver');
        Route::post('/submitTransfer', [TransferController::class, 'submitTransfer'])->name('transfers.submitTransfer');
    });

    Route::prefix('conversions')->group(function () {
        Route::get('/{type?}', [ConversionController::class, 'index'])->name('conversions.index');
        Route::post('/submitConversion', [ConversionController::class, 'submitConversion'])->name('conversions.submitConversion');
    });

    Route::prefix('withdrawals')->group(function () {
        Route::get('/', [WithdrawalController::class, 'index'])->name('withdrawals.index');
        Route::post('/submitWithdrawal', [WithdrawalController::class, 'submitWithdrawal'])->name('withdrawals.submitWithdrawal');
    });

    Route::get('/account', [DashboardController::class, 'index'])->name('account.index');
    Route::get('/terminal', [DashboardController::class, 'index'])->name('terminal.index');

    Route::middleware(['admin'])->group(function() {
        Route::prefix('admin')->group(function () {

        });
    });
});
