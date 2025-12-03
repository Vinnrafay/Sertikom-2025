<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TahunAjarController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Halaman login (bebas)
Route::get('/login', fn() => view('auth.login'))->name('login');
Route::get('/', fn() => redirect()->route('login'));

// AREA WAJIB LOGIN
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // MASTER DATA
    Route::resource('tahunajar', TahunAjarController::class);
    Route::resource('kelas', KelasController::class);
    Route::resource('jurusan', JurusanController::class);
    Route::resource('siswa', SiswaController::class);

    // UPDATE KELAS SISWA (tetap ada)
    Route::post('/siswa/{siswa}/update-kelas', 
        [SiswaController::class, 'updateKelas']
    )->name('siswa.updateKelas');

    // USER MANAGEMENT
    Route::resource('users', UserController::class);
});

require __DIR__.'/auth.php';
