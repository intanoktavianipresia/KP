<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- ICON -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            margin:0;
            font-family:'Inter', sans-serif;
            background:#f4f6f9;
        }

        /* HEADER */
        .top-header{
            background:linear-gradient(90deg,#0f5d3f,#0b4a32);
            color:white;
            display:flex;
            justify-content:space-between;
            align-items:center;
            padding:12px 25px;
            box-shadow:0 4px 10px rgba(0,0,0,0.1);
        }

        .header-left{
            display:flex;
            align-items:center;
            gap:10px;
        }

        .logo{
            width:42px;
        }

        .instansi{ font-weight:600; }
        .provinsi{ font-size:13px; opacity:0.8; }

        /* LAYOUT */
        .layout{ display:flex; }

        /* SIDEBAR */
        .sidebar{
            width:240px;
            background:#0f172a;
            min-height:100vh;
            padding:20px;
            display:flex;
            flex-direction:column;
            justify-content:space-between;
            transition:0.3s;
        }

        .sidebar.collapsed{ width:70px; }

        .sidebar a{
            display:flex;
            align-items:center;
            gap:10px;
            color:#cbd5e1;
            text-decoration:none;
            padding:10px 12px;
            border-radius:10px;
            transition:0.2s;
        }

        .sidebar a:hover{
            background:#1e293b;
            transform:translateX(5px);
        }

        .sidebar a.active{
            background:#0f5d3f;
            color:white;
        }

        .sidebar.collapsed a span{ display:none; }
        .sidebar.collapsed a{ justify-content:center; }

        /* CONTENT */
        .content{
            flex:1;
            padding:30px;
            animation:fadeIn .4s ease;
        }

        /* CARD */
        .card{
            border:none;
            border-radius:14px;
            box-shadow:0 8px 20px rgba(0,0,0,0.05);
            transition:.3s;
        }
        .card:hover{
            transform:translateY(-5px);
            box-shadow:0 12px 25px rgba(0,0,0,0.08);
        }

        /* TABLE */
        .table thead{
            background:#0f5d3f;
            color:white;
        }
        .table tbody tr:hover{
            background:#f1f5f9;
        }

        /* BUTTON */
        .btn{
            border-radius:8px;
            transition:.2s;
        }
        .btn:hover{
            transform:scale(1.03);
        }

        /* ANIMATION */
        @keyframes fadeIn{
            from{opacity:0; transform:translateY(10px);}
            to{opacity:1; transform:translateY(0);}
        }

        @keyframes spin{
            100%{transform:rotate(360deg);}
        }

        /* LOADING */
        #loading{
            position:fixed;
            width:100%;
            height:100%;
            background:white;
            display:flex;
            justify-content:center;
            align-items:center;
            z-index:9999;
        }

        /* SUCCESS POPUP */
        #successAnim{
            position:fixed;
            top:50%;
            left:50%;
            transform:translate(-50%,-50%);
            background:white;
            padding:30px;
            border-radius:12px;
            box-shadow:0 10px 25px rgba(0,0,0,0.2);
            display:none;
            z-index:9999;
            text-align:center;
        }

        /* PAGINATION */
        .pagination svg{
            width:16px !important;
        }
    </style>
</head>
<body>

<!-- LOADING -->
<div id="loading">
    <div style="
        width:40px;
        height:40px;
        border:4px solid #ddd;
        border-top:4px solid #0f5d3f;
        border-radius:50%;
        animation:spin 1s linear infinite;">
    </div>
</div>

<!-- SUCCESS -->
<div id="successAnim">
    <div style="font-size:40px;color:#16a34a;">✔</div>
    <div style="margin-top:10px;font-weight:bold;">Berhasil</div>
</div>

<!-- HEADER -->
<div class="top-header">
    <div class="header-left">
        <button onclick="toggleSidebar()" style="background:none;border:none;color:white;font-size:18px;">
            <i class="fa-solid fa-bars"></i>
        </button>

        <img src="{{ asset('images/logo.png') }}" class="logo">

        <div>
            <div class="instansi">DINAS PERPUSTAKAAN DAN KEARSIPAN</div>
            <div class="provinsi">PROVINSI BENGKULU</div>
        </div>
    </div>

    <div>
        <i class="fa-solid fa-user-shield"></i> Admin
    </div>
</div>

<div class="layout">

    <div class="sidebar">

        <div>
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard')?'active':'' }}">
                <i class="fa-solid fa-gauge"></i><span>Dashboard</span>
            </a>

            <a href="{{ route('admin.kelola') }}" class="{{ request()->routeIs('admin.kelola')?'active':'' }}">
                <i class="fa-solid fa-folder-open"></i><span>Kelola</span>
            </a>

            <a href="{{ route('admin.jadwal') }}" class="{{ request()->routeIs('admin.jadwal')?'active':'' }}">
                <i class="fa-solid fa-calendar-days"></i><span>Jadwal</span>
            </a>

            <a href="{{ route('admin.laporan') }}" class="{{ request()->routeIs('admin.laporan')?'active':'' }}">
                <i class="fa-solid fa-file-lines"></i><span>Laporan</span>
            </a>
        </div>

        <button class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#logoutModal">
            Logout
        </button>

    </div>

    <div class="content">
        @yield('content')
    </div>

</div>

<!-- TOAST -->
<div id="toastBox" style="position:fixed;top:20px;right:20px;z-index:9999;"></div>

<!-- LOGOUT MODAL -->
<div class="modal fade" id="logoutModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-center p-4">
        <h4>Konfirmasi Logout</h4>
        <p>Yakin ingin keluar?</p>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-danger">Logout</button>
        </form>
    </div>
  </div>
</div>

<script>
function toggleSidebar(){
    document.querySelector('.sidebar').classList.toggle('collapsed');
}

window.onload=function(){
    document.getElementById("loading").style.display="none";

    @if(session('success'))
        showToast("{{ session('success') }}");
    @endif

    @if(session('notif_email'))
        showToast("📩 Email terkirim");
    @endif

    @if(session('notif_wa'))
        showToast("📱 WhatsApp terkirim");
    @endif
}

function showToast(msg){
    showSuccess();

    let t=document.createElement("div");
    t.innerText=msg;
    t.style.background="#0f5d3f";
    t.style.color="white";
    t.style.padding="10px";
    t.style.marginTop="10px";
    t.style.borderRadius="8px";

    document.getElementById("toastBox").appendChild(t);
    setTimeout(()=>t.remove(),3000);
}

function showSuccess(){
    let el=document.getElementById("successAnim");
    el.style.display="block";
    setTimeout(()=>el.style.display="none",1200);
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>