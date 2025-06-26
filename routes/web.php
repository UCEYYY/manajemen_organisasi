<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\ProfileController;

// Autentikasi Laravel Breeze/Fortify
require __DIR__.'/auth.php';

// ✅ Redirect ke dashboard berdasarkan role
Route::get('/dashboard', function () {
    $user = Auth::user();

    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($user->role === 'anggota') {
        return redirect()->route('user.dashboard');
    }

    abort(403, 'Unauthorized');
})->middleware(['auth'])->name('dashboard');

// ✅ Group route dengan middleware 'auth' & 'role'
Route::middleware(['auth'])->group(function () {
    // ✅ Profile route
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    // ✅ Admin group
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::resource('agenda', AgendaController::class)->except(['show']);
        Route::get('agenda/{agenda}', [AgendaController::class, 'show'])->name('agenda.show');
        Route::resource('absensi', AbsensiController::class);
        Route::resource('dokumen', DokumenController::class);
    });

    // ✅ User/anggota group
    Route::middleware(['role:anggota'])->group(function () {
        Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
        Route::get('/user/agenda', [UserController::class, 'agenda'])->name('user.agenda');
        Route::get('/user/absensi', [UserController::class, 'absensi'])->name('user.absensi');
        Route::get('/user/dokumen', [UserController::class, 'dokumen'])->name('user.dokumen');
    });
});

// ✅ Route awal (root) diarahkan ke form login
Route::get('/', function () {
    return view('auth.login');
});
