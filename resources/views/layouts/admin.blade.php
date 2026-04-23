<!DOCTYPE html>
@php
    $notifPermohonan = \DB::table('pemohons')->where('status','menunggu')->count();
    $notifPesan = \DB::table('kontaks')->whereNull('balasan')->count();
    $notifJadwalHariIni = \DB::table('pemohons')
    ->whereDate('tanggal_kunjungan', now()->toDateString())
    ->where('status', 'disetujui')
    ->count();
@endphp
<html lang="id">
<head>
    <title>Admin Panel - DPK Provinsi Bengkulu</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@600;700;800&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        :root {
            --pine-green: #0f5d3f;
            --pine-dark: #0b4a32;
            --slate-950: #020617;
            --slate-900: #0f172a;
            --slate-800: #1e293b;
            --slate-100: #f1f5f9;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background: #f8fafc;
            color: var(--slate-900);
            overflow-x: hidden;
        }

        /* --- ANIMATIONS --- */
        .badge-pulse { animation: pulse 1.2s infinite; }
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.15); box-shadow: 0 0 10px rgba(34, 197, 94, 0.5); }
            100% { transform: scale(1); }
        }

        #loading {
            position: fixed; inset: 0; background: white;
            display: flex; justify-content: center; align-items: center; z-index: 9999;
        }

        .spinner {
            width: 45px; height: 45px; border: 3px solid #e2e8f0;
            border-top: 3px solid var(--pine-green); border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }
        @keyframes spin { 100% { transform: rotate(360deg); } }

        /* --- HEADER & NAVBAR (INI YANG DIPERBAIKI) --- */
        .top-header {
            background: linear-gradient(135deg, var(--pine-green), var(--pine-dark));
            color: white; display: flex; justify-content: space-between; align-items: center;
            padding: 0 20px; height: 70px; position: sticky; top: 0; z-index: 1050;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .header-left { display: flex; align-items: center; gap: 12px; }
        .logo { width: 35px; height: auto; filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1)); }
        
        /* Teks Instansi agar tidak hilang di HP */
        .instansi { font-family: 'Plus Jakarta Sans'; font-weight: 800; font-size: 13px; line-height: 1.1; }
        .provinsi { font-size: 10px; opacity: 0.85; letter-spacing: 1px; text-transform: uppercase; }

        @media (max-width: 576px) {
            .instansi { font-size: 11px; }
            .provinsi { display: none; } /* Sembunyikan provinsi di HP sangat kecil agar tidak penuh */
        }

        /* --- SIDEBAR & LAYOUT --- */
        .layout { display: flex; min-height: calc(100vh - 70px); position: relative; }

        .sidebar {
            width: 270px; background: var(--slate-950); padding: 20px 15px;
            display: flex; flex-direction: column; transition: var(--transition); z-index: 1040;
        }

        .sidebar a {
            display: flex; align-items: center; gap: 14px; color: #94a3b8;
            text-decoration: none; padding: 12px 16px; border-radius: 12px;
            margin-bottom: 6px; transition: var(--transition); white-space: nowrap;
            font-weight: 500; font-size: 14.5px;
        }

        .sidebar a i { width: 22px; text-align: center; font-size: 18px; }
        .sidebar a:hover { background: rgba(255,255,255,0.05); color: white; transform: translateX(4px); }
        .sidebar a.active { background: var(--pine-green); color: white; box-shadow: 0 10px 15px -3px rgba(15, 93, 63, 0.25); }

        /* Responsif Sidebar */
        @media (max-width: 992px) {
            .sidebar { position: fixed; left: -270px; height: calc(100vh - 70px); top: 70px; width: 270px; }
            .sidebar.active { left: 0; }
            .sidebar-overlay {
                display: none; position: fixed; inset: 70px 0 0 0;
                background: rgba(0,0,0,0.5); backdrop-filter: blur(2px); z-index: 1030;
            }
            .sidebar.active + .sidebar-overlay { display: block; }
        }

        @media (min-width: 993px) {
            .sidebar.collapsed { width: 88px; }
            .sidebar.collapsed span, .sidebar.collapsed .badge-notif, .sidebar.collapsed .logout-text { display: none; }
            .sidebar.collapsed a { justify-content: center; padding: 15px; }
        }

        /* --- CONTENT --- */
        .content { flex: 1; padding: 35px; background: #f8fafc; min-width: 0; transition: var(--transition); }
        @media (max-width: 768px) { .content { padding: 20px 15px; } }

        /* --- NOTIF UI --- */
        #successAnim {
            position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%);
            background: white; padding: 40px; border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25); display: none; z-index: 10000; text-align: center;
        }

        #toastBox { position: fixed; top: 85px; right: 25px; z-index: 9999; }
        .custom-toast {
            background: white; padding: 16px 24px; border-radius: 16px; margin-bottom: 12px;
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); border-left: 6px solid var(--pine-green);
            display: flex; align-items: center; gap: 12px; animation: slideIn 0.3s ease-out;
        }
        @keyframes slideIn { from { transform: translateX(100%); opacity: 0; } to { transform: translateX(0); opacity: 1; } }
    </style>
