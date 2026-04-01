<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    // ⚠️ KOLOM YANG BOLEH DIISI (Sesuaikan dengan tabel Anda)
    protected $fillable = [
        'nama',
        'email',
        'keperluan',
        'tanggal',
        'status',        // ← WAJIB ADA untuk fitur status
        'bukti',
        // Jika ada kolom lain di tabel Anda, tambahkan di sini
    ];

    /**
     * ✅ RELASI: Satu peminjaman punya banyak riwayat status
     */
    public function riwayatStatus()
    {
        return $this->hasMany(\App\Models\RiwayatStatus::class, 'peminjaman_id');
    }

    /**
     * ✅ HELPER: Update status + otomatis catat ke riwayat
     */
    public function updateStatusBaru($statusBaru, $catatan = null, $adminId = null)
    {
        // 1. Update status di tabel peminjamans
        $this->status = $statusBaru;
        $this->save();

        // 2. Catat ke tabel riwayat_status
        $this->riwayatStatus()->create([
            'status' => $statusBaru,
            'catatan' => $catatan,
            'admin_id' => $adminId
        ]);
    }
}