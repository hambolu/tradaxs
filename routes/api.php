<?php

use App\Http\Controllers\Apis\V1\AdminController;
use App\Http\Controllers\Apis\V1\AuthController;
use App\Http\Controllers\Apis\V1\Merchantp2pController;
use App\Http\Controllers\Apis\V1\SwapController;
use App\Http\Controllers\Apis\V1\UsersController;
use App\Http\Controllers\Apis\V1\WalletsController;
use App\Http\Controllers\Apis\V1\EmailVerification;
use App\Http\Controllers\Apis\V1\NewPasswordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware(['token','cors'])->group(function () {
    //auth

    Route::post('/v1/auth/login', [AuthController::class,'Login']);
    Route::resource('/v1/auth/register', UsersController::class);
    Route::post('/v1/auth/logout', [AuthController::class,'logout']);
    Route::post('/v1/forgot-password', [NewPasswordController::class, 'forgotPassword']);
    Route::post('/v1/reset-password', [NewPasswordController::class, 'reset']);

    //wallet
    Route::get('/v1/createWallet', [WalletsController::class,'createWallet']);
    Route::get('/v1/myWallets', [WalletsController::class,'myWallets']);

    Route::get('/v1/allAssets', [WalletsController::class,'allAssets']);

    //users
    Route::resource('/v1/users', UsersController::class);

    Route::post('/v1/email/verification-notification', [EmailVerification::class, 'sendVerificationEmail']);
    Route::get('/v1/verify-email/{id}/{hash}', [EmailVerification::class, 'verify'])->name('verification.verify');
    //Admin
    Route::get('/v1/allusers', [AdminController::class,'allUsers']);
    Route::get('/v1/merchantoffers', [AdminController::class,'mOffers']);
    Route::get('/v1/transactions', [AdminController::class,'trx']);
    Route::get('/v1/wallets', [AdminController::class,'wallets']);

    //Merchant
    Route::post('/v1/createOffer', [Merchantp2pController::class,'createOffer']);
    Route::post('/v1/buyOffer', [Merchantp2pController::class,'buyOffer']);

    //Swap
    Route::get('/v1/swap', [SwapController::class,'swap']);

});
