<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PemohonController extends Controller
{

    public function beranda()
    {
        $total = DB::table('pemohons')->count();
        $menunggu = DB::table('pemohons')->where('status', 'menunggu')->count();
        $disetujui = DB::table('pemohons')->where('status', 'disetujui')->count();
        $ditolak = DB::table('pemohons')->where('status', 'ditolak')->count();

        return view('pemohon.beranda', compact('total','menunggu','disetujui','ditolak'));
    }

    public function informasi()
    {
        return view('pemohon.informasi');
    }

    public function peminjaman()
    {
        return view('pemohon.peminjaman');
    }

    public function simpanPeminjaman(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'telepon' => 'required',
            'email' => 'required|email',
            'arsip' => 'required',
            'tujuan' => 'required',
            'tanggal_kunjungan' => 'required'
        ]);

        DB::beginTransaction();

        try {

            $year = date('Y');
            $month = date('m');

            $last = DB::table('pemohons')
                ->whereYear('created_at', $year)
                ->orderBy('created_at', 'desc')
                ->first();

            $noUrut = 1;

            if ($last && $last->nomor_permohonan) {
                if (preg_match('/PNM-JK-(\d+)/', $last->nomor_permohonan, $match)) {
                    $noUrut = (int)$match[1] + 1;
                }
            }

            $noFormatted = str_pad($noUrut, 3, '0', STR_PAD_LEFT);
            $nomor = "PNM-JK-$noFormatted/$month/$year";

            $id = DB::table('pemohons')->insertGetId([
                'nomor_permohonan' => $nomor,
                'nama_pemohon' => $request->nama,
                'alamat' => $request->alamat,
                'jenis_kelamin' => $request->jenis_kelamin,
                'telepon' => $request->telepon,
                'email' => $request->email,
                'arsip_dimohon' => $request->arsip,
                'tujuan' => $request->tujuan,
                'tanggal_kunjungan' => $request->tanggal_kunjungan,
                'status' => 'menunggu',
                'created_at' => now(),
                'updated_at' => now()
            ]);

            if (!$id) {
                throw new \Exception('ID gagal dibuat!');
            }

            DB::commit();

            DB::table('riwayat_status')->insert([
                'peminjaman_id' => $id,
                'status' => 'menunggu',
                'catatan' => 'Permohonan diajukan oleh pemohon',
                'admin_id' => null,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            return redirect('/pemohon/peminjaman')
    ->with('success', true)
    ->with('nomor_permohonan', $nomor);

        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }
    }

    public function status()
    {
        return view('pemohon.status');
    }

    public function cekStatus(Request $request)
    {
        $request->validate([
            'nomor' => 'required'
        ]);

        $data = DB::table('pemohons')
                    ->where('nomor_permohonan', $request->nomor)
                    ->first();

        if (!$data) {
            return back()->with('warning','Data tidak ditemukan');
        }

        $riwayat = DB::table('riwayat_status')
            ->where('peminjaman_id', $data->id)
            ->orderBy('created_at','asc')
            ->get();

        return view('pemohon.status', compact('data','riwayat'));
    }

    public function riwayat($id)
    {
        $riwayat = DB::table('riwayat_status')
                    ->where('peminjaman_id', $id)
                    ->orderBy('created_at', 'asc')
                    ->get();

        return view('pemohon.riwayat', compact('riwayat'));
    }

    public function kontak()
    {
        return view('pemohon.kontak');
    }

    // ================================
    // 🔥 KIRIM PESAN KONTAK (FINAL FIX)
    // ================================
    public function kirimKontak(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'pesan' => 'required'
        ]);

        DB::table('kontaks')->insert([
            'nama' => $request->nama,
            'email' => $request->email,
            'pesan' => $request->pesan,
            'created_at' => now()
        ]);

        return back()->with('success', 'Pesan berhasil dikirim');
    }
    public function destroyKontak($id)
{
    $pesan = Kontak::findOrFail($id);
    $pesan::delete();

    return back()->with('success', 'Pesan berhasil dihapus.');
}
}