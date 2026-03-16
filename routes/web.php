<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PemohonController;

/*
|--------------------------------------------------------------------------
| DEFAULT REDIRECT
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect('/login-admin');
});


/*
|--------------------------------------------------------------------------
| LOGIN ADMIN
|--------------------------------------------------------------------------
*/

Route::get('/login-admin', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login-admin', [AuthController::class, 'login'])->name('login.process');


/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login-admin');
})->name('logout');


/*
|--------------------------------------------------------------------------
| HALAMAN PEMOHON
|--------------------------------------------------------------------------
*/

Route::prefix('pemohon')->group(function () {

    // BERANDA
    Route::get('/', [PemohonController::class, 'beranda'])
        ->name('pemohon.beranda');

    // INFORMASI
    Route::get('/informasi', [PemohonController::class, 'informasi'])
        ->name('pemohon.informasi');

    // FORM PEMINJAMAN
    Route::get('/peminjaman', [PemohonController::class, 'peminjaman'])
        ->name('pemohon.peminjaman');

    // SIMPAN PEMINJAMAN
    Route::post('/peminjaman/simpan', [PemohonController::class, 'simpanPeminjaman'])
        ->name('pemohon.peminjaman.simpan');

    // HALAMAN STATUS
    Route::get('/status', [PemohonController::class, 'status'])
        ->name('pemohon.status');

    // CEK STATUS
    Route::post('/status/cek', [PemohonController::class, 'cekStatus'])
        ->name('pemohon.status.cek');

    // HALAMAN KONTAK
    Route::get('/kontak', [PemohonController::class, 'kontak'])
        ->name('pemohon.kontak');

    Route::get('/pemohon/status', [PemohonController::class,'status']);

Route::post('/pemohon/status/cek', [PemohonController::class,'cekStatus']);
});


/*
|--------------------------------------------------------------------------
| ADMIN AREA
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->middleware('auth')->group(function () {

    // DASHBOARD
    Route::get('/dashboard', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');

    // KELOLA PERMOHONAN
    Route::get('/kelola', [AdminController::class, 'kelola'])
        ->name('admin.kelola');

    // DETAIL PERMOHONAN
    Route::get('/permohonan/{id}', [AdminController::class, 'detail'])
        ->name('admin.detail');

    // SETUJUI PERMOHONAN
    Route::post('/setujui/{id}', [AdminController::class, 'setujui'])
        ->name('admin.setujui');

    // TOLAK PERMOHONAN
    Route::post('/tolak/{id}', [AdminController::class, 'tolak'])
        ->name('admin.tolak');

    // HALAMAN LAPORAN
    Route::get('/laporan', [AdminController::class, 'laporan'])
        ->name('admin.laporan');

    // EXPORT PDF
    Route::get('/laporan/pdf', [AdminController::class, 'laporanPdf'])
        ->name('admin.laporan.pdf');

    // EXPORT EXCEL
    Route::get('/laporan/excel', [AdminController::class, 'laporanExcel'])
        ->name('admin.laporan.excel');

});