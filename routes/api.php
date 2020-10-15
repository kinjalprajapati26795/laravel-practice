<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DashboardController;

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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
/*Route::get('sign-up', function () {
    return view('welcome');
});*/
Route::post('sign-up',[AuthController::class, 'signup'])->name('user.signup');

Route::post('login',[AuthController::class, 'login'])->name('user.login');

Route::get('search-connection', [App\Http\Controllers\Api\DashboardController::class, 'searchConnection'])->name('search-connection');

