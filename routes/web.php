<?php

use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\ProgramKegiatanController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = auth()->user();

    return match ($user->role) {
        'admin'   => redirect()->route('admin.dashboard'),
        'pegawai' => redirect()->route('pegawai.dashboard'),
        'atasan'  => redirect()->route('atasan.dashboard'),
        default   => abort(403),
    };
})->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')
    ->middleware(['auth', 'role:admin'])
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', fn () => view('admin.dashboard'))
            ->name('dashboard');

        Route::resource('users', UserController::class);
        Route::resource('kegiatan', ProgramKegiatanController::class);

        Route::patch('users/{user}/toggle',
            [UserController::class, 'toggleActive']
        )->name('users.toggle');

        Route::get('kegiatan', [ProgramKegiatanController::class, 'index'])
            ->name('kegiatan.index');

        Route::post('kegiatan', [ProgramKegiatanController::class, 'store'])
            ->name('kegiatan.store');

        Route::get('kegiatan/{kegiatan}/cetak',
            [ProgramKegiatanController::class, 'cetak'])
            ->name('kegiatan.cetak');

        Route::resource('laporan', LaporanController::class);

        Route::get('laporan/{laporan}/cetak',
            [LaporanController::class,'cetak'])
            ->name('laporan.cetak');


});



Route::middleware(['auth', 'role:pegawai'])->group(function () {
    Route::get('/pegawai/dashboard', fn () => view('pegawai.dashboard'))
        ->name('pegawai.dashboard');
});

Route::middleware(['auth', 'role:atasan'])->group(function () {
    Route::get('/atasan/dashboard', fn () => view('atasan.dashboard'))
        ->name('atasan.dashboard');
});


require __DIR__.'/auth.php';
