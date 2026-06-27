@extends('admin.layouts.main')
@section('content')

<style>
    :root {
        --gold: #d4af37;
        --gold-soft: #f0d67a;
        --dark: #0f0f0f;
        --dark-card: #181818;
        --dark-soft: #242424;
        --border-gold: rgba(212, 175, 55, 0.2);
    }

    body {
        background: #0b0b0b;
    }

    /* HEADER */
    .mutasi-header {
        background: linear-gradient(145deg, #181818, #111111);
        border: 1px solid var(--border-gold);
        border-radius: 24px;
        overflow: hidden;
        position: relative;
    }

    .mutasi-header::before {
        content: '';
        position: absolute;
        top: -50px;
        right: -50px;
        width: 180px;
        height: 180px;
        background: radial-gradient(circle,
                rgba(212, 175, 55, 0.15),
                transparent 70%);
    }

    .mutasi-title {
        color: #fff;
        font-weight: 700;
    }

    .mutasi-subtitle {
        color: #9d9d9d;
    }

    .icon-box {
        width: 70px;
        height: 70px;
        border-radius: 20px;
        background: rgba(212, 175, 55, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid rgba(212, 175, 55, 0.25);
    }

    .icon-box i {
        color: var(--gold);
        font-size: 2rem;
    }

    /* CARD */
    .custom-card {
        background: var(--dark-card);
        border-radius: 24px;
        border: 1px solid rgba(255,255,255,.05);
        overflow: hidden;
    }

    /* BUTTON */
    .btn-gold {
        background: linear-gradient(135deg, #c9a227, #f0d67a);
        border: none;
        color: #111;
        border-radius: 14px;
        font-weight: 600;
        transition: .3s;
    }

    .btn-gold:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(212,175,55,.25);
        color: #111;
    }

    .btn-detail {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        background: rgba(212,175,55,.15);
        border: 1px solid rgba(212,175,55,.2);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: var(--gold);
        transition: .3s;
    }

    .btn-detail:hover {
        background: var(--gold);
        color: #111;
        transform: scale(1.05);
    }

/* TABLE */
.table-dark-custom {
    margin-bottom: 0;
    border-collapse: separate;
    border-spacing: 0;
}

.table-dark-custom thead {
    background: rgba(212,175,55,.08);
}

.table-dark-custom thead th {
    border: none;
    color: var(--gold);
    font-weight: 600;
    padding: 18px;
    white-space: nowrap;
}

/* FIX TBODY */
.table-dark-custom tbody tr {
    border-bottom: 1px solid rgba(255,255,255,.06);
    transition: .3s ease;
    color: #f5f5f5; /* bikin teks terang */
}

.table-dark-custom tbody tr:hover {
    background: rgba(212,175,55,.05);
}

.table-dark-custom td {
    border: none;
    padding: 20px 18px;
    vertical-align: middle;
    color: #e8e8e8 !important; /* fix isi tbody */
    font-weight: 500;
}

/* nomor row */
.table-dark-custom td:first-child {
    color: #9f9f9f !important;
}

/* bulan */
.table-dark-custom td:nth-child(2) {
    color: #ffffff !important;
    font-weight: 600;
}

/* angka stok */
.table-dark-custom td:nth-child(3),
.table-dark-custom td:nth-child(4),
.table-dark-custom td:nth-child(5),
.table-dark-custom td:nth-child(6),
.table-dark-custom td:nth-child(7) {
    color: #f2f2f2 !important;
    font-weight: 600;
}

/* zebra luxury */
.table-dark-custom tbody tr:nth-child(even) {
    background: rgba(255,255,255,.015);
}

    /* MODAL */
    .modal-content {
        background: #181818;
        border-radius: 24px;
        border: 1px solid rgba(212,175,55,.15);
        color: #fff;
    }

    .modal-header {
        border-bottom: 1px solid rgba(255,255,255,.05);
    }

    .modal-footer {
        border-top: 1px solid rgba(255,255,255,.05);
    }

    .form-control {
        background: #111;
        border: 1px solid rgba(255,255,255,.08);
        color: white;
        border-radius: 14px;
    }

    .form-control:focus {
        border-color: var(--gold);
        box-shadow: 0 0 0 .2rem rgba(212,175,55,.2);
        background: #111;
        color: white;
    }

    .nav-tabs {
        border-bottom: none;
    }

    .nav-tabs .nav-link {
        border: none;
        color: #aaa;
        border-radius: 12px;
        background: #111;
        margin-right: 8px;
    }

    .nav-tabs .nav-link.active {
        background: rgba(212,175,55,.15);
        color: var(--gold);
    }
    /* FORM INPUT SAJA */
#bulanMutasi,
#fromMutasi,
#toMutasi,
.flatpickr-input[readonly] {
    background: #111 !important;
    color: #fff !important;
    border: 1px solid rgba(255,255,255,.08) !important;
    border-radius: 18px !important;
    min-height: 54px;
    padding: 14px 18px;
    opacity: 1 !important;
}

/* focus */
#bulanMutasi:focus,
#fromMutasi:focus,
#toMutasi:focus,
.flatpickr-input[readonly]:focus {
    background: #181818 !important;
    border-color: #d4af37 !important;
    box-shadow: 0 0 0 .2rem rgba(212,175,55,.18) !important;
    color: #fff !important;
}

/* placeholder */
#bulanMutasi::placeholder,
#fromMutasi::placeholder,
#toMutasi::placeholder {
    color: #8f8f8f !important;
}

</style>

{{-- HEADER --}}
<div class="card border-0 shadow-sm mb-4 mutasi-header">
    <div class="card-body d-flex justify-content-between align-items-center p-4">
        <div>
            <h3 class="mutasi-title mb-1">
                Mutasi Stok
            </h3>
            <small class="mutasi-subtitle">
                Pantau perpindahan dan perubahan stok barang
            </small>
        </div>

        <div class="icon-box">
            <i class="bi bi-arrow-left-right"></i>
        </div>
    </div>
</div>

<div class="container-fluid px-0">
    <div class="custom-card shadow-lg">
        <div class="card-body p-4">

            {{-- BUTTON CETAK --}}
            <div class="d-flex justify-content-end mb-4">
                <button
                    class="btn btn-gold d-flex align-items-center gap-2 px-4 py-3 shadow"
                    data-bs-toggle="modal"
                    data-bs-target="#modalCetakMutasi">

                    <i class="bi bi-printer-fill"></i>
                    Cetak Laporan Mutasi
                </button>
            </div>

            {{-- TABLE --}}
            <div class="table-responsive">
                <table class="table table-dark-custom text-center align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Bulan</th>
                            <th>Jumlah Produk</th>
                            <th>Stok Awal</th>
                            <th>Stok Masuk</th>
                            <th>Stok Keluar</th>
                            <th>Stok Akhir</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($periodeList as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->nama_bulan }}</td>
                                <td>{{ $item->jumlah_produk }}</td>
                                <td>{{ $item->stok_awal }}</td>
                                <td>{{ $item->stok_masuk }}</td>
                                <td>{{ $item->stok_keluar }}</td>
                                <td>
                                    <span class="badge px-3 py-2"
                                        style="background: rgba(212,175,55,.15); color:#d4af37;">
                                        {{ $item->stok_akhir }}
                                    </span>
                                </td>

                                <td>
                                    <a href="{{ route('mutasistoks.show', [$item->bulan, $item->tahun]) }}"
                                        class="btn-detail">

                                        <i class="bi bi-eye-fill"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5 text-secondary">
                                    Tidak ada data mutasi stok
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

