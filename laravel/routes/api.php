<?php

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
Route::apiResource('/departemens',
App\Http\Controllers\DepartemenController::class); 

Route::apiResource('/pegawais',
App\Http\Controllers\PegawaiController::class); 

Route::apiResource('/proyeks',
App\Http\Controllers\ProyekController::class); 


