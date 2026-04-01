<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanExport;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{

    // =========================
    // DASHBOARD
    // =========================
    public function dashboard()
    {
        $menunggu  = DB::table('pemohons')->where('status', 'menunggu')->count();
        $disetujui = DB::table('pemohons')->where('status', 'disetujui')->count();
        $ditolak   = DB::table('pemohons')->where('status', 'ditolak')->count();
        $selesai   = DB::table('pemohons')->where('status', 'selesai')->count();

        $jadwal = DB::table('pemohons')
            ->whereNotNull('tanggal_kunjungan')
            ->count();

        $grafik = DB::table('pemohons')
            ->selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();
        
        $menunggu = DB::table('pemohons')
    ->where('status','menunggu')
    ->count();

        $bulan = [];
        $total = [];

        foreach ($grafik as $g) {
            $bulan[] = 'Bulan ' . $g->bulan;
            $total[] = $g->total;
        }

        return view('admin.dashboard', compact(
            'menunggu','disetujui','ditolak','selesai','jadwal','bulan','total'
        ));
    }

    // =========================
    // KELOLA
    // =========================
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

        // ✅ FIX BUG DI SINI
        if(request('jadwal') == 1){
            $query->where('status', 'disetujui')
                  ->whereNotNull('tanggal_kunjungan');
        }

        $data = $query->orderBy('created_at', 'desc')
            ->paginate(5)
            ->withQueryString();

        $riwayat = DB::table('riwayat_status')
            ->join('pemohons', 'riwayat_status.peminjaman_id', '=', 'pemohons.id')
            ->select(
                'riwayat_status.*',
                'pemohons.nama_pemohon',
                'pemohons.nomor_permohonan'
            )
            ->orderBy('riwayat_status.created_at', 'desc')
            ->get();

        return view('admin.kelola', compact('data','riwayat'));
    }

    // =========================
    // DETAIL
    // =========================
    public function detail($id)
    {
        $data = DB::table('pemohons')->where('id', $id)->first();

        if (!$data) {
            return redirect()->route('admin.kelola')
                ->with('error', 'Data tidak ditemukan.');
        }

        $riwayat = DB::table('riwayat_status')
            ->where('peminjaman_id', $data->id)
            ->orderBy('created_at','asc')
            ->get();

        return view('admin.detail', compact('data','riwayat'));
    }

    // =========================
    // SETUJUI
    // =========================
    public function setujui($id)
    {
        $data = DB::table('pemohons')->where('id', $id)->first();

        if (!$data) {
            return back()->with('error','Data tidak ditemukan');
        }

        DB::table('pemohons')->where('id', $id)->update([
            'status' => 'disetujui',
            'updated_at' => now()
        ]);

        DB::table('riwayat_status')->insert([
            'peminjaman_id' => $data->id,
            'status' => 'disetujui',
            'catatan' => 'Disetujui oleh admin',
            'admin_id' => auth()->id(),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // EMAIL
        try {
            Mail::send('email.disetujui', ['data'=>$data], function($msg) use ($data){
                $msg->to($data->email)
                    ->subject('Pemberitahuan Persetujuan Permohonan Arsip');
            });
        } catch (\Exception $e) {}

        // WA
        $this->kirimWA($data->telepon, "Permohonan Anda DISETUJUI. Nomor: {$data->nomor_permohonan}");

        return redirect()->route('admin.kelola')
            ->with('success','Disetujui');
    }

    // =========================
    // TOLAK
    // =========================
    public function tolak($id)
    {
        $data = DB::table('pemohons')->where('id', $id)->first();

        if (!$data) {
            return back()->with('error','Data tidak ditemukan');
        }

        DB::table('pemohons')->where('id', $id)->update([
            'status' => 'ditolak',
            'updated_at' => now()
        ]);

        DB::table('riwayat_status')->insert([
            'peminjaman_id' => $data->id,
            'status' => 'ditolak',
            'catatan' => 'Ditolak oleh admin',
            'admin_id' => auth()->id(),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        try {
            Mail::send('email.ditolak', ['data'=>$data], function($msg) use ($data){
                $msg->to($data->email)
                    ->subject('Pemberitahuan Penolakan');
            });
        } catch (\Exception $e) {}

        $this->kirimWA($data->telepon, "Permohonan Anda DITOLAK.");

        return redirect()->route('admin.kelola')
            ->with('success','Ditolak');
    }

    // =========================
    // 🔥 BALAS PESAN (AUTO EMAIL)
    // =========================
    public function balasPesan(Request $request, $id)
    {
        $request->validate([
            'balasan' => 'required'
        ]);

        $data = DB::table('kontaks')->where('id', $id)->first();

        if (!$data) {
            return back()->with('error','Pesan tidak ditemukan');
        }

        // EMAIL AUTO
        Mail::raw($request->balasan, function($msg) use ($data){
            $msg->to($data->email)
                ->subject('Balasan dari Admin Arsip');
        });

        // SIMPAN BALASAN
        DB::table('kontaks')->where('id',$id)->update([
            'balasan' => $request->balasan
        ]);

        return back()->with('success','Balasan berhasil dikirim');
    }

    // =========================
    // WA FUNCTION
    // =========================
    private function kirimWA($nomor, $pesan)
    {
        $token = env('FONNTE_TOKEN');
        $nomor = preg_replace('/^0/', '62', $nomor);

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => [
                'target' => $nomor,
                'message' => $pesan,
            ],
            CURLOPT_HTTPHEADER => ["Authorization: $token"],
        ]);

        curl_exec($curl);
        curl_close($curl);
    }

    // =========================
    // LAPORAN
    // =========================
    public function laporan()
    {
        $data = DB::table('pemohons')->orderBy('created_at','desc')->paginate(10);
        $kontak = DB::table('kontaks')->orderBy('created_at','desc')->get();

        return view('admin.laporan', compact('data','kontak'));
    }

    public function laporanPdf(Request $request)
    {
        $query = DB::table('pemohons');

        if ($request->status && $request->status != 'semua') {
            $query->where('status', $request->status);
        }

        if ($request->tanggal_awal && $request->tanggal_akhir) {
            $query->whereBetween('created_at', [
                $request->tanggal_awal,
                $request->tanggal_akhir
            ]);
        }

        $data = $query->orderBy('created_at', 'desc')->get();
        $tanggal = now()->format('d F Y');

        return Pdf::loadView('admin.laporan_pdf', compact('data','tanggal'))
            ->stream('laporan.pdf');
    }

    public function laporanExcel()
    {
        return Excel::download(new LaporanExport, 'laporan.xlsx');
    }

    public function hapus($id)
    {
        DB::table('pemohons')->where('id', $id)->delete();
        return back()->with('success', 'Data berhasil dihapus');
    }

    public function jadwal(Request $request)
    {
        $query = DB::table('pemohons')
            ->where('status', 'disetujui')
            ->whereNotNull('tanggal_kunjungan');

        if($request->filter == 'hari_ini'){
            $query->whereDate('tanggal_kunjungan', now());
        }

        if($request->filter == 'minggu_ini'){
            $query->whereBetween('tanggal_kunjungan', [
                now()->startOfWeek(),
                now()->endOfWeek()
            ]);
        }

        $data = $query->orderBy('tanggal_kunjungan', 'asc')
            ->paginate(10)
            ->withQueryString();

        return view('admin.jadwal', compact('data'));
    }

}