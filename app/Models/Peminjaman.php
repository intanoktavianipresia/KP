<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'email',
        'keperluan',
        'tanggal',
        'status',        
        'bukti',
        
    ];

    public function riwayatStatus()
    {
        return $this->hasMany(\App\Models\RiwayatStatus::class, 'peminjaman_id');
    }

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