<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemohon extends Model
{
    use HasFactory;

    protected $table = 'pemohons';

    protected $primaryKey = 'nomor_permohonan';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nomor_permohonan',
        'nama_pemohon',
        'arsip_dimohon',
        'status',
        'tanggal_kunjungan'
    ];
}