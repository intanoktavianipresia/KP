<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaporanExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return DB::table('pemohons')
            ->select('nama_pemohon','arsip_dimohon','status','created_at')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Arsip Yang Dimohon',
            'Status',
            'Tanggal Permohonan'
        ];
    }
}