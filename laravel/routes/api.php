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

Route::apiResource('/pengguna',
App\Http\Controllers\PenggunaController::class); 

Route::apiResource('/buku',
App\Http\Controllers\BukuController::class); 

Route::apiResource('/penulis',
App\Http\Controllers\PenulisController::class); 

Route::apiResource('/peminjaman',
App\Http\Controllers\PeminjamanController::class); 



