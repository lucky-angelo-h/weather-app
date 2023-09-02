<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', DashboardController::class);
Route::get('/api/get-weather/{place}', [ApiController::class, 'getWeather']);

Route::get('/{any?}', [DashboardController::class, 'index'])->where('any', '.*');
