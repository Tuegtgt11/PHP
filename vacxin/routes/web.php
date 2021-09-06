<?php

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

Route::get('/',[\App\Http\Controllers\Front\HomeController::class,'index']);
Route::post('index',[\App\Http\Controllers\Front\HomeController::class,'store'])->name('store');
Route::post('/',[\App\Http\Controllers\Front\HomeController::class,'index'])->name('index');
Route::get('/search',[\App\Http\Controllers\Front\HomeController::class,'search']);
Route::get('/',[\App\Http\Controllers\Front\HomeController::class,'getDashboard']);
