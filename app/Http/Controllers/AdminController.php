<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanExport;

class AdminController extends Controller
{

    /*
    |------------------------------------------------------------------
    | DASHBOARD
    |------------------------------------------------------------------
    */
    public function dashboard()
    {
        $menunggu = DB::table('pemohons')->where('status', 'menunggu')->count();
        $disetujui = DB::table('pemohons')->where('status', 'disetujui')->count();
        $ditolak = DB::table('pemohons')->where('status', 'ditolak')->count();

        $jadwal = DB::table('pemohons')
            ->whereNotNull('tanggal_kunjungan')
            ->count();

        $grafik = DB::table('pemohons')
            ->selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $bulan = [];
        $total = [];

        foreach ($grafik as $g) {
            $bulan[] = 'Bulan ' . $g->bulan;
            $total[] = $g->total;
        }

        return view('admin.dashboard', compact(
            'menunggu','disetujui','ditolak','jadwal','bulan','total'
        ));
    }


    /*
    |------------------------------------------------------------------
    | KELOLA PERMOHONAN
    |------------------------------------------------------------------
    */
    public function kelola(Request $request)
    {
        $query = DB::table('pemohons');

        if ($request->filled('nomor_permohonan')) {
            $query->where('nomor_permohonan', 'like', '%' . $request->nomor_permohonan . '%');
        }

        if ($request->filled('nama_pemohon')) {
            $query->where('nama_pemohon', 'like', '%' . $request->nama_pemohon . '%');
        }

        if ($request->filled('status') && $request->status != 'semua') {
            $query->where('status', $request->status);
        }

        if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
            $query->whereBetween('created_at', [
                $request->tanggal_awal,
                $request->tanggal_akhir
            ]);
        }

        $data = $query->orderBy('created_at', 'desc')
            ->paginate(5)
            ->withQueryString();

        $riwayat = DB::table('pemohons')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('admin.kelola', compact('data','riwayat'));
    }


    /*
    |------------------------------------------------------------------
    | DETAIL PERMOHONAN
    |------------------------------------------------------------------
    */
    public function detail($id)
    {
        $data = DB::table('pemohons')
            ->where('nomor_permohonan', $id)
            ->first();

        if (!$data) {
            return redirect()->route('admin.kelola')
                ->with('error', 'Data permohonan tidak ditemukan.');
        }

        return view('admin.detail', compact('data'));
    }


    /*
    |------------------------------------------------------------------
    | SETUJUI PERMOHONAN
    |------------------------------------------------------------------
    */
    public function setujui($id)
    {

        $cek = DB::table('pemohons')
            ->where('nomor_permohonan', $id)
            ->first();

        if (!$cek) {
            return redirect()->route('admin.kelola')
                ->with('error','Data tidak ditemukan.');
        }

        DB::table('pemohons')
            ->where('nomor_permohonan', $id)
            ->update([
                'status' => 'disetujui',
                'updated_at' => now()
            ]);

        return redirect()->route('admin.kelola')
            ->with('success', 'Permohonan disetujui.');
    }


    /*
    |------------------------------------------------------------------
    | TOLAK PERMOHONAN
    |------------------------------------------------------------------
    */
    public function tolak($id)
    {

        $cek = DB::table('pemohons')
            ->where('nomor_permohonan', $id)
            ->first();

        if (!$cek) {
            return redirect()->route('admin.kelola')
                ->with('error','Data tidak ditemukan.');
        }

        DB::table('pemohons')
            ->where('nomor_permohonan', $id)
            ->update([
                'status' => 'ditolak',
                'updated_at' => now()
            ]);

        return redirect()->route('admin.kelola')
            ->with('success', 'Permohonan ditolak.');
    }


    /*
    |------------------------------------------------------------------
    | LAPORAN
    |------------------------------------------------------------------
    */
    public function laporan()
    {
        $data = DB::table('pemohons')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.laporan', compact('data'));
    }


    public function laporanPdf()
    {
        $data = DB::table('pemohons')
            ->orderBy('created_at', 'desc')
            ->get();

        $pdf = Pdf::loadView('admin.laporan_pdf', compact('data'));

        return $pdf->download('laporan-permohonan.pdf');
    }


    public function laporanExcel()
    {
        return Excel::download(new LaporanExport, 'laporan-permohonan.xlsx');
    }
}