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
   PESERTA CONTROLLERS
======================== */
use App\Http\Controllers\Peserta\DashboardController as PesertaDashboardController;
use App\Http\Controllers\Peserta\ProgramKegiatanController as PesertaKegiatanController;
use App\Http\Controllers\Peserta\LaporanController as PesertaLaporanController;
use App\Http\Controllers\Peserta\EvaluasiController as PesertaEvaluasiController;

/* ========================
   MENTOR CONTROLLERS
======================== */
use App\Http\Controllers\Mentor\DashboardController as MentorDashboardController;
use App\Http\Controllers\Mentor\ProgramKegiatanController as MentorKegiatanController;
use App\Http\Controllers\Mentor\LaporanController as MentorLaporanController;
use App\Http\Controllers\Mentor\EvaluasiController as MentorEvaluasiController;

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
        'peserta' => redirect()->route('peserta.dashboard'),
        'mentor'  => redirect()->route('mentor.dashboard'),
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
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class,'destroy'])->name('profile.destroy');

});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
->middleware(['auth', 'active', 'role:admin'])
->name('admin.')
->group(function () {

    Route::get('/dashboard', [DashboardController::class,'admin'])
        ->name('dashboard');

    /* USER */
    Route::resource('users', App\Http\Controllers\Admin\UserController::class);

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
    Route::resource('laporan', AdminLaporanController::class)
        ->only(['index','create','store','show', 'edit', 'update', 'destroy']);

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
| PESERTA ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'active', 'role:peserta'])
    ->prefix('peserta')
    ->name('peserta.')
    ->group(function () {

    Route::get('/dashboard', [PesertaDashboardController::class,'index'])
        ->name('dashboard');

    // KEGIATAN
    Route::resource('kegiatan', PesertaKegiatanController::class)
        ->only(['index','show']);

    // LAPORAN
    Route::resource('laporan', PesertaLaporanController::class)
        ->only(['index','create','store','show', 'edit', 'update', 'destroy']);

    Route::get('/laporan/{laporan}/cetak', [PesertaLaporanController::class, 'cetak'])
        ->name('laporan.cetak');

    // EVALUASI
    Route::resource('evaluasi', PesertaEvaluasiController::class)
        ->only(['index','show']);
    
    Route::get('evaluasi/{evaluasi}/pdf',
        [PesertaEvaluasiController::class,'pdf']
    )->name('evaluasi.pdf');

});


/*
|--------------------------------------------------------------------------
| MENTOR ROUTES
|--------------------------------------------------------------------------
*/

Route::prefix('mentor')
->middleware(['auth', 'active', 'role:mentor'])
->name('mentor.')
->group(function () {

    /* DASHBOARD */
    Route::get('/dashboard',
        [MentorDashboardController::class,'index']
    )->name('dashboard');

    /* KEGIATAN */
    Route::resource('kegiatan', MentorKegiatanController::class);
    Route::get('kegiatan/{kegiatan}/cetak',
        [MentorKegiatanController::class,'cetak']
    )->name('kegiatan.cetak');

    /* LAPORAN */
    Route::resource('laporan', MentorLaporanController::class)
        ->only(['index','show','destroy']);
    Route::get('laporan/{laporan}/cetak',[MentorLaporanController::class,'cetak']
    )->name('laporan.cetak');

    /* EVALUASI */
    Route::resource('evaluasi', MentorEvaluasiController::class)
        ->except(['destroy','create']);
    Route::get('evaluasi/create/{kegiatan}',
        [MentorEvaluasiController::class,'create']
    )->name('evaluasi.create');
    Route::get('evaluasi/{evaluasi}/pdf',
        [MentorEvaluasiController::class,'pdf']
    )->name('evaluasi.pdf');

});


require __DIR__.'/auth.php';