</head>
<body>

<div id="loading"><div class="spinner"></div></div>

<div id="successAnim">
    <div style="font-size:60px; color:#22c55e;"><i class="fa-solid fa-circle-check"></i></div>
    <div style="margin-top:15px; font-weight:800; font-size: 18px;">BERHASIL</div>
</div>

<div class="top-header">
    <div class="header-left">
        <button onclick="toggleSidebar()" class="btn btn-link text-white p-0 me-2 shadow-none border-0" style="font-size: 22px;">
            <i class="fa-solid fa-bars-staggered"></i>
        </button>
        <img src="{{ asset('images/logo.png') }}" class="logo" alt="Logo">
        <div>
            <div class="instansi">DINAS PERPUSTAKAAN DAN KEARSIPAN</div>
            <div class="provinsi">PROVINSI BENGKULU</div>
        </div>
    </div>
    <div class="badge bg-white bg-opacity-10 text-white p-2 px-3 d-flex align-items-center gap-2" style="border-radius: 10px; border: 1px solid rgba(255,255,255,0.2);">
        <i class="fa-solid fa-user-shield text-warning"></i>
        <span class="small fw-bold d-none d-md-inline">Administrator</span>
    </div>
</div>

<div class="layout">
    <div class="sidebar" id="sidebar">
        <div class="flex-grow-1">
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard')?'active':'' }}">
                <i class="fa-solid fa-chart-line"></i><span>Dashboard</span>
            </a>
            
            <a href="{{ route('admin.kelola') }}" class="position-relative {{ request()->routeIs('admin.kelola')?'active':'' }}">
                <i class="fa-solid fa-box-archive"></i>
                <span>Kelola Arsip</span>
                @if($notifPermohonan > 0)
                    <span class="badge bg-success badge-notif badge-pulse position-absolute" style="top: 12px; right: 15px;">{{ $notifPermohonan }}</span>
                @endif
            </a>

            <a href="{{ route('admin.jadwal') }}" class="position-relative {{ request()->routeIs('admin.jadwal')?'active':'' }}">
                <i class="fa-solid fa-calendar-check"></i>
                <span>Jadwal Peminjaman</span>
                @if($notifJadwalHariIni > 0)
                    <span class="badge bg-danger badge-notif position-absolute" style="top: 12px; right: 15px;">{{ $notifJadwalHariIni }}</span>
                @endif
            </a>

            <a href="{{ route('admin.laporan') }}" class="position-relative {{ request()->routeIs('admin.laporan')?'active':'' }}">
                <i class="fa-solid fa-file-lines"></i>
                <span>Laporan & Pesan</span>
                @if($notifPesan > 0)
                    <span class="badge bg-warning text-dark badge-notif position-absolute" style="top: 12px; right: 15px;">{{ $notifPesan }}</span>
                @endif
            </a>
        </div>

        <button type="button" class="btn btn-outline-danger border-0 w-100 py-3 text-start d-flex align-items-center gap-3 shadow-none mt-auto" 
                data-bs-toggle="modal" data-bs-target="#logoutModal" style="border-radius: 12px; color: #fb7185;">
            <i class="fa-solid fa-right-from-bracket ms-1"></i>
            <span class="logout-text fw-bold">Logout</span>
        </button>
    </div>

    <div class="sidebar-overlay" onclick="toggleSidebar()"></div>

    <div class="content">
        @yield('content')
    </div>
