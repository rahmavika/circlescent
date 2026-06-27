@extends('admin.layouts.main')
@section('content')

@php
    $cards = [
        [
            'title' => 'Jumlah Produk',
            'value' => $jumlahProduk,
            'icon'  => 'fas fa-box',
            'color' => 'linear-gradient(135deg,#f59e0b,#f97316)'
        ],
        [
            'title' => 'Jumlah Pelanggan',
            'value' => $jumlahPelanggan,
            'icon'  => 'fas fa-users',
            'color' => 'linear-gradient(135deg,#3b82f6,#2563eb)'
        ],
        [
            'title' => 'Pesanan Masuk',
            'value' => $jumlahPesananMasuk,
            'icon'  => 'fas fa-shopping-bag',
            'color' => 'linear-gradient(135deg,#8b5cf6,#6d28d9)'
        ]
    ];
@endphp

<div class="container-fluid py-4 px-4 dashboard-wrapper">
    <div class="row g-4 mb-4">
        @foreach ($cards as $card)
            <div class="col-lg-4">
                <div class="dashboard-card stat-card">
                    <div class="stat-icon" style="background: {{ $card['color'] }}">
                        <i class="{{ $card['icon'] }}"></i>
                    </div>
                    <div>
                        <p>{{ $card['title'] }}</p>
                        <h2>{{ $card['value'] }}</h2>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="dashboard-card">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">Grafik Penjualan</h5>
                    <div class="d-flex gap-2">
                        <a href="{{ request()->fullUrlWithQuery(['bulan' => \Carbon\Carbon::parse($bulan)->subMonth()->format('Y-m')]) }}"
                           class="btn btn-sm btn-outline-secondary">←</a>
                        <form method="GET">
                            <input type="month" name="bulan" value="{{ $bulan }}"
                                   class="form-control form-control-sm"
                                   onchange="this.form.submit()">
                        </form>
                        <a href="{{ request()->fullUrlWithQuery(['bulan' => \Carbon\Carbon::parse($bulan)->addMonth()->format('Y-m')]) }}"
                           class="btn btn-sm btn-outline-secondary">→</a>
                    </div>
                </div>
                <div class="chart-wrapper">
                    <canvas id="grafikPenjualan"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="d-flex flex-column gap-4">
                <div class="dashboard-card total-sales-card">
                    <p>Total Penjualan</p>
                    <h2>Rp {{ number_format($totalPenjualan, 0, ',', '.') }}</h2>
                    <small>{{ now()->translatedFormat('d F Y') }}</small>
                </div>
                <div class="dashboard-card">
                    <h5>Transaksi Terbaru</h5>
                    @forelse($transaksiTerbaru as $trx)
                        <div class="d-flex justify-content-between border-bottom py-2">
                            <span>{{ $trx->created_at->format('d M') }}</span>
                            <strong>Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</strong>
                        </div>
                    @empty
                        <small class="text-muted">Belum ada transaksi</small>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <div class="row g-4 mt-2">
        <div class="col-lg-12">
            <div class="dashboard-card">
                <h5>Grafik Penjualan Bulanan - {{ $tahun }}</h5>
                <form method="GET" class="mb-3">
                    <select name="tahun" class="form-select form-select-sm w-auto"
                            onchange="this.form.submit()">
                        @for($i = now()->year; $i >= now()->year - 5; $i--)
                            <option value="{{ $i }}" {{ $tahun == $i ? 'selected' : '' }}>
                                {{ $i }}
                            </option>
                        @endfor
                    </select>
                </form>
                <div class="chart-wrapper">
                    <canvas id="grafikBulanan"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-4 mt-2">
        <div class="col-lg-6">
            <div class="dashboard-card">
                <h5>Status Pesanan</h5>
                <div class="small-chart">
                    <canvas id="chartStatus"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="dashboard-card">
                <h5>Metode Pembayaran (LUNAS)</h5>
                <div class="small-chart">
                    <canvas id="chartPembayaran"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>


