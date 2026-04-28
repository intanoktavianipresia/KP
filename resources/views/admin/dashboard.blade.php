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
        padding: 10px;
        max-width: 1600px; /* Menjaga agar tidak terlalu lebar di monitor ultrawide */
        margin: 0 auto;
    }

    .dashboard-header {
        margin-top: 10px;
        margin-bottom: 20px;
    }

    .dashboard-header h1 {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 800;
        font-size: clamp(1.5rem, 5vw, 2.5rem); /* Ukuran teks dinamis berdasarkan lebar layar */
        color: var(--slate-900);
        letter-spacing: -0.02em;
        margin-bottom: 5px;
    }

    .custom-alert {
        border-radius: 16px;
        border: none;
        padding: clamp(10px, 3vw, 20px);
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 25px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.03);
        font-size: clamp(12px, 2vw, 14px);
        background: #ecfdf5; 
        color: #065f46;
    }

    .bento-grid {
        display: grid;
        grid-template-columns: 1fr; 
        gap: 12px;
        margin-bottom: 25px;
    }

    @media (min-width: 400px) {
        .bento-grid { grid-template-columns: repeat(2, 1fr); }
    }

    @media (min-width: 992px) { 
        .bento-grid { grid-template-columns: repeat(4, 1fr); gap: 20px; } 
    }

    .card-bento {
        background: white;
        border: 1px solid #eef2f6;
        padding: clamp(15px, 4vw, 30px);
        border-radius: clamp(16px, 3vw, 28px);
        position: relative;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        text-decoration: none !important;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        min-height: clamp(100px, 15vw, 160px);
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);
        overflow: hidden;
    }

    .card-bento .label {
        font-size: clamp(10px, 1.5vw, 13px);
        font-weight: 700;
        color: var(--slate-500);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        z-index: 2;
    }

    .card-bento .value {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: clamp(24px, 4vw, 48px);
        font-weight: 800;
        color: var(--slate-900);
        line-height: 1;
        margin-top: 5px;
        z-index: 2;
    }

    .card-icon {
        position: absolute;
        top: clamp(10px, 2vw, 25px);
        right: clamp(10px, 2vw, 25px);
        width: clamp(30px, 4vw, 45px);
        height: clamp(30px, 4vw, 45px);
        border-radius: 30%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f1f5f9;
        font-size: clamp(12px, 2vw, 18px);
        transition: 0.3s;
    }

    .card-bento:hover {
        background: var(--pine-green);
        transform: translateY(-8px);
        box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1);
    }

    .card-bento:hover .value, 
    .card-bento:hover .label,
    .card-bento:hover .card-icon {
        color: white !important;
    }
    
    .card-bento:hover .card-icon {
        background: rgba(255,255,255,0.2);
    }

    /* Chart Box Adjustments */
    .chart-box {
        background: white;
        border: 1px solid #eef2f6;
        border-radius: clamp(20px, 4vw, 32px);
        padding: clamp(15px, 3vw, 40px);
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);
    }

    .chart-header-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap; /* Agar elemen turun jika layar terlalu sempit */
        gap: 15px;
        margin-bottom: 25px;
    }

    .chart-container {
        position: relative;
        height: clamp(250px, 40vh, 450px);
        width: 100%;
    }

    /* Hide specific elements on extremely small screens like smartwatches */
    @media (max-width: 280px) {
        .dashboard-header p, .card-icon { display: none; }
        .card-bento { padding: 10px; }
    }
</style>

<div class="container-fluid"> 
    <div class="dashboard-wrapper">
        <header class="dashboard-header">
            <h1>Overview Dashboard</h1>
            <p class="text-muted">Pantau statistik dan permohonan secara real-time.</p>

            @if(session('success'))
            <div class="custom-alert shadow-sm">
                <i class="fas fa-check-circle fa-lg"></i>
                <div><strong>Berhasil!</strong> {{ session('success') }}</div>
            </div>
            @endif
        </header>

        <div class="bento-grid">
            <a href="{{ route('admin.kelola', ['status' => 'menunggu']) }}" class="card-bento">
                <div class="card-icon" style="color: #f59e0b;"><i class="fas fa-clock"></i></div>
                <span class="label">Menunggu</span>
                <span class="value">{{ $menunggu }}</span>
            </a>

            <a href="{{ route('admin.kelola', ['status' => 'disetujui']) }}" class="card-bento">
                <div class="card-icon" style="color: #10b981;"><i class="fas fa-check-circle"></i></div>
                <span class="label">Disetujui</span>
                <span class="value">{{ $disetujui }}</span>
            </a>

            <a href="{{ route('admin.kelola', ['status' => 'ditolak']) }}" class="card-bento">
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
            <div class="chart-header-content">
                <div>
                    <h4 class="fw-bold m-0" style="font-family: 'Plus Jakarta Sans'; font-size: clamp(16px, 2vw, 20px);">Tren Registrasi</h4>
                    <p class="text-muted small m-0">Data permohonan 2026</p>
                </div>
                <span class="badge" style="background: #f1f5f9; color: var(--pine-green); font-weight: 800; border-radius: 10px; padding: 10px 15px; font-size: 11px;">
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
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('mainChart').getContext('2d');
        
        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, '#064e3b'); 
        gradient.addColorStop(1, '#10b981'); 

        const mainChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($bulan),
                datasets: [{
                    label: 'Permohonan',
                    data: @json($total),
                    backgroundColor: gradient,
                    hoverBackgroundColor: '#064e3b',
                    borderRadius: 8,
                    barThickness: 'flex',
                    maxBarThickness: 40,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { 
                    legend: { display: false },
                    tooltip: {
                        padding: 12,
                        backgroundColor: '#0f172a',
                        titleFont: { size: 14 },
                        bodyFont: { size: 13 }
                    }
                },
                scales: {
                    y: { 
                        beginAtZero: true,
                        grid: { color: '#f1f5f9' },
                        ticks: { 
                            font: { size: window.innerWidth < 768 ? 10 : 12 },
                            callback: function(value) { if (value % 1 === 0) return value; }
                        }
                    },
                    x: { 
                        grid: { display: false },
                        ticks: { 
                            font: { size: window.innerWidth < 768 ? 10 : 12 },
                            maxRotation: 45,
                            minRotation: 0
                        }
                    }
                }
            }
        });

        window.addEventListener('resize', () => {
            const isMobile = window.innerWidth < 768;
            mainChart.options.scales.x.ticks.font.size = isMobile ? 10 : 12;
            mainChart.options.scales.y.ticks.font.size = isMobile ? 10 : 12;
            mainChart.update();
        });
    });
</script>

@endsection