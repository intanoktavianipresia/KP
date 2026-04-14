@extends('layouts.admin')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    :root {
        --pine-green: #064e3b; 
        --emerald: #10b981;
        --bg-light: #f8fafc;
        --slate-900: #0f172a;
        --slate-500: #64748b;
    }

    .dashboard-wrapper {
        font-family: 'Inter', sans-serif;
    }

    .dashboard-header {
        margin-top: 10px; /* ✅ FIX biar tidak ketabrak header */
    }

    .dashboard-header h1 {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 800;
        font-size: 32px;
        color: var(--slate-900);
        letter-spacing: -1.5px;
        margin-bottom: 10px;
    }

    /* Alert Styling */
    .custom-alert {
        border-radius: 16px;
        border: none;
        padding:20px 30px 30px 30px;
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 25px;
        margin-top: 10px; /* ✅ FIX tambahan */
        box-shadow: 0 4px 12px rgba(0,0,0,0.03);
        animation: slideDown 0.4s ease;
    }

    @keyframes slideDown {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .bento-grid {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
        gap: 20px;
        margin-bottom: 35px;
    }
    @media (min-width: 768px) { .bento-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (min-width: 1200px) { .bento-grid { grid-template-columns: repeat(4, 1fr); } }

    .card-bento {
        background: white;
        border: 1px solid #eef2f6;
        padding: 30px;
        border-radius: 28px;
        position: relative;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        text-decoration: none !important;
        display: block;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);
    }

    .card-bento:hover {
        background: var(--pine-green);
        border-color: var(--pine-green);
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(6, 78, 59, 0.2);
    }

    .card-bento .label {
        font-size: 13px;
        font-weight: 700;
        color: var(--slate-500);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: 0.3s;
    }

    .card-bento .value {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 48px;
        font-weight: 800;
        color: var(--slate-900);
        display: block;
        margin-top: 10px;
        transition: 0.3s;
    }

    .card-icon {
        position: absolute;
        top: 25px;
        right: 25px;
        width: 42px;
        height: 42px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f1f5f9;
        font-size: 16px;
        transition: 0.4s;
    }

    .card-bento:hover .label { color: rgba(255, 255, 255, 0.7); }
    .card-bento:hover .value { color: white; }
    .card-bento:hover .card-icon { background: rgba(255, 255, 255, 0.15); color: white !important; }

    .chart-box {
        background: white;
        border: 1px solid #eef2f6;
        border-radius: 32px;
        padding: 40px;
    }

    .chart-container {
        position: relative;
        height: 350px;
        width: 100%;
        margin-top: 20px;
    }
</style>

<div class="container pt-0 pb-4"> <!-- ✅ FIX jarak atas -->

    <div class="dashboard-wrapper">
        <div class="dashboard-header">
            <h1>Overview Dashboard</h1>
            <p class="text-muted mb-4">Pantau statistik dan permohonan arsip secara real-time.</p>

            @if(session('success'))
            <div class="custom-alert shadow-sm" style="background: #ecfdf5; color: #065f46;">
                <i class="fas fa-check-circle fa-lg"></i>
                <div><strong>Berhasil!</strong> {{ session('success') }}</div>
            </div>
            @endif

            @if(session('notif_email'))
            <div class="custom-alert shadow-sm" style="background: #eff6ff; color: #1e40af;">
                <i class="fas fa-envelope fa-lg"></i>
                <div><strong>Email Terkirim:</strong> Notifikasi sistem telah diteruskan ke alamat email pengguna.</div>
            </div>
            @endif

            @if(session('notif_wa'))
            <div class="custom-alert shadow-sm" style="background: #f0fdf4; color: #166534; border-left: 6px solid #22c55e !important;">
                <i class="fab fa-whatsapp fa-lg"></i>
                <div><strong>WhatsApp Sent:</strong> Pesan konfirmasi telah berhasil dikirim melalui gateway.</div>
            </div>
            @endif
        </div>

        <!-- CARD NAVIGASI (INI YANG KAMU MAKSUD) -->
        <div class="bento-grid">
            <a href="{{ route('admin.kelola') }}?status=menunggu" class="card-bento">
                <div class="card-icon" style="color: #f59e0b;"><i class="fas fa-clock"></i></div>
                <span class="label">Menunggu</span>
                <span class="value">{{ $menunggu }}</span>
            </a>

            <a href="{{ route('admin.kelola') }}?status=disetujui" class="card-bento">
                <div class="card-icon" style="color: #10b981;"><i class="fas fa-check-circle"></i></div>
                <span class="label">Disetujui</span>
                <span class="value">{{ $disetujui }}</span>
            </a>

            <a href="{{ route('admin.kelola') }}?status=ditolak" class="card-bento">
                <div class="card-icon" style="color: #ef4444;"><i class="fas fa-times-circle"></i></div>
                <span class="label">Ditolak</span>
                <span class="value">{{ $ditolak }}</span>
            </a>

            <a href="{{ route('admin.jadwal') }}" class="card-bento">
                <div class="card-icon" style="color: #3b82f6;"><i class="fas fa-calendar-alt"></i></div>
                <span class="label">Jadwal</span>
                <span class="value">{{ $jadwal }}</span>
            </a>
        </div>

        <div class="chart-box">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="fw-800 m-0" style="font-family: 'Plus Jakarta Sans';">Tren Registrasi</h4>
                    <p class="text-muted small m-0">Statistik permohonan masuk tahun 2026</p>
                </div>
                <span class="badge px-3 py-2" style="background: #f1f5f9; color: var(--pine-green); font-weight: 800; border-radius: 10px;">
                    <i class="fas fa-map-marker-alt me-1"></i> BENGKULU
                </span>
            </div>

            <div class="chart-container">
                <canvas id="mainChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    const ctx = document.getElementById('mainChart').getContext('2d');
    
    const gradient = ctx.createLinearGradient(0, 0, 0, 350);
    gradient.addColorStop(0, '#064e3b'); 
    gradient.addColorStop(1, '#10b981'); 

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($bulan),
            datasets: [{
                label: 'Permohonan',
                data: @json($total),
                backgroundColor: gradient,
                hoverBackgroundColor: '#064e3b',
                borderRadius: 12,
                barThickness: window.innerWidth < 768 ? 15 : 45,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true },
                x: { grid: { display: false } }
            }
        }
    });
</script>

@endsection