<style>
    .dashboard-wrapper{
        background:
            radial-gradient(circle at top,#2b2413 0%,#111112 45%,#0a0a0b 100%);
        min-height:100vh;
        color:#fff;
    }

    .dashboard-card{
        background:rgba(22,22,24,.92);
        backdrop-filter:blur(18px);
        border:1px solid rgba(212,175,55,.12);
        border-radius:22px;
        padding:24px;
        box-shadow:
            0 10px 35px rgba(0,0,0,.45),
            inset 0 1px 0 rgba(255,255,255,.03);
        transition:.35s;
    }

    .dashboard-card:hover{
        transform:translateY(-4px);
        border-color:#d4af37;
        box-shadow:
            0 18px 45px rgba(0,0,0,.55),
            0 0 25px rgba(212,175,55,.15);
    }

    .dashboard-card h5{
        color:#f5d77b;
        font-weight:600;
        letter-spacing:.5px;
    }

    .dashboard-card p{
        color:#bcbcbc;
        margin-bottom:5px;
    }

    .dashboard-card small{
        color:#999;
    }

    .stat-card{
        display:flex;
        align-items:center;
        gap:18px;
    }

    .stat-card h2{
        color:white;
        font-weight:700;
        font-size:34px;
    }

    .stat-icon{
        width:72px;
        height:72px;
        border-radius:20px;
        display:flex;
        justify-content:center;
        align-items:center;
        font-size:28px;
        color:white;
        box-shadow:
            0 10px 25px rgba(0,0,0,.4),
            inset 0 1px 0 rgba(255,255,255,.15);
    }

    .chart-wrapper{
        height:340px;
    }

    .small-chart{
        height:240px;
    }

    .total-sales-card{
        background:
            linear-gradient(145deg,#d4af37,#7d5a00);
        color:white;
        text-align:center;
        overflow:hidden;
        position:relative;
    }

    .total-sales-card::before{
        content:"";
        position:absolute;
        width:180px;
        height:180px;
        background:rgba(255,255,255,.08);
        border-radius:50%;
        right:-70px;
        top:-70px;
    }

    .total-sales-card h2{
        font-size:34px;
        font-weight:700;
        margin:15px 0;
    }

    .total-sales-card p{
        color:white;
        font-size:15px;
    }

    .form-control,
    .form-select{
        background:#111 !important;
        color:white !important;
        border:1px solid rgba(212,175,55,.3);
    }

    .form-control:focus,
    .form-select:focus{
        border-color:#d4af37;
        box-shadow:0 0 0 .2rem rgba(212,175,55,.15);
    }

    .btn-outline-secondary{
        color:#d4af37;
        border-color:#d4af37;
    }

    .btn-outline-secondary:hover{
        background:#d4af37;
        color:#111;
    }

    .border-bottom{
        border-color:rgba(212,175,55,.08)!important;
    }

    ::-webkit-scrollbar{
        width:8px;
    }

    ::-webkit-scrollbar-thumb{
        background:#5f4b18;
        border-radius:20px;
    }

    ::-webkit-scrollbar-track{
        background:#111;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {

        // ===========================
        // GRAFIK PENJUALAN HARIAN
        // ===========================
        new Chart(document.getElementById('grafikPenjualan'), {
            type: 'line',
            data: {
                labels: {!! json_encode($pesananPerHari->pluck('tanggal')) !!},
                datasets: [{
                    label: 'Penjualan Selesai',
                    data: {!! json_encode($pesananPerHari->pluck('total')) !!},
                    borderColor: '#d4af37',
                    backgroundColor: 'rgba(212,175,55,.12)',
                    fill: true,
                    tension: 0.45,

                    pointBackgroundColor: '#f7d56d',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 8,

                    borderWidth: 3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,

                plugins: {
                    legend: {
                        display: false,
                        labels: {
                            color: '#ffffff'
                        }
                    },

                    tooltip: {
                        backgroundColor: '#111111',
                        borderColor: '#d4af37',
                        borderWidth: 1,
                        titleColor: '#f5d77b',
                        bodyColor: '#ffffff',
                        displayColors: false,
                        callbacks: {
                            label: function(context){
                                return " Rp " + context.raw.toLocaleString('id-ID');
                            }
                        }
                    }
                },

                scales: {

                    x: {
                        ticks: {
                            color: '#d7d7d7'
                        },
                        grid: {
                            color: 'rgba(255,255,255,.05)'
                        }
                    },

                    y: {
                        ticks: {
                            color: '#d7d7d7',
                            callback: function(value){
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        },
                        grid: {
                            color: 'rgba(255,255,255,.05)'
                        }
                    }

                }

            }
        });


        // ===========================
        // STATUS PESANAN
        // ===========================
        new Chart(document.getElementById('chartStatus'), {

            type: 'doughnut',

            data: {

                labels: {!! json_encode($statusPesanan->keys()) !!},

                datasets: [{

                    data: {!! json_encode($statusPesanan->values()) !!},

                    backgroundColor: [
                        '#d4af37',
                        '#f59e0b',
                        '#3b82f6',
                        '#22c55e'
                    ],

                    borderColor: '#1b1b1b',
                    borderWidth: 2,
                    hoverOffset: 12

                }]

            },

            options: {

                responsive: true,
                maintainAspectRatio: false,

                plugins: {

                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#ffffff',
                            padding: 18
                        }
                    },

                    tooltip: {
                        backgroundColor: '#111',
                        titleColor: '#f5d77b',
                        bodyColor: '#fff'
                    }

                }

            }

        });


        // ===========================
        // METODE PEMBAYARAN
        // ===========================
        new Chart(document.getElementById('chartPembayaran'), {

            type: 'doughnut',

            data: {

                labels: {!! json_encode($metodePembayaran->keys()) !!},

                datasets: [{

                    data: {!! json_encode($metodePembayaran->values()) !!},

                    backgroundColor: [
                        '#d4af37',
                        '#6b7280',
                        '#14b8a6',
                        '#8b5cf6',
                        '#ef4444'
                    ],

                    borderColor: '#1b1b1b',
                    borderWidth: 2,
                    hoverOffset: 12

                }]

            },

            options: {

                responsive: true,
                maintainAspectRatio: false,

                plugins: {

                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#ffffff',
                            padding: 18
                        }
                    },

                    tooltip: {
                        backgroundColor: '#111',
                        titleColor: '#f5d77b',
                        bodyColor: '#fff'
                    }

                }

            }

        });



        // ===========================
        // GRAFIK PENJUALAN BULANAN
        // ===========================

        const ctx = document.getElementById('grafikBulanan').getContext('2d');

        const gradient = ctx.createLinearGradient(0,0,0,350);

        gradient.addColorStop(0,'#f8e39a');
        gradient.addColorStop(.55,'#d4af37');
        gradient.addColorStop(1,'#8b6914');

        new Chart(ctx, {

            type:'bar',

            data:{

                labels:{!! json_encode($penjualanPerBulan->pluck('nama_bulan')) !!},

                datasets:[{

                    data:{!! json_encode($penjualanPerBulan->pluck('total')) !!},

                    backgroundColor:gradient,

                    borderRadius:15,

                    borderSkipped:false,

                    barThickness:40

                }]

            },

            options:{

                responsive:true,

                maintainAspectRatio:false,

                plugins:{

                    legend:{
                        display:false
                    },

                    tooltip:{

                        backgroundColor:'#111111',

                        borderColor:'#d4af37',

                        borderWidth:1,

                        titleColor:'#f5d77b',

                        bodyColor:'#ffffff',

                        padding:12,

                        displayColors:false,

                        callbacks:{

                            label:function(context){

                                return 'Rp ' + context.raw.toLocaleString('id-ID');

                            }

                        }

                    }

                },

                scales:{

                    x:{

                        ticks:{
                            color:'#dddddd'
                        },

                        grid:{
                            display:false
                        }

                    },

                    y:{

                        ticks:{

                            color:'#dddddd',

                            callback:function(value){

                                return 'Rp ' + value.toLocaleString('id-ID');

                            }

                        },

                        grid:{
                            color:'rgba(255,255,255,.05)'
                        }

                    }

                }

            }

        });

    });
</script>

@endsection