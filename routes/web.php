<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;

/* ========================
   ADMIN CONTROLLERS
======================== */
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BidangController;
use App\Http\Controllers\Admin\ProgramKegiatanController as AdminKegiatanController;
use App\Http\Controllers\Admin\LaporanController as AdminLaporanController;
use App\Http\Controllers\Admin\EvaluasiController as AdminEvaluasiController;

/* ========================
   PEGAWAI CONTROLLERS
======================== */
use App\Http\Controllers\Pegawai\DashboardController as PegawaiDashboardController;
use App\Http\Controllers\Pegawai\ProgramKegiatanController as PegawaiKegiatanController;
use App\Http\Controllers\Pegawai\LaporanController as PegawaiLaporanController;
use App\Http\Controllers\Pegawai\EvaluasiController as PegawaiEvaluasiController;

/* ========================
   ATASAN CONTROLLERS
======================== */
use App\Http\Controllers\Atasan\DashboardController as AtasanDashboardController;
use App\Http\Controllers\Atasan\ProgramKegiatanController as AtasanKegiatanController;
use App\Http\Controllers\Atasan\LaporanController as AtasanLaporanController;
use App\Http\Controllers\Atasan\EvaluasiController as AtasanEvaluasiController;

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| REDIRECT DASHBOARD BERDASARKAN ROLE
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {

    $user = auth()->user();

    return match ($user->role) {
        'admin'   => redirect()->route('admin.dashboard'),
        'pegawai' => redirect()->route('pegawai.dashboard'),
        'atasan'  => redirect()->route('atasan.dashboard'),
        default   => abort(403),
    };

})->middleware('auth')->name('dashboard');

/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class,'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class,'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class,'destroy'])->name('profile.destroy');

});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
->middleware(['auth','role:admin'])
->name('admin.')
->group(function () {

    Route::get('/dashboard', [DashboardController::class,'admin'])
        ->name('dashboard');

    /* USER */
    Route::resource('users', UserController::class);

    Route::patch('users/{user}/toggle',
        [UserController::class,'toggleActive']
    )->name('users.toggle');

    /* BIDANG */
    Route::resource('bidang', BidangController::class);

    /* KEGIATAN */
    Route::resource('kegiatan', AdminKegiatanController::class);

    Route::get('kegiatan/{kegiatan}/cetak',
        [AdminKegiatanController::class,'cetak']
    )->name('kegiatan.cetak');

    /* LAPORAN */
    Route::resource('laporan', AdminLaporanController::class);

    Route::get('laporan/{laporan}/cetak',
        [AdminLaporanController::class,'cetak']
    )->name('laporan.cetak');

    /* EVALUASI */
    Route::resource('evaluasi', AdminEvaluasiController::class)
        ->except(['create']);

    Route::get('evaluasi/create/{kegiatan}',
        [AdminEvaluasiController::class,'create']
    )->name('evaluasi.create');

    Route::get('evaluasi/{evaluasi}/pdf',
        [AdminEvaluasiController::class,'pdf']
    )->name('evaluasi.pdf');

});


/*
|--------------------------------------------------------------------------
| PEGAWAI ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth','role:pegawai'])
    ->prefix('pegawai')
    ->name('pegawai.')
    ->group(function () {

    Route::get('/dashboard', [PegawaiDashboardController::class,'index'])
        ->name('dashboard');

    // KEGIATAN
    Route::resource('kegiatan', PegawaiKegiatanController::class)
        ->only(['index','show']);

    // LAPORAN
    Route::resource('laporan', PegawaiLaporanController::class)
        ->only(['index','create','store','show']);

    Route::get('/laporan/{laporan}/cetak', [PegawaiLaporanController::class, 'cetak'])
        ->name('laporan.cetak');

    // EVALUASI
    Route::resource('evaluasi', PegawaiEvaluasiController::class)
        ->only(['index','show']);
    
    Route::get('evaluasi/{evaluasi}/pdf',
        [PegawaiEvaluasiController::class,'pdf']
    )->name('evaluasi.pdf');

});


/*
|--------------------------------------------------------------------------
| ATASAN ROUTES
|--------------------------------------------------------------------------
*/

Route::prefix('atasan')
->middleware(['auth','role:atasan'])
->name('atasan.')
->group(function () {

    /* DASHBOARD */
    Route::get('/dashboard',
        [AtasanDashboardController::class,'index']
    )->name('dashboard');

    /* KEGIATAN */
    Route::resource('kegiatan', AtasanKegiatanController::class);
    Route::get('kegiatan/{kegiatan}/cetak',
        [AtasanKegiatanController::class,'cetak']
    )->name('kegiatan.cetak');

    /* LAPORAN */
    Route::resource('laporan', AtasanLaporanController::class)
        ->only(['index','show','destroy']);
    Route::get('laporan/{laporan}/cetak',[AtasanLaporanController::class,'cetak']
    )->name('laporan.cetak');

    /* EVALUASI */
    Route::resource('evaluasi', AtasanEvaluasiController::class)
        ->except(['destroy']);
    Route::get('evaluasi/create/{kegiatan}',
        [AtasanEvaluasiController::class,'create']
    )->name('evaluasi.create');
    Route::get('evaluasi/{evaluasi}/edit', [AtasanEvaluasiController::class,'edit']
    )->name('evaluasi.edit');
    Route::get('evaluasi/{evaluasi}/pdf',
        [AtasanEvaluasiController::class,'pdf']
    )->name('evaluasi.pdf');

});


require __DIR__.'/auth.php';