@extends('admin.layouts.main')
@section('content')

<style>
    body {
        background: linear-gradient(135deg, #0f0f0f, #1c1c1c);
    }

    /* HEADER */
    .header-card {
        background: linear-gradient(135deg, #1a1a1a, #2b2b2b);
        border: 1px solid rgba(212, 175, 55, 0.15);
        border-radius: 22px;
        overflow: hidden;
        color: #fff;
        box-shadow: 0 10px 30px rgba(0,0,0,0.25);
    }

    .header-card h4 {
        font-weight: 700;
        color: #d4af37;
    }

    .header-card small {
        color: rgba(255,255,255,.65);
    }

    /* MAIN CARD */
    .card-custom {
        background: rgba(26, 26, 26, 0.95);
        border: 1px solid rgba(212, 175, 55, 0.15);
        border-radius: 24px;
        overflow: hidden;
        backdrop-filter: blur(14px);
        box-shadow: 0 10px 40px rgba(0,0,0,.3);
    }

    .card-header-custom {
        background: rgba(255,255,255,0.02);
        border-bottom: 1px solid rgba(212,175,55,.15);
        padding: 22px;
        font-size: 17px;
        font-weight: 600;
        color: #d4af37;
    }

    .info-box {
        color: #d1d5db;
        font-size: 13px;
    }

    /* FILTER */
    .filter-box {
        background: rgba(255,255,255,0.03);
        border: 1px solid rgba(212,175,55,.1);
        border-radius: 18px;
        padding: 18px;
        margin-bottom: 25px;
    }

    .filter-box label {
        color: #d4af37;
        font-size: 13px;
        margin-bottom: 5px;
    }

    .form-control {
        background: #111827;
        border: 1px solid rgba(212,175,55,.15);
        color: #fff;
        border-radius: 12px;
        padding: 12px;
    }

    .form-control:focus {
        border-color: #d4af37;
        box-shadow: 0 0 0 .15rem rgba(212,175,55,.2);
        background: #111827;
        color: white;
    }

    /* BUTTON */
    .btn-gold {
        background: linear-gradient(135deg, #d4af37, #f5d061);
        border: none;
        color: #111;
        border-radius: 12px;
        font-weight: 600;
        transition: .3s;
    }

    .btn-gold:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(212,175,55,.3);
    }

    .btn-dark-custom {
        background: #1f2937;
        border: 1px solid rgba(255,255,255,.08);
        color: white;
        border-radius: 12px;
    }

    /* TABLE */
    .table-clean {
        color: white;
        border-collapse: separate;
        border-spacing: 0 10px;
    }

    .table-clean thead th {
        background: transparent;
        border: none;
        color: #d4af37;
        text-transform: uppercase;
        font-size: 12px;
        letter-spacing: 1px;
    }

    .table-clean tbody tr {
        background: rgba(255,255,255,0.03);
        border: 1px solid rgba(255,255,255,.04);
        transition: .3s;
    }

    .table-clean tbody tr:hover {
        background: rgba(212,175,55,.08);
        transform: scale(1.003);
    }

    .table-clean td {
        border: none;
        padding: 18px 14px;
        color: #f3f4f6;
        vertical-align: middle;
    }

    .table-clean tbody tr td:first-child {
        border-radius: 14px 0 0 14px;
    }

    .table-clean tbody tr td:last-child {
        border-radius: 0 14px 14px 0;
    }

    /* BADGE */
    .badge-masuk {
        background: rgba(34,197,94,.15);
        color: #22c55e;
        border: 1px solid rgba(34,197,94,.2);
        padding: 8px 14px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 600;
    }

    .badge-keluar {
        background: rgba(239,68,68,.15);
        color: #ef4444;
        border: 1px solid rgba(239,68,68,.2);
        padding: 8px 14px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 600;
    }

    .product-name {
        color: #fff;
        font-weight: 600;
    }

    .empty-state {
        color: rgba(255,255,255,.5);
        padding: 30px;
    }
</style>

<div class="card border-0 shadow-sm mb-4 header-card">
    <div class="card-body d-flex justify-content-between align-items-center p-4">
        <div>
            <h4 class="mb-1">
                ✨ Log Stok Parfum
            </h4>
            <small>
                Riwayat keluar masuk stok produk parfum
            </small>
        </div>

        <div>
            <i class="bi bi-clock-history fs-1 text-warning"></i>
        </div>
    </div>
</div>

<div class="container-fluid px-0">
    <div class="card card-custom">

        <div class="card-header-custom d-flex justify-content-between align-items-center">
            <span>Riwayat Pergerakan Stok</span>

            <span class="info-box">
                Total Data:
                <strong class="text-warning">
                    {{ count($logStok) }}
                </strong>
            </span>
        </div>

        <div class="card-body">

            <form method="GET" action="" class="filter-box">
                <div class="row g-3">

                    <div class="col-md-3">
                        <label>Dari Tanggal</label>
                        <input type="date"
                            name="from"
                            value="{{ request('from') }}"
                            class="form-control">
                    </div>

                    <div class="col-md-3">
                        <label>Sampai Tanggal</label>
                        <input type="date"
                            name="to"
                            value="{{ request('to') }}"
                            class="form-control">
                    </div>

                    <div class="col-md-3 d-flex align-items-end gap-2">
                        <button class="btn btn-gold w-100">
                            🔍 Filter
                        </button>

                        <a href="" class="btn btn-dark-custom w-100">
                            Reset
                        </a>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-clean text-center align-middle">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Produk</th>
                            <th>Ukuran</th>
                            <th>Level</th>
                            <th>Tipe</th>
                            <th>Jumlah</th>
                            <th>Keterangan</th>
                            <th>User</th>
                            <th>Jam</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($logStok as $i => $item)
                        <tr>
                            <td>{{ $i + 1 }}</td>

                            <td>
                                {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                            </td>

                            <td class="text-start">
                                <span class="product-name">
                                    {{ $item->produk->nama_produk ?? '-' }}
                                </span>
                            </td>

                            <td>
                                {{ $item->varian->ukuran ?? '-' }}
                            </td>

                            <td>
                                {{ $item->varian->level ?? '-' }}
                            </td>

                            <td>
                                @if($item->tipe == 'masuk')
                                    <span class="badge-masuk">
                                        + Masuk
                                    </span>
                                @else
                                    <span class="badge-keluar">
                                        - Keluar
                                    </span>
                                @endif
                            </td>

                            <td>
                                <strong>
                                    {{ $item->jumlah }}
                                </strong>
                            </td>

                            <td class="text-start">
                                {{ $item->keterangan ?? '-' }}
                            </td>

                            <td>
                                {{ $item->user->name ?? $item->created_by }}
                            </td>

                            <td>
                                {{ \Carbon\Carbon::parse($item->created_at)->format('H:i') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="empty-state">
                                ✨ Belum ada riwayat log stok
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>

@endsection