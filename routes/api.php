<?php

use App\Http\Controllers\FoundItemController;
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
    Route::post('lost/create', [LostItemController::class, 'create']);
    Route::get('lost', [LostItemController::class, 'index']);
    Route::get('user_items/{id}', [UserController::class, 'get_user_items']);
    Route::put('lost/{id}', [LostItemController::class, 'edit']);
    Route::delete('lost/{id}', [LostItemController::class, 'destroy']);
    Route::post('found/create', [FoundItemController::class, 'create']);
    Route::get('found', [FoundItemController::class, 'index']);
    Route::put('found/{id}', [FoundItemController::class, 'edit']);
    Route::delete('found/{id}', [FoundItemController::class, 'destroy']);
});
Route::post('register', [UserController::class, 'register_user']);
Route::post('login', [UserController::class, 'login_user']);