<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\MemberController as ApiMemberController;
use App\Http\Controllers\MemberController as MemberController;

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

//GOFIT
Route::apiResource('/kelas',
App\Http\Controllers\KelasController::class); 

Route::apiResource('/instruktur',
App\Http\Controllers\InstrukturController::class); 

Route::apiResource('/member',
App\Http\Controllers\MemberController::class); 

Route::apiResource('/jadwalUmum',
App\Http\Controllers\JadwalUmumController::class); 

Route::apiResource('/jadwalHarian',
App\Http\Controllers\JadwalHarianController::class); 

Route::apiResource('/depositReguler',
App\Http\Controllers\DepositRegulerController::class); 

Route::apiResource('/aktivasi',
App\Http\Controllers\AktivasiController::class); 

Route::apiResource('/depositKelas',
App\Http\Controllers\DepositKelasController::class); 

Route::apiResource('/izinInstruktur',
App\Http\Controllers\IzinInstrukturController::class); 

Route::apiResource('/presensiGym',
App\Http\Controllers\PresensiGymController::class); 

Route::apiResource('/bookingGym',
App\Http\Controllers\BookingGymController::class); 

Route::middleware('auth:sanctum')->get('/user', function (Request $request){
    return $request->user();
});
Route::post('resetTerlambat','App\Http\Controllers\InstrukturController@resetTerlambat');
Route::post('expiredKelas','App\Http\Controllers\MemberController@expiredKelas');

//Laporan Pendapatan
Route::get('/pendapatan-sum/{year}', [App\Http\Controllers\DepositRegulerController::class, 'getMonthlySum']);

Route::get('/aktivasi-sum/{year}', [App\Http\Controllers\AktivasiController::class, 'getMonthlyAktivasi']);

Route::get('/kelas-sum/{year}', [App\Http\Controllers\DepositKelasController::class, 'getMonthlyClass']);

//Laporan Aktifitas Gym
Route::get('/gym-rep/{year}/{month}/{day}', [App\Http\Controllers\PresensiGymController::class, 'countPresenceInGym']);
//Mobile
// Route::apiResource('/member',
// App\Http\Controllers\api\ApiMemberController::class); 

Route::post('login', [LoginController::class, 'login'])->name('login');