{{-- MODAL --}}
<div class="modal fade" id="modalCetakMutasi" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3">

            <form action="{{ route('mutasistoks.cetak') }}" method="GET" target="_blank">

                <input type="hidden" name="filter" id="filterTypeMutasi" value="bulan">

                <div class="modal-header border-0">
                    <h5 class="fw-bold">
                        Cetak Laporan Mutasi
                    </h5>

                    <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal">
                    </button>
                </div>

                <div class="modal-body">

                    <ul class="nav nav-tabs mb-4">
                        <li class="nav-item">
                            <button
                                type="button"
                                class="nav-link active"
                                data-bs-toggle="tab"
                                data-bs-target="#bulan-mutasi">

                                Per Bulan
                            </button>
                        </li>

                        <li class="nav-item">
                            <button
                                type="button"
                                class="nav-link"
                                data-bs-toggle="tab"
                                data-bs-target="#tanggal-mutasi">

                                Rentang Tanggal
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content">

                        <div class="tab-pane fade show active" id="bulan-mutasi">
                            <label class="mb-2 text-light">
                                Pilih Bulan
                            </label>

                            <input
                                type="text"
                                id="bulanMutasi"
                                name="bulan"
                                class="form-control"
                                placeholder="Pilih bulan">
                        </div>

                        <div class="tab-pane fade" id="tanggal-mutasi">
                            <div class="mb-3">
                                <label>Dari Tanggal</label>
                                <input type="text"
                                    id="fromMutasi"
                                    name="from"
                                    class="form-control">
                            </div>

                            <div>
                                <label>Sampai Tanggal</label>
                                <input type="text"
                                    id="toMutasi"
                                    name="to"
                                    class="form-control">
                            </div>
                        </div>

                    </div>

                </div>

                <div class="modal-footer border-0">
                    <button type="submit" class="btn btn-gold px-4 py-2">
                        <i class="bi bi-printer me-1"></i>
                        Cetak
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection

