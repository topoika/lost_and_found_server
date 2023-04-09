<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\LostItemController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('users', [Controller::class, 'get_users']);
    Route::post('lost/create', [LostItemController::class, 'create']);
    Route::get('lost', [LostItemController::class, 'index']);
});
Route::post('register', [UserController::class, 'register_user']);
Route::post('login', [UserController::class, 'login_user']);