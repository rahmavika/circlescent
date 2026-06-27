@extends('admin.layouts.main')
@section('content')

<style>
    :root {
        --gold: #d4af37;
        --gold-soft: #f0d67a;
        --dark: #0f0f0f;
        --dark-card: #181818;
        --dark-soft: #202020;
        --border-gold: rgba(212, 175, 55, 0.15);
    }

    /* CARD */
    .mutasi-detail-card {
        background: linear-gradient(145deg, #181818, #111111);
        border-radius: 28px;
        border: 1px solid rgba(255,255,255,.04);
        overflow: hidden;
        box-shadow: 0 20px 50px rgba(0,0,0,.25);
    }

    /* HEADER */
    .mutasi-header {
        background:
            linear-gradient(to right,
                rgba(212,175,55,.10),
                transparent);
        border-bottom: 1px solid rgba(212,175,55,.12);
        padding: 22px 30px;
    }

    .mutasi-title {
        color: #fff;
        font-weight: 700;
        margin: 0;
    }

    .mutasi-title span {
        color: var(--gold);
    }

    /* BUTTON BACK */
    .btn-back {
        background: rgba(255,255,255,.04);
        border: 1px solid rgba(255,255,255,.06);
        color: #d8d8d8;
        border-radius: 14px;
        padding: 10px 18px;
        transition: .3s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-weight: 500;
    }

    .btn-back:hover {
        background: rgba(212,175,55,.12);
        border-color: rgba(212,175,55,.25);
        color: var(--gold);
        transform: translateY(-2px);
    }

    /* TABLE */
    .table-mutasi {
        margin-bottom: 0;
        color: #fff;
        border-collapse: separate;
        border-spacing: 0;
    }

    .table-mutasi thead {
        background: rgba(212,175,55,.08);
    }

    .table-mutasi thead th {
        color: var(--gold);
        border: none;
        padding: 18px;
        font-weight: 600;
        white-space: nowrap;
    }

    .table-mutasi tbody tr {
        border-bottom: 1px solid rgba(255,255,255,.05);
        transition: .3s ease;
    }

    .table-mutasi tbody tr:hover {
        background: rgba(212,175,55,.05);
    }

    .table-mutasi tbody td {
        border: none;
        padding: 20px 18px;
        vertical-align: middle;
        color: #e8e8e8;
        font-weight: 500;
    }

    .table-mutasi tbody tr:nth-child(even) {
        background: rgba(255,255,255,.015);
    }

    /* nomor */
    .table-mutasi tbody td:first-child {
        color: #9e9e9e;
    }

    /* nama produk */
    .product-name {
        color: #fff !important;
        font-weight: 600;
    }

    /* badge stok akhir */
    .stok-badge {
        background: rgba(212,175,55,.15);
        color: var(--gold);
        padding: 8px 16px;
        border-radius: 12px;
        font-weight: 700;
        display: inline-block;
        min-width: 60px;
    }

    /* empty state */
    .empty-state {
        color: #8d8d8d;
        padding: 50px 0;
    }

</style>

<div class="container-fluid mt-4">

    <div class="mutasi-detail-card">

        {{-- HEADER --}}
        <div class="mutasi-header d-flex justify-content-between align-items-center flex-wrap gap-3">

            <div>
                <h4 class="mutasi-title">
                    Laporan Mutasi Stok -
                    <span>
                        {{ \Carbon\Carbon::createFromDate(null, $bulan)->locale('id')->monthName }}
                        {{ $tahun }}
                    </span>
                </h4>
            </div>

            <a href="{{ route('mutasistoks.index') }}"
                class="btn-back">

                <i class="bi bi-arrow-left"></i>
                Kembali
            </a>

        </div>

        {{-- TABLE --}}
        <div class="p-4">

            <div class="table-responsive">
                <table class="table table-mutasi text-center align-middle">

                    <thead>
                        <tr>
                            <th style="width: 60px;">No</th>
                            <th class="text-start">
                                Nama Produk
                            </th>
                            <th>Stok Awal</th>
                            <th>Stok Masuk</th>
                            <th>Stok Keluar</th>
                            <th>Stok Akhir</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($dataMutasi as $index => $item)
                            <tr>
                                <td>
                                    {{ $index + 1 }}
                                </td>

                                <td class="text-start product-name">
                                    {{ $item->nama_produk }}
                                </td>

                                <td>
                                    {{ $item->stok_awal }}
                                </td>

                                <td>
                                    {{ $item->masuk }}
                                </td>

                                <td>
                                    {{ $item->keluar }}
                                </td>

                                <td>
                                    <span class="stok-badge">
                                        {{ $item->stok_akhir }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6"
                                    class="text-center empty-state">

                                    Tidak ada data mutasi stok untuk periode ini.
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