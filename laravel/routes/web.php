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
    Route::resource('/instruktur',\App\Http\Controllers\InstrukturController::class);

    Route::apiResource('/pengguna',
    App\Http\Controllers\PenggunaController::class); 

    Route::apiResource('/buku',
    App\Http\Controllers\BukuController::class); 

    Route::apiResource('/penulis',
    App\Http\Controllers\PenulisController::class); 

    Route::apiResource('/peminjaman',
    App\Http\Controllers\PeminjamanController::class); 

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

    Route::middleware(['auth'])->group(function () {
        // your protected routes
    });

    Route::get('/{any}', function () {
        return view('app');
    })->where('any', '.*');

    Route::get('admin/calendarDashboard', function() {
            return view('calendarDashboard');
    });
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
