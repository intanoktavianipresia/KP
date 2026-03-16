<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            margin:0;
            font-family:'Segoe UI', sans-serif;
            background:#f4f6f9;
        }

        /* HEADER */
        .top-header{
            background:#0f5d3f;
            color:white;
            display:flex;
            justify-content:space-between;
            align-items:center;
            padding:12px 20px;
        }

        .header-left{
            display:flex;
            align-items:center;
            gap:15px;
        }

        .logo{
            width:40px;
        }

        .instansi{
            font-size:16px;
            font-weight:600;
        }

        .provinsi{
            font-size:14px;
            opacity:0.9;
        }

        .admin-box{
            display:flex;
            align-items:center;
            gap:8px;
            font-size:14px;
        }

        /* LAYOUT */
        .layout{
            display:flex;
        }

        .sidebar{
            width:230px;
            background:#0f5d3f;
            min-height:100vh;
            padding:20px;
            display:flex;
            flex-direction:column;
            justify-content:space-between;
        }

        .sidebar a{
            display:block;
            color:white;
            text-decoration:none;
            padding:10px 0;
            font-size:14px;
        }

        .sidebar a:hover{
            background:#0b4a32;
            padding-left:8px;
            transition:0.2s;
        }

        .sidebar a.active{
            background:#0b4a32;
            padding-left:8px;
            font-weight:bold;
        }

        .content{
            flex:1;
            padding:30px;
        }

        /* MODAL */
        .modal-content.premium {
            border-radius:15px;
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(0,0,0,0.1);
            box-shadow:0 10px 25px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body>

<!-- HEADER -->
<div class="top-header">
    <div class="header-left">
        <img src="{{ asset('images/logo.png') }}" class="logo">
        <div>
            <div class="instansi">DINAS PERPUSTAKAAN DAN KEARSIPAN</div>
            <div class="provinsi">PROVINSI BENGKULU</div>
        </div>
    </div>

    <div class="admin-box">
        <i class="fa-solid fa-user-shield"></i>
        <strong>Admin</strong>
    </div>
</div>

<div class="layout">

    <!-- SIDEBAR -->
    <div class="sidebar">

        <div>
            <a href="{{ route('admin.dashboard') }}"
               class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-gauge"></i> Dashboard
            </a>

            <a href="{{ route('admin.kelola') }}"
               class="{{ request()->routeIs('admin.kelola') ? 'active' : '' }}">
                <i class="fa-solid fa-folder-open"></i> Kelola Permohonan
            </a>

            <a href="{{ route('admin.laporan') }}"
               class="{{ request()->routeIs('admin.laporan') ? 'active' : '' }}">
                <i class="fa-solid fa-file-lines"></i> Laporan
            </a>
        </div>

        <!-- LOGOUT -->
        <button class="btn btn-danger w-100 mt-3"
                data-bs-toggle="modal"
                data-bs-target="#logoutModal">
            <i class="fa-solid fa-right-from-bracket"></i> Logout
        </button>

    </div>

    <!-- CONTENT -->
    <div class="content">
        @yield('content')
    </div>

</div>

<!-- MODAL LOGOUT -->
<div class="modal fade" id="logoutModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content premium text-center p-4">

      <div class="modal-body">
        <h4 class="fw-bold mb-3">Konfirmasi Logout</h4>
        <p class="mb-4" style="color:#555;">
            Apakah Anda yakin ingin keluar dari sistem?
        </p>

        <div class="d-flex justify-content-center gap-3">
            <button type="button"
                    class="btn btn-outline-secondary"
                    data-bs-dismiss="modal">
                Batal
            </button>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger">
                    Ya, Logout
                </button>
            </form>
        </div>

      </div>

    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>