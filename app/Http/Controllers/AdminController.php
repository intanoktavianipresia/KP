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

    public function dashboard()
    {
        $menunggu  = DB::table('pemohons')->where('status', 'menunggu')->count();
        $disetujui = DB::table('pemohons')->where('status', 'disetujui')->count();
        $ditolak   = DB::table('pemohons')->where('status', 'ditolak')->count();
        $selesai   = DB::table('pemohons')->where('status', 'selesai')->count();

        $jadwal = DB::table('pemohons')
            ->where('status', 'disetujui')
            ->whereNotNull('tanggal_kunjungan')
            ->where('tanggal_kunjungan', '>=', now())
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
            'menunggu','disetujui','ditolak','selesai','jadwal','bulan','total'
        ));
    }

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

    public function setujui($id)
    {
        $data = DB::table('pemohons')->where('id', $id)->first();

        if (!$data) {
            return back()->with('error','Data tidak ditemukan');
        }

        DB::table('pemohons')->where('id', $id)->update([
            'status' => 'disetujui',
            'tanggal_kunjungan' => request('tgl'),
            'waktu_kunjungan' => request('waktu'),
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

        try {
            Mail::send('email.disetujui', ['data'=>$data], function($msg) use ($data){
                $msg->to($data->email)
                    ->subject('Pemberitahuan Persetujuan Permohonan Arsip');
            });
        } catch (\Exception $e) {}

        $pesan = "📢 *PEMBERITAHUAN RESMI*\n\nYth. Bapak/Ibu {$data->nama_pemohon},\n\nPermohonan peminjaman arsip Anda telah *DISETUJUI*.\n\n📄 *Detail Permohonan:*\n• Nomor : {$data->nomor_permohonan}\n• Arsip : {$data->arsip_dimohon}\n• Jadwal Kunjungan : ".date('d-m-Y', strtotime(request('tgl')))." Pukul ".request('waktu')." WIB\n\nTerima kasih.\n\n—\n*Dinas Perpustakaan dan Kearsipan*";

        $this->kirimWA($data->telepon, $pesan);

        return redirect()->back()->with('success', 'Permohonan berhasil disetujui');
    }

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

        $alasan = request('alasan');
        $pesan = "📢 *PEMBERITAHUAN RESMI*\n\nYth. Bapak/Ibu {$data->nama_pemohon},\n\nMohon maaf, permohonan peminjaman arsip Anda *DITOLAK*.\n\n📄 *Detail Permohonan:*\n• Nomor : {$data->nomor_permohonan}\n• Arsip : {$data->arsip_dimohon}\n\n❗ *Alasan Penolakan:*\n{$alasan}\n\nTerima kasih.\n\n—\n*Dinas Perpustakaan dan Kearsipan*";

        $this->kirimWA($data->telepon, $pesan);

        return redirect()->back()->with('success', 'Permohonan berhasil ditolak');
    }

    private function kirimWA($nomor, $pesan)
    {
        $token = env('FONNTE_TOKEN');
        $nomor = preg_replace('/^0/', '62', $nomor);
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => ['target' => $nomor, 'message' => $pesan],
            CURLOPT_HTTPHEADER => ["Authorization: $token"],
        ]);
        curl_exec($curl);
        curl_close($curl);
    }

    public function laporan()
    {
        $data = DB::table('pemohons')->orderBy('created_at','desc')->paginate(10);
        $kontak = DB::table('kontaks')->orderBy('created_at','desc')->get();
        return view('admin.laporan', compact('data','kontak'));
    }

    public function laporanPdf(Request $request)
    {
        $query = DB::table('pemohons');
        if ($request->status && $request->status != 'semua') { $query->where('status', $request->status); }
        if ($request->tanggal_awal && $request->tanggal_akhir) {
            $query->whereBetween('created_at', [$request->tanggal_awal, $request->tanggal_akhir]);
        }
        $data = $query->orderBy('created_at', 'desc')->get();
        $tanggal = now()->format('d F Y');
        return Pdf::loadView('admin.laporan_pdf', compact('data','tanggal'))->stream('laporan.pdf');
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

    public function destroyKontak($id)
    {
        DB::table('kontaks')->where('id', $id)->delete();
        return back()->with('success', 'Pesan berhasil dihapus');
    }

    public function jadwal(Request $request)
    {
        DB::table('pemohons')->where('status', 'disetujui')->whereNotNull('tanggal_kunjungan')
            ->where('tanggal_kunjungan', '<', now())->update(['status' => 'selesai', 'updated_at' => now()]);

        $query = DB::table('pemohons')->where('status', 'disetujui')->whereNotNull('tanggal_kunjungan');
        if($request->filter == 'hari_ini'){ $query->whereDate('tanggal_kunjungan', now()); }
        $data = $query->orderBy('tanggal_kunjungan', 'asc')->paginate(10)->withQueryString();
        return view('admin.jadwal', compact('data'));
    }
    public function balasPesan(Request $request, $id)
{
    $request->validate([
        'balasan' => 'required'
    ]);

    $data = DB::table('kontaks')->where('id', $id)->first();

    if (!$data) {
        return back()->with('error','Pesan tidak ditemukan');
    }

    Mail::send('email.balasan_kontak', [
        'nama' => $data->nama,
        'email' => $data->email,
        'pesan' => $data->pesan,
        'balasan' => $request->balasan,
        'tanggal' => now()->format('d F Y H:i')
    ], function($msg) use ($data){
        $msg->to($data->email)->subject('Tanggapan atas Pesan Anda');
    });

    DB::table('kontaks')->where('id',$id)->update([
        'balasan' => $request->balasan
    ]);

    return back()->with('success','Balasan berhasil dikirim');
    }
    
 public function updateJadwal($id)
{
    $data = DB::table('pemohons')->where('id', $id)->first();

    if (!$data) {
        return back()->with('error','Data tidak ditemukan');
    }

    $tgl = request('tgl');
    $waktu = request('waktu');
    $alasan = request('alasan');

    DB::table('pemohons')->where('id', $id)->update([
        'tanggal_kunjungan' => $tgl,
        'waktu_kunjungan' => $waktu,
        'alasan_perubahan' => $alasan,
        'updated_at' => now()
    ]);

    // riwayat
    DB::table('riwayat_status')->insert([
        'peminjaman_id' => $id,
        'status' => 'reschedule',
        'catatan' => $alasan,
        'admin_id' => auth()->id(),
        'created_at' => now(),
        'updated_at' => now()
    ]);

    // update data untuk email
    $data->tanggal_kunjungan = $tgl;
    $data->waktu_kunjungan = $waktu;
    $data->alasan_perubahan = $alasan;

    // EMAIL
    try {
        Mail::send('email.reschedule', ['data'=>$data], function($msg) use ($data){
    $msg->to($data->email)
        ->subject('Perubahan Jadwal Kunjungan');
});
    } catch (\Exception $e) {}

    // WA
    $pesan = "📢 *PERUBAHAN JADWAL KUNJUNGAN*\n\n"
    ."Yth. Bapak/Ibu *{$data->nama_pemohon}*,\n\n"
    ."Kami informasikan bahwa jadwal kunjungan Anda telah *DIUBAH*.\n\n"

    ."📄 *Detail Permohonan:*\n"
    ."• Nomor : {$data->nomor_permohonan}\n"
    ."• Arsip : {$data->arsip_dimohon}\n\n"

    ."📅 *Jadwal Baru:*\n"
    ."• Tanggal : ".date('d-m-Y', strtotime($tgl))."\n"
    ."• Waktu : $waktu\n\n"

    ."📝 *Alasan Perubahan:*\n"
    ."_{$alasan}_\n\n"

    ."Mohon menyesuaikan dengan jadwal terbaru.\n\n"
    ."Terima kasih.\n\n"
    ."—\n*Dinas Perpustakaan & Kearsipan*";

$this->kirimWA($data->telepon, $pesan);

return back()->with('success','Jadwal berhasil diperbarui');
}
}