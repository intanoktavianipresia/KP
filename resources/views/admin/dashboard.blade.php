@extends('layouts.admin')

@section('content')

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
.dashboard{
    padding:30px;
    background:#f4f6f9;
    min-height:100vh;
    font-family:Arial, Helvetica, sans-serif;
}

.cards{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:20px;
    margin-bottom:30px;
}

.card{
    padding:25px;
    border-radius:10px;
    color:white;
    position:relative;
    box-shadow:0 5px 15px rgba(0,0,0,0.05);
}

.card i{
    position:absolute;
    right:20px;
    top:20px;
    font-size:28px;
    opacity:.3;
}

.card h2{
    margin:0;
    font-size:30px;
    font-weight:bold;
}

.card p{
    margin-top:8px;
    font-size:14px;
    letter-spacing:.5px;
}

.blue{ background:#1e3a8a; }
.green{ background:#166534; }
.red{ background:#991b1b; }
.orange{ background:#9a3412; }

.chart-box{
    background:white;
    padding:25px;
    border-radius:10px;
    box-shadow:0 5px 15px rgba(0,0,0,0.05);
}
</style>

<div class="dashboard">

<h1 style="margin-bottom:25px;">Selamat datang!</h1>

<div class="cards">

    <div class="card blue">
        <i class="fas fa-clock"></i>
        <h2>{{ $menunggu }}</h2>
        <p>Menunggu Verifikasi</p>
    </div>

    <div class="card green">
        <i class="fas fa-check-circle"></i>
        <h2>{{ $disetujui }}</h2>
        <p>Disetujui</p>
    </div>

    <div class="card red">
        <i class="fas fa-times-circle"></i>
        <h2>{{ $ditolak }}</h2>
        <p>Ditolak</p>
    </div>

    <div class="card orange">
        <i class="fas fa-calendar-alt"></i>
        <h2>{{ $jadwal }}</h2>
        <p>Jadwal Kunjungan</p>
    </div>

</div>

<div class="chart-box">
    <h4 style="margin-bottom:20px;">Grafik Pendaftaran Bulanan</h4>
    <canvas id="chartPemohon"></canvas>
</div>

</div>

<script>
new Chart(document.getElementById('chartPemohon'),{
    type:'bar',
    data:{
        labels: @json($bulan),
        datasets:[{
            label:'Jumlah Permohonan',
            data: @json($total),
            backgroundColor:'#1e3a8a',
            borderRadius:6
        }]
    },
    options:{
        plugins:{legend:{display:false}},
        scales:{
            y:{beginAtZero:true},
        }
    }
});
</script>

@endsection
