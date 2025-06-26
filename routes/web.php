<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Autentikasi
require __DIR__.'/auth.php';

// Dashboard berdasarkan role
Route::middleware(['auth'])->group(function () {
    // Profile
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');

    // Admin
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        // Agenda
        Route::resource('agenda', AgendaController::class)->except(['show']);
        Route::get('agenda/{agenda}', [AgendaController::class, 'show'])->name('agenda.show');
        // Absensi
        Route::resource('absensi', AbsensiController::class);
        // Dokumen
        Route::resource('dokumen', DokumenController::class);
    });

    // User (anggota)
    Route::middleware(['role:anggota'])->group(function () {
        Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
        Route::get('/user/agenda', [UserController::class, 'agenda'])->name('user.agenda');
        Route::get('/user/absensi', [UserController::class, 'absensi'])->name('user.absensi');
        Route::get('/user/dokumen', [UserController::class, 'dokumen'])->name('user.dokumen');
    });
});

// Home
Route::get('/', function () {
    return view('dashboard');
});