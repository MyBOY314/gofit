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
//Untuk verifikasi email
// Auth::routes(['verify'=>true]);

Route::get('/', function () {
    return view('dashboard'); /* arahkan ke halaman dashboard */
});
//Route Resource
Route::resource('/departemen', \App\Http\Controllers\DepartemenController::class);
Route::resource('/pegawai', \App\Http\Controllers\PegawaiController::class);
Route::resource('/proyek',\App\Http\Controllers\ProyekController::class);

Route::apiResource('/pengguna',
App\Http\Controllers\PenggunaController::class); 

Route::apiResource('/buku',
App\Http\Controllers\BukuController::class); 

Route::apiResource('/penulis',
App\Http\Controllers\PenulisController::class); 

Route::apiResource('/peminjaman',
App\Http\Controllers\PeminjamanController::class); 