<?php

use App\Http\Controllers\TripController;
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

Route::get('/', [TripController::class, 'index']);
Route::get('/range', [TripController::class, 'getDateRangeResult']);


Route::get('/tripValues', [TripController::class, 'iarCount']);
Route::get('/tripValues/inrange', [TripController::class, 'getDateRangeResult']);
Route::get('/anotherCount', [TripController::class, 'anotherCount']);
Route::get('/anotherCount/inrange', [TripController::class, 'getDateRangeAnotherResult']);

Route::get('/commission', [TripController::class, 'columnChart']);
Route::get('/sales', [TripController::class, 'salesPerformance']);

Route::get('/tripFilter', [TripController::class, 'tripFilter']);