@push('scripts')

<link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/style.css">

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/index.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const bulanInput = document.querySelector('input[name="bulan"]');
        const fromInput = document.querySelector('#fromMutasi');
        const toInput = document.querySelector('#toMutasi');
        const filterType = document.getElementById('filterTypeMutasi');

        // ===== TAB REQUIRED =====
        function setRequired(tab) {

            if (tab === 'bulan') {

                bulanInput.required = true;

                fromInput.required = false;
                toInput.required = false;

                fromInput.value = '';
                toInput.value = '';

                filterType.value = 'bulan';

            } else {

                bulanInput.required = false;

                fromInput.required = true;
                toInput.required = true;

                bulanInput.value = '';

                filterType.value = 'tanggal';
            }
        }

        // Default tab
        setRequired('bulan');

        // Event tab switch
        document.querySelectorAll('[data-bs-toggle="tab"]')
            .forEach(tab => {

                tab.addEventListener('shown.bs.tab', function (e) {

                    const target =
                        e.target.getAttribute('data-bs-target');

                    if (target === '#bulan-mutasi') {
                        setRequired('bulan');
                    } else {
                        setRequired('tanggal');
                    }
                });

            });

        // ===== FLATPICKR TANGGAL =====
        const toPicker = flatpickr("#toMutasi", {
            dateFormat: "Y-m-d",
            maxDate: "today"
        });

        flatpickr("#fromMutasi", {
            dateFormat: "Y-m-d",
            maxDate: "today",

            onChange: function(selectedDates) {

                if (selectedDates.length > 0) {

                    let minDate =
                        new Date(selectedDates[0]);

                    toPicker.set(
                        'minDate',
                        minDate
                    );
                }
            }
        });

        flatpickr("#bulanMutasi", {
            plugins: [
                new monthSelectPlugin({
                    shorthand: true,
                    dateFormat: "Y-m",
                    altFormat: "F Y"
                })
            ],

            dateFormat: "Y-m",
            altInput: true,
            allowInput: false
        });

    });
</script>

@endpush