<?php

use App\Http\Controllers\AdminConversionController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminGenealogyController;
use App\Http\Controllers\AdminIncomeDistributionController;
use App\Http\Controllers\AdminItemController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AdminTransferController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminWinnersGemController;
use App\Http\Controllers\AdminWithdrawalController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ConversionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\NetworkController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PrivacyPolicyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TerminalController;
use App\Http\Controllers\TermsOfServiceController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\WithdrawalController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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
Route::get('/privacypolicy', [PrivacyPolicyController::class, 'index'])->name('privacyPolicy.index');
Route::get('/termsofservice', [TermsOfServiceController::class, 'index'])->name('termsOfService.index');

Route::get('/test', [TestController::class, 'index']);
Route::get('/artisan', [TestController::class, 'artisan']);

Route::middleware(['guest'])->group(function() {
    Route::get('/register', [AuthenticationController::class, 'registerPage'])->name('register.index');
    Route::post('/register', [AuthenticationController::class, 'register'])->name('register.submit');
    Route::post('/checkSponsor', [AuthenticationController::class, 'checkSponsor'])->name('register.checkSponsor');

    Route::get('/login', [AuthenticationController::class, 'loginPage'])->name('login.index');
    Route::post('/loginSubmit', [AuthenticationController::class, 'login'])->name('login.submit');

    Route::get('/ref/{referralCode}', [AuthenticationController::class, 'referral'])->name('register.referral');

    Route::get('/auth/redirect', function () {
        return Socialite::driver('facebook')->redirect();
    });

    Route::get('/auth/callback', function () {
        try {

            $user = Socialite::driver('facebook')->user();

            $finduser = User::where('facebook_id', $user->id)->first();

            if($finduser){

                Auth::login($finduser);

                return redirect()->intended('dashboard');

            }else{
                $newUser = User::updateOrCreate(['email' => $user->email],[
                    'name' => $user->name,
                    'facebook_id'=> $user->id,
                    'password' => encrypt('123456dummy')
                ]);

                Auth::login($newUser);

                return redirect()->intended('dashboard');
            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    });
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
        Route::post('/markOrderAsComplete', [OrderController::class, 'markOrderAsComplete'])->name('orders.markOrderAsComplete');
    });

    Route::prefix('incomedistribution')->group(function () {
        Route::get('/', [AdminIncomeDistributionController::class, 'index'])->name('admin.incomeDistribution.index');
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

    Route::prefix('terminal')->group(function () {
        Route::get('/{view?}', [TerminalController::class, 'index'])->name('terminal.index');
    });

    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
        Route::post('/editPersonalInfo', [ProfileController::class, 'editPersonalInfo'])->name('profile.editPersonalInfo');
        Route::post('/updateProfilePicture', [ProfileController::class, 'updateProfilePicture'])->name('profile.updateProfilePicture');

        Route::post('/sendEmailOTP', [ProfileController::class, 'sendEmailOTP'])->name('profile.sendEmailOTP');
        Route::post('/verifyEmail', [ProfileController::class, 'verifyEmail'])->name('profile.verifyEmail');

        Route::post('/sendResetPasswordLink', [ProfileController::class, 'sendResetPasswordLink'])->name('profile.sendResetPasswordLink');
        Route::get('/reset-password/{uuid}', [ProfileController::class, 'resetPasswordPage'])->name('profile.resetPasswordPage');
        Route::post('/resetPassword/{uuid}', [ProfileController::class, 'resetPassword'])->name('profile.resetPassword');
    });

    Route::middleware(['admin'])->group(function() {
        Route::prefix('admin')->group(function () {
            Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard.index');

            Route::prefix('users')->group(function () {
                Route::get('/', [AdminUserController::class, 'index'])->name('admin.users.index');
                Route::post('/setStockist', [AdminUserController::class, 'setStockist'])->name('admin.users.setStockist');
                Route::get('/accessUser/{userId}', [AdminUserController::class, 'accessUser'])->name('admin.users.accessUser');
            });

            Route::prefix('genealogy')->group(function () {
                Route::get('/', [AdminGenealogyController::class, 'index'])->name('admin.genealogy.index');
            });

            Route::prefix('winnersgem')->group(function () {
                Route::get('/', [AdminWinnersGemController::class, 'index'])->name('admin.winnersGem.index');
                Route::post('/approvePurchase', [AdminWinnersGemController::class, 'approvePurchase'])->name('admin.winnersGem.approvePurchase');
                Route::post('/removePurchase', [AdminWinnersGemController::class, 'removePurchase'])->name('admin.winnersGem.removePurchase');
                Route::post('/updateValue', [AdminWinnersGemController::class, 'updateValue'])->name('admin.winnersGem.updateValue');
            });

            Route::prefix('orders')->group(function () {
                Route::get('/', [AdminOrderController::class, 'index'])->name('admin.orders.index');
            });

            Route::prefix('items')->group(function () {
                Route::get('/', [AdminItemController::class, 'index'])->name('admin.items.index');
                Route::post('/addItem', [AdminItemController::class, 'addItem'])->name('admin.items.addItem');
                Route::post('/editItem', [AdminItemController::class, 'editItem'])->name('admin.items.editItem');
            });

            Route::prefix('conversions')->group(function () {
                Route::get('/', [AdminConversionController::class, 'index'])->name('admin.conversions.index');
            });

            Route::prefix('transfers')->group(function () {
                Route::get('/', [AdminTransferController::class, 'index'])->name('admin.transfers.index');
            });

            Route::prefix('withdrawals')->group(function () {
                Route::get('/', [AdminWithdrawalController::class, 'index'])->name('admin.withdrawals.index');
                Route::post('/setAsComplete', [AdminWithdrawalController::class, 'setAsComplete'])->name('admin.withdrawals.setAsComplete');
            });
        });
    });
});
