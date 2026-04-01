<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatStatus extends Model
{
    use HasFactory;

    // Kolom yang boleh diisi mass-assignment
    protected $fillable = [
        'peminjaman_id',
        'status',
        'catatan',
        'admin_id'
    ];

    // Relasi: RiwayatStatus milik satu Peminjaman
    public function peminjaman()
    {
        return $this->belongsTo(\App\Models\Peminjaman::class, 'peminjaman_id');
    }

    // Relasi: RiwayatStatus dibuat oleh satu Admin (User)
    public function admin()
    {
        return $this->belongsTo(\App\Models\User::class, 'admin_id');
    }
}