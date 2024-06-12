<?php

use App\Http\Controllers\Mobile\LoginController;
use App\Http\Controllers\Mobile\PickUpController;
use App\Http\Controllers\Mobile\PhotoController;
use App\Http\Controllers\Mobile\LocationController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/login', [LoginController::class, 'authenticate']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout']);
});
Route::get('/pickup', [PickUpController::class, 'index']);
Route::get('/pickup/{scheduleid}', [PickUpController::class, 'detail']);
Route::put('schedules/{scheduleid}/update', [PickUpController::class, 'update']);
Route::post('/photo', [PhotoController::class, 'store']);
Route::post('/location', [LocationController::class, 'store']);
