<?php

use App\Http\Controllers\Api\ListController;
use App\Http\Controllers\Api\UserController;
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
Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
Route::get('login-check', [UserController::class, 'loginCheck'])->name('login');
/************************************Authorized Api's*****************************************/
Route::middleware('auth:sanctum')->group(function () {
    Route::get('get-profile', [UserController::class, 'getProfile']);
    Route::get('notification', [ListController::class, 'getNotification']);
    Route::get('get-payment-history', [ListController::class, 'getpaymentHistory']);
    Route::get('logout', [UserController::class, 'logout']);
});
