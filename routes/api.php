<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Apis\AuthController;
use App\Http\Controllers\Merchantp2pController;
use App\Http\Controllers\SwapController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\WalletsController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['token','cors'])->group(function () {
    //auth

    Route::post('/auth/login', [AuthController::class,'Login']);
    Route::resource('/auth/register', UsersController::class);
    //wallet
    Route::get('/createWallet', [WalletsController::class,'createWallet']);
    Route::get('/myWallets', [WalletsController::class,'myWallets']);

    //users
    Route::resource('/users', UsersController::class);


    //Admin
    Route::get('/allusers', [AdminController::class,'allUsers']);
    Route::get('/merchantoffers', [AdminController::class,'mOffers']);
    Route::get('/transactions', [AdminController::class,'trx']);
    Route::get('/wallets', [AdminController::class,'wallets']);

    //Merchant
    Route::post('/createOffer', [Merchantp2pController::class,'createOffer']);
    Route::post('/buyOffer', [Merchantp2pController::class,'buyOffer']);

    //Swap
    Route::get('/swap', [SwapController::class,'swap']);

});
