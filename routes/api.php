<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("register", [ApiController::class, "register"])->name('api/register');
Route::post("login", [ApiController::class, "login"])->name('api/login');

Route::group([
    "middleware" => ["auth:api"]
], function(){

    Route::get("profile", [ApiController::class, "profile"])->name('api/profile');
    Route::get("refresh", [ApiController::class, "refreshToken"])->name('api/refresh');
    Route::post("update", [ApiController::class, "update"])->name('api/update');
    Route::get("logout", [ApiController::class, "logout"])->name('api/logout');
    Route::post("delete", [ApiController::class, "deleteUser"])->name('api/delete');
});