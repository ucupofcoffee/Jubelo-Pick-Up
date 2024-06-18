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
Route::post('/locations', [LocationController::class, 'store']);
Route::get('photos/transaction/{transaction_id}', [PhotoController::class, 'getPhotoId']);
Route::post('/photos', [PhotoController::class, 'store']);
Route::put('/schedules/updateByTransactionId/{transaction_id}', [PickUpController::class, 'updateByTransactionId']);
Route::get('/driver', [PickUpController::class, 'getDriverDetails']);
Route::get('schedules/transaction/{transaction_id}', [PickUpController::class, 'getScheduleIdByTransactionId']);

