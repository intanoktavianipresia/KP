<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PemohonController extends Controller
{

    // HALAMAN BERANDA
    public function beranda()
    {
        $total = DB::table('pemohons')->count();

        $menunggu = DB::table('pemohons')
                        ->where('status', 'menunggu')
                        ->count();

        $disetujui = DB::table('pemohons')
                        ->where('status', 'disetujui')
                        ->count();

        $ditolak = DB::table('pemohons')
                        ->where('status', 'ditolak')
                        ->count();

        return view('pemohon.beranda', compact(
            'total',
            'menunggu',
            'disetujui',
            'ditolak'
        ));
    }


    // HALAMAN INFORMASI
    public function informasi()
    {
        return view('pemohon.informasi');
    }


    // HALAMAN FORM PEMINJAMAN
    public function peminjaman()
    {
        return view('pemohon.peminjaman');
    }


    // SIMPAN PERMOHONAN
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

        DB::table('pemohons')->insert([

            'nomor_permohonan' => 'PRM-' . time(),

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

        return redirect('/pemohon/peminjaman')
                ->with('success','Permohonan berhasil dikirim');
    }


    // HALAMAN STATUS
    public function status()
    {
        return view('pemohon.status');
    }


    // CEK STATUS BERDASARKAN NOMOR PERMOHONAN
    public function cekStatus(Request $request)
    {

        $data = DB::table('pemohons')
                    ->where('nomor_permohonan', $request->nomor_permohonan)
                    ->first();

        if(!$data){
            return back()->with('error','Nomor permohonan tidak ditemukan');
        }

        return view('pemohon.status', compact('data'));
    }


    // HALAMAN KONTAK
    public function kontak()
    {
        return view('pemohon.kontak');
    }

}