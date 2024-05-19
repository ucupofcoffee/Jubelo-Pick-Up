<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LocationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(['middleware' => 'guest'], function () {
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::post('/', [LoginController::class, 'authenticate']);
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard/index', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/driver/index', [DriverController::class, 'index'])->name('driver.index');
    Route::get('/driver/search', [DriverController::class, 'search'])->name('driver.search');
    Route::get('/driver/create', [DriverController::class, 'create'])->name('driver.create');
    Route::post('/driver/store', [DriverController::class, 'store'])->name('driver.store');
    Route::get('/driver/edit/{id}', [DriverController::class, 'edit'])->name('driver.edit');
    Route::put('/driver/update/{id}', [DriverController::class, 'update'])->name('driver.update');
    Route::delete('/driver/delete/{id}', [DriverController::class, 'delete'])->name('driver.delete');
    Route::get('/location/index', [LocationController::class, 'index'])->name('location.index');
    Route::post('/location/store', [LocationController::class, 'store'])->name('location.store');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});
