<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\LocationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

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
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate']);
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('dashboard.index');
    Route::get('/schedule/index', [ScheduleController::class, 'index'])->name('schedule.index');
    Route::get('/schedule/detail/{id}', [ScheduleController::class, 'detail'])->name('schedule.detail');
    Route::post('/schedule/detail/store', [ScheduleController::class, 'store'])->name('schedule.store');
    Route::get('/history/index', [HistoryController::class, 'index'])->name('history.index');
    Route::get('/history/list', [HistoryController::class, 'historyList'])->name('history.list');
    Route::get('/history/detail/{pick_up_date}', [HistoryController::class, 'detail'])->name('history.detail');
    Route::get('/history/getLocations', [HistoryController::class, 'getLocations'])->name('history.getLocations');
    Route::get('/driver/index', [DriverController::class, 'index'])->name('driver.index');
    Route::get('/driver/search', [DriverController::class, 'search'])->name('driver.search');
    Route::get('/driver/create', [DriverController::class, 'create'])->name('driver.create');
    Route::post('/driver/store', [DriverController::class, 'store'])->name('driver.store');
    Route::get('/driver/edit/{id}', [DriverController::class, 'edit'])->name('driver.edit');
    Route::put('/driver/update/{id}', [DriverController::class, 'update'])->name('driver.update');
    Route::put('/driver/delete/{id}', [DriverController::class, 'delete'])->name('driver.delete');
    // Route::get('/location/index', [LocationController::class, 'index'])->name('location.index');
    // Route::post('/location/store', [LocationController::class, 'store'])->name('location.store');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/get-location', function () {
        $apiKey = 'AIzaSyCyVSNnBSC2inE88KAJEuFNWbtlSyvSbTg';
        $response = Http::post("https://www.googleapis.com/geolocation/v1/geolocate?key={$apiKey}");
    
        return $response->json();
    });
});
