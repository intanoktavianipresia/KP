<!DOCTYPE html>
@php
    $notifPermohonan = \DB::table('pemohons')->where('status','menunggu')->count();
    $notifPesan = \DB::table('kontaks')->whereNull('balasan')->count();
@endphp
<html lang="id">
<head>
    <title>Admin Panel - DPK Provinsi Bengkulu</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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

        /* --- Loading Screen --- */
        #loading {
            position: fixed;
            inset: 0;
            background: white;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .spinner {
            width: 45px;
            height: 45px;
            border: 3px solid #e2e8f0;
            border-top: 3px solid var(--pine-green);
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin { 100% { transform: rotate(360deg); } }

        /* --- Top Header --- */
        .top-header {
            background: linear-gradient(135deg, var(--pine-green), var(--pine-dark));
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 25px;
            height: 70px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 1001;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .logo { width: 40px; height: auto; filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1)); }
        .instansi { font-family: 'Plus Jakarta Sans'; font-weight: 800; font-size: 14px; line-height: 1.1; letter-spacing: -0.2px; }
        .provinsi { font-size: 11px; opacity: 0.85; letter-spacing: 1.5px; margin-top: 2px; text-transform: uppercase; }

        /* --- Layout Structure --- */
        .layout { display: flex; min-height: calc(100vh - 70px); }

        /* --- Sidebar Modern --- */
        .sidebar {
            width: 270px;
            background: var(--slate-950);
            padding: 20px 15px;
            display: flex;
            flex-direction: column;
            transition: var(--transition);
            z-index: 1000;
        }

        .sidebar.collapsed { width: 88px; }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 14px;
            color: #94a3b8;
            text-decoration: none;
            padding: 12px 16px;
            border-radius: 12px;
            margin-bottom: 6px;
            transition: var(--transition);
            white-space: nowrap;
            font-weight: 500;
            font-size: 14.5px;
        }

        .sidebar a i { width: 22px; text-align: center; font-size: 18px; }

        .sidebar a:hover {
            background: rgba(255,255,255,0.05);
            color: white;
            transform: translateX(4px);
        }

        .sidebar a.active {
            background: var(--pine-green);
            color: white;
            box-shadow: 0 10px 15px -3px rgba(15, 93, 63, 0.25);
        }

        .badge-notif {
            font-size: 10px;
            padding: 3px 7px;
            border-radius: 8px;
            font-weight: 800;
        }

        .sidebar.collapsed a span { display: none; }
        .sidebar.collapsed a { justify-content: center; padding: 15px; }
        .sidebar.collapsed .logout-text { display: none; }

        /* --- Content Area --- */
        .content {
            flex: 1;
            padding: 35px;
            background: #f8fafc;
            animation: fadeIn 0.4s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* --- UI Feedback Elements --- */
        #successAnim {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 40px;
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25);
            display: none;
            z-index: 10000;
            text-align: center;
            min-width: 220px;
        }

        #toastBox { position: fixed; top: 85px; right: 25px; z-index: 9999; }
        .custom-toast {
            background: white;
            color: var(--slate-900);
            padding: 16px 24px;
            border-radius: 16px;
            margin-bottom: 12px;
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
            border-left: 6px solid var(--pine-green);
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 12px;
            animation: slideIn 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        @keyframes slideIn { from { transform: translateX(100%); opacity: 0; } to { transform: translateX(0); opacity: 1; } }

        /* --- Modal Styling --- */
        .modal-content { border-radius: 24px; border: none; }
        .btn-confirm-logout {
            background: #e11d48;
            border: none;
            padding: 10px 24px;
            border-radius: 12px;
            font-weight: 700;
            transition: 0.2s;
        }
        .btn-confirm-logout:hover { background: #be123c; transform: translateY(-2px); }
    </style>
</head>
<body>

<div id="loading">
    <div class="spinner"></div>
</div>

<div id="successAnim">
    <div style="font-size:60px; color:#22c55e;"><i class="fa-solid fa-circle-check"></i></div>
    <div style="margin-top:15px; font-weight:800; font-family:'Plus Jakarta Sans'; font-size: 18px; color: var(--slate-900);">BERHASIL</div>
</div>

<div class="top-header">
    <div class="header-left">
        <button onclick="toggleSidebar()" class="btn btn-link text-white p-0 me-3 shadow-none" style="font-size: 20px; transition: 0.3s;">
            <i class="fa-solid fa-bars-staggered"></i>
        </button>
        <img src="{{ asset('images/logo.png') }}" class="logo" alt="Logo">
        <div>
            <div class="instansi">DINAS PERPUSTAKAAN DAN KEARSIPAN</div>
            <div class="provinsi">PROVINSI BENGKULU</div>
        </div>
    </div>
    <div class="d-flex align-items-center">
        <div class="badge bg-white bg-opacity-10 text-white p-2 px-3 d-flex align-items-center gap-2" style="border-radius: 10px; border: 1px solid rgba(255,255,255,0.2);">
            <i class="fa-solid fa-user-shield text-warning"></i>
            <span class="small fw-bold">Administrator</span>
        </div>
    </div>
</div>

<div class="layout">
    <div class="sidebar">
        <div class="flex-grow-1">
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard')?'active':'' }}">
                <i class="fa-solid fa-chart-line"></i><span>Dashboard</span>
            </a>
            
            <a href="{{ route('admin.kelola') }}" class="position-relative {{ request()->routeIs('admin.kelola')?'active':'' }}">
                <i class="fa-solid fa-box-archive"></i>
                <span>Kelola Arsip</span>
                @if($notifPermohonan > 0)
                    <span class="badge bg-danger badge-notif position-absolute" style="top: 12px; right: 15px;">{{ $notifPermohonan }}</span>
                @endif
            </a>

            <a href="{{ route('admin.jadwal') }}" class="{{ request()->routeIs('admin.jadwal')?'active':'' }}">
                <i class="fa-solid fa-calendar-check"></i><span>Jadwal Peminjaman</span>
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

    <div class="content">
        @yield('content')
    </div>
</div>

<div id="toastBox"></div>

<div class="modal fade" id="logoutModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg">
            <div class="modal-body p-5 text-center">
                <div class="mb-4">
                    <i class="fa-solid fa-triangle-exclamation text-warning" style="font-size: 64px;"></i>
                </div>
                <h4 class="fw-800 mb-2" style="font-family: 'Plus Jakarta Sans';">Konfirmasi Keluar</h4>
                <p class="text-muted mb-4">Apakah Anda yakin ingin mengakhiri sesi administrator ini dan keluar dari sistem?</p>
                <div class="d-grid gap-2 d-sm-flex justify-content-center">
                    <button type="button" class="btn btn-light px-4 py-2 fw-bold" data-bs-dismiss="modal" style="border-radius: 12px;">Batal</button>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-confirm-logout text-white px-4 py-2 fw-bold">Ya, Keluar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Sidebar Toggle
    function toggleSidebar() {
        const sidebar = document.querySelector('.sidebar');
        sidebar.classList.toggle('collapsed');
    }

    // Loader & Flash Notifications
    window.onload = function() {
        setTimeout(() => {
            document.getElementById("loading").style.fadeOut = "slow";
            document.getElementById("loading").style.display = "none";
        }, 300);

        @if(session('success'))
            showToast("{{ session('success') }}");
        @endif

        @if(session('notif_email'))
            showToast("📩 Email Berhasil Dikirim");
        @endif
    }

    // Modern Toast & Success Feedback
    function showToast(msg) {
        showSuccess();
        const t = document.createElement("div");
        t.className = "custom-toast";
        t.innerHTML = `<i class="fa-solid fa-check-circle text-success" style="font-size: 20px;"></i> ${msg}`;
        document.getElementById("toastBox").appendChild(t);
        
        setTimeout(() => { 
            t.style.opacity = '0'; 
            t.style.transform = 'translateX(20px)';
            setTimeout(() => t.remove(), 400); 
        }, 4000);
    }

    function showSuccess() {
        const el = document.getElementById("successAnim");
        el.style.display = "block";
        setTimeout(() => el.style.display = "none", 1200);
    }
</script>

</body>
</html>