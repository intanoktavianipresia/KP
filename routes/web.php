<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PemohonController;
// ✅ FIX 1: Tambahkan ini jika kamu memang punya LaporanController
// use App\Http\Controllers\LaporanController; 

/*
|--------------------------------------------------------------------------
| REDIRECT AWAL
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect('/login-admin');
});

/*
|--------------------------------------------------------------------------
| AUTH ADMIN
|--------------------------------------------------------------------------
*/
Route::get('/login-admin', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login-admin', [AuthController::class, 'login'])->name('login.process');

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login-admin');
})->name('logout');


/*
|--------------------------------------------------------------------------
| PEMOHON
|--------------------------------------------------------------------------
*/
Route::prefix('pemohon')->group(function () {

    Route::get('/', [PemohonController::class, 'beranda'])->name('pemohon.beranda');
    Route::get('/informasi', [PemohonController::class, 'informasi'])->name('pemohon.informasi');
    Route::get('/peminjaman', [PemohonController::class, 'peminjaman'])->name('pemohon.peminjaman');
    Route::post('/peminjaman/simpan', [PemohonController::class, 'simpanPeminjaman'])->name('pemohon.peminjaman.simpan');

    // STATUS
    Route::get('/status', [PemohonController::class, 'status'])->name('pemohon.status');
    Route::post('/status/cek', [PemohonController::class, 'cekStatus'])->name('pemohon.status.cek');
    Route::get('/status/riwayat/{id}', [PemohonController::class, 'riwayat'])->name('pemohon.riwayat');

    // KONTAK
    Route::get('/kontak', [PemohonController::class, 'kontak'])->name('pemohon.kontak');
    Route::post('/kontak/kirim', [PemohonController::class, 'kirimKontak'])->name('pemohon.kontak.kirim');
});


/*
|--------------------------------------------------------------------------
| ADMIN (WAJIB LOGIN)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware('auth')->group(function () {

    // DASHBOARD
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // KELOLA
    Route::get('/kelola', [AdminController::class, 'kelola'])->name('admin.kelola');

    // DETAIL
    Route::get('/permohonan/{id}', [AdminController::class, 'detail'])->name('admin.detail');

    // AKSI
    Route::get('/setujui/{id}', [AdminController::class, 'setujui'])->name('admin.setujui');
    Route::get('/tolak/{id}', [AdminController::class, 'tolak'])->name('admin.tolak');
    Route::get('/selesai/{id}', [AdminController::class, 'selesai'])->name('admin.selesai');
    Route::get('/notif/{id}', [AdminController::class, 'kirimNotifikasi'])->name('admin.notif');

    // LAPORAN
    Route::get('/laporan', [AdminController::class, 'laporan'])->name('admin.laporan');
    Route::get('/laporan/pdf', [AdminController::class, 'laporanPdf'])->name('admin.laporan.pdf');
    Route::get('/laporan/excel', [AdminController::class, 'laporanExcel'])->name('admin.laporan.excel');

    // HAPUS PERMOHONAN
    Route::get('/hapus/{id}', [AdminController::class, 'hapus'])->name('admin.hapus');

    // JADWAL
    Route::get('/jadwal', [AdminController::class, 'jadwal'])->name('admin.jadwal');

    // BALAS PESAN
    Route::post('/balas/{id}', [AdminController::class, 'balasPesan'])->name('admin.balas');
    
    // ✅ FIX 2: Ubah LaporanController menjadi AdminController 
    // Agar fungsi hapus pesan dikelola di satu tempat yang sama
    Route::delete('/kontak/{id}', [AdminController::class, 'destroyKontak'])->name('admin.kontak.destroy');

    Route::get('/update-jadwal/{id}', [AdminController::class, 'updateJadwal']);
});