</div>

<div class="modal fade" id="logoutModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg" style="border-radius: 24px;">
            <div class="modal-body p-5 text-center">
                <i class="fa-solid fa-triangle-exclamation text-warning mb-4" style="font-size: 64px;"></i>
                <h4 class="fw-800 mb-2">Konfirmasi Keluar</h4>
                <p class="text-muted mb-4">Apakah Anda yakin ingin mengakhiri sesi administrator ini?</p>
                <div class="d-grid gap-2 d-sm-flex justify-content-center">
                    <button type="button" class="btn btn-light px-4 py-2 fw-bold" data-bs-dismiss="modal" style="border-radius: 12px;">Batal</button>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger px-4 py-2 fw-bold" style="border-radius: 12px;">Ya, Keluar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="toastBox"></div>
<audio id="notifSound" src="https://assets.mixkit.co/active_storage/sfx/2869/2869-preview.mp3" preload="auto"></audio>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        if (window.innerWidth <= 992) {
            sidebar.classList.toggle('active');
        } else {
            sidebar.classList.toggle('collapsed');
        }
    }

    window.onload = function() {
        document.getElementById("loading").style.display = "none";

        let shouldNotify = false;

        @if(session('success'))
            showToast("{{ session('success') }}");
        @endif

        @if(session('notif_email'))
            showToast("📩 Email Berhasil Dikirim");
        @endif

        @if($notifJadwalHariIni > 0)
            showToast("📅 Ada {{ $notifJadwalHariIni }} jadwal kunjungan hari ini!");
            shouldNotify = true;
        @endif

        @if($notifPermohonan > 0)
            showToast("📂 Ada {{ $notifPermohonan }} permohonan baru menunggu!");
            shouldNotify = true;
        @endif

        @if($notifPesan > 0)
            showToast("✉️ Ada {{ $notifPesan }} pesan baru belum dibalas!");
            shouldNotify = true;
        @endif

        if(shouldNotify) {
            playNotifSound();
        }
    }

    function showToast(msg) {
        if(msg.toLowerCase().includes("berhasil") || msg.toLowerCase().includes("sukses")) {
            showSuccess();
        }
        
        const t = document.createElement("div");
        t.className = "custom-toast";
        t.innerHTML = `<i class="fa-solid fa-bell text-success" style="font-size: 20px;"></i> ${msg}`;
        document.getElementById("toastBox").appendChild(t);
        
        setTimeout(() => { 
            t.style.opacity = '0'; 
            t.style.transform = 'translateX(20px)';
            setTimeout(() => t.remove(), 400); 
        }, 6000);
    }

    function showSuccess() {
        const el = document.getElementById("successAnim");
        el.style.display = "block";
        setTimeout(() => el.style.display = "none", 1200);
    }

    function playNotifSound(){
        let sound = document.getElementById("notifSound");
        if(sound){
            sound.volume = 1.0;
            let playPromise = sound.play();
            if (playPromise !== undefined) {
                playPromise.catch(error => {
                    console.log("Audio play diblokir browser.");
                });
            }
        }
    }

    document.body.addEventListener('click', function() {
        let sound = document.getElementById("notifSound");
        sound.load(); 
    }, {once: true});
</script>

</body>
</html>