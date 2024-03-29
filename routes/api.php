<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

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


Route::post('/login',[UserController::class, 'login']);
Route::post('/register',[UserController::class, 'register']);

//Route::middleware('auth:api')->group(function () {
    Route::put('/user/update/{user}', [UserController::class, 'update']);
    Route::get('/user', [UserController::class, 'index']);
    Route::get('/product', [ProductController::class, 'index']);
//});

