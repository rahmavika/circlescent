@extends('admin.layouts.main')
@section('title', 'Data Pesanan')
@section('navAdm', 'active')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">

    <div>
        <h4 class="page-title mb-1 text-white">
            Kelola Pesanan
        </h4>

        <small class="text-white-50">
            Monitoring dan pengelolaan seluruh transaksi pelanggan
        </small>
    </div>

</div>

<div class="container-fluid mt-3">

    <div class="card card-custom">

        @php
            $statusBadge = [
                'pending' => 'badge bg-secondary',
                'diproses' => 'badge bg-warning text-dark',
                'dikirim' => 'badge bg-info text-white',
                'selesai' => 'badge bg-success text-white',
                'dibatalkan' => 'badge bg-danger text-white',
            ];

            $paymentBadge = [
                'belum_lunas' => 'badge bg-danger',
                'lunas' => 'badge bg-success',
            ];

            $currentStatus = request('status', 'pending');

            $statusLabels = [
                'pending' => 'Pending',
                'diproses' => 'Diproses',
                'dikirim' => 'Dikirim',
                'selesai' => 'Selesai',
                'dibatalkan' => 'Dibatalkan'
            ];
        @endphp

        <ul class="nav nav-tabs px-3 pt-2">
            @foreach ($statusLabels as $key => $label)
                <li class="nav-item">
                    <a href="{{ url()->current() }}?status={{ $key }}"
                        class="nav-link {{ $currentStatus == $key ? 'active' : '' }}">
                        {{ $label }}
                    </a>
                </li>
            @endforeach
        </ul>

        <div class="card-header text-white">
            <h6 class="mb-0 fw-semibold text-white">
                Pesanan {{ $statusLabels[$currentStatus] ?? '' }}
            </h6>
        </div>

        <div class="card-body p-2">
            <div class="table-responsive custom-table">
                <table id="pesananTable" class="table table-bordered table-hover align-middle">
                    <thead>
                        <tr class="text-center">
                            <th>Pelanggan & Pesanan</th>
                            <th>Tanggal</th>
                            <th>Bukti</th>
                            <th>Status Bayar</th>
                            <th>Ubah Bayar</th>
                            <th>Cetak</th>
                            <th>Aksi</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php $hasAny = false; @endphp

                        @foreach ($checkouts as $checkout)
                            @if ($checkout->status == $currentStatus)

                                @php $hasAny = true; @endphp

                                <tr>

                                    <td style="min-width:450px;">
                                        <div class="customer-card">
                                            <div class="fw-bold mb-1">
                                                {{ $checkout->nama_pelanggan ?? $checkout->user->name ?? '-' }}
                                            </div>
                                            <div class="text-muted small mb-1">
                                                <i class="bi bi-telephone"></i>
                                                {{ $checkout->phone
                                                    ?? $checkout->no_hp
                                                    ?? $checkout->user->phone
                                                    ?? '-' }}
                                            </div>
                                            <div class="text-muted small mb-2">
                                                <i class="bi bi-geo-alt"></i>
                                                {{ $checkout->alamat_pengiriman }}
                                            </div>
                                            @php
                                                $details = $checkout->produk_details;
                                            @endphp
                                            @foreach($details as $detail)
                                                @php
                                                    $produk = \App\Models\Produk::with(['gambarProduk', 'varians'])
                                                                ->find($detail['produk_id']);

                                                    $gambar = optional($produk->gambarProduk->first())->gambar;

                                                    $varian = $produk->varians->where('id', $detail['varian_id'] ?? null)->first();
                                                @endphp
                                                <div class="border-top pt-2 mt-2">

                                                    <div class="d-flex align-items-center gap-3">

                                                        <img
                                                            src="{{ $gambar ? asset('storage/' . $gambar) : asset('images/no-image.png') }}"
                                                            width="55"
                                                            height="55"
                                                            style="object-fit:cover;border-radius:8px;border:1px solid #eee;"
                                                        >

                                                        <div>

                                                            <div class="fw-semibold">
                                                                {{ $detail['nama'] }}
                                                            </div>

                                                            {{-- VARIAN --}}
                                                            @if($varian)
                                                            <small class="text-muted d-block">

                                                                @if($varian->ukuran)
                                                                    Ukuran: {{ $varian->ukuran }}
                                                                @endif

                                                                @if($varian->level)
                                                                    @if($varian->ukuran) • @endif
                                                                    Level: {{ $varian->level }}
                                                                @endif

                                                            </small>
                                                            @endif

                                                            <small class="text-primary">
                                                                Qty : {{ $detail['jumlah'] }}
                                                            </small>

                                                        </div>

                                                    </div>

                                                </div>
                                            @endforeach
                                        </div>
                                        <hr class="my-2">
                                        <div class="d-flex justify-content-between">
                                            <small class="text-muted">
                                                Total
                                            </small>
                                            <span class="fw-bold text-success">
                                                Rp {{ number_format($checkout->total_harga,0,',','.') }}
                                            </span>
                                        </div>
                                        <div class="d-flex justify-content-between mt-1">
                                            <small class="text-muted">
                                                Pembayaran
                                            </small>
                                            <span class="badge bg-primary">
                                                {{ ucwords(str_replace('_',' ',$checkout->metode_pembayaran)) }}
                                            </span>
                                        </div>
                                        <div class="d-flex justify-content-between mt-1">
                                            <small class="text-muted">
                                                Pengiriman
                                            </small>
                                            @if($checkout->metode_pengiriman == 'ditoko')
                                                <span class="badge bg-secondary">
                                                    Ambil di Toko
                                                </span>
                                            @else
                                                <span class="badge bg-info">
                                                    Delivery
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        {{ \Carbon\Carbon::parse($checkout->created_at)->format('d M Y') }}
                                        <br>

                                        <small class="text-muted">
                                            {{ \Carbon\Carbon::parse($checkout->created_at)->format('H:i') }}
                                        </small>
                                    </td>
                                    <td class="text-center">
                                        @if ($checkout->bukti_transfer)
                                            <img src="{{ asset($checkout->bukti_transfer) }}"
                                                width="70"
                                                class="img-thumbnail"
                                                style="cursor:pointer;"
                                                data-bs-toggle="modal"
                                                data-bs-target="#imageModal{{ $checkout->id }}">
                                        @else
                                            <small class="text-muted">-</small>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <span class="{{ $paymentBadge[$checkout->status_pembayaran] }}">
                                            {{ ucfirst($checkout->status_pembayaran) }}
                                        </span>
                                    </td>
                                    <td>
                                        <form action="{{ route('checkouts.updatePembayaran',$checkout->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <select name="status_pembayaran"
                                                class="form-select form-select-sm"
                                                onchange="this.form.submit()">
                                                <option value="belum_lunas"
                                                    {{ $checkout->status_pembayaran=='belum_lunas'?'selected':'' }}>
                                                    Belum
                                                </option>
                                                <option value="lunas"
                                                    {{ $checkout->status_pembayaran=='lunas'?'selected':'' }}>
                                                    Lunas
                                                </option>
                                            </select>
                                        </form>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('checkouts.detailPaket', $checkout->id) }}"
                                            target="_blank"
                                            class="btn btn-sm btn-outline-dark"
                                            title="Cetak Label Paket">
                                            <i class="bi bi-printer"></i>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <form action="{{ route('checkouts.updateStatus',$checkout->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            @if($checkout->status == 'pending')
                                                @if($checkout->metode_pembayaran == 'cod')
                                                    <button type="submit"
                                                        name="status"
                                                        value="diproses"
                                                        class="btn btn-sm btn-outline-warning"
                                                        onclick="return confirm('Apakah Anda yakin ingin mengubah status dan mengirim WhatsApp ke customer?')">
                                                        Proses
                                                    </button>
                                                    <small class="d-block text-info">
                                                        COD
                                                    </small>
                                                @else
                                                    @if($checkout->status_pembayaran == 'lunas')
                                                        <button type="submit"
                                                            name="status"
                                                            value="diproses"
                                                            class="btn btn-sm btn-outline-warning"
                                                            onclick="return confirm('Apakah Anda yakin ingin mengubah status dan mengirim WhatsApp ke customer?')">
                                                            Proses
                                                        </button>
                                                    @else
                                                        <button class="btn btn-sm btn-secondary"
                                                            disabled>
                                                            Menunggu Bayar
                                                        </button>
                                                        <small class="d-block text-danger">
                                                            Belum diverifikasi
                                                        </small>
                                                    @endif
                                                @endif
                                            @elseif($checkout->status == 'diproses')
                                                @if($checkout->metode_pengiriman == 'delivery')
                                                    <button type="submit"
                                                        name="status"
                                                        value="dikirim"
                                                        class="btn btn-sm btn-outline-primary"
                                                        onclick="return confirm('Apakah Anda yakin ingin mengubah status dan mengirim WhatsApp ke customer?')">
                                                        Kirim
                                                    </button>
                                                @else
                                                    <button type="submit"
                                                        name="status"
                                                        value="selesai"
                                                        class="btn btn-sm btn-outline-success"
                                                        onclick="return confirm('Apakah Anda yakin ingin mengubah status dan mengirim WhatsApp ke customer?')">
                                                        Selesai
                                                    </button>
                                                @endif
                                            @elseif($checkout->status == 'dikirim')
                                                <button type="submit"
                                                    name="status"
                                                    value="selesai"
                                                    class="btn btn-sm btn-outline-success"
                                                    onclick="return confirm('Apakah Anda yakin ingin mengubah status dan mengirim WhatsApp ke customer?')">
                                                    Selesai
                                                </button>
                                            @endif
                                        </form>
                                        @if(!in_array($checkout->status, ['selesai', 'dibatalkan']))
                                            <form action="{{ url('/admin/checkout/batal/'.$checkout->id) }}"
                                                method="POST"
                                                style="display:inline;">
                                                @csrf

                                                <button type="submit"
                                                    class="btn btn-sm btn-outline-danger mt-1"
                                                    onclick="return confirm('Batalkan pesanan ini?')">
                                                    Batalkan
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <span class="{{ $statusBadge[$checkout->status] }}">
                                            {{ ucfirst(str_replace('_',' ', $checkout->status)) }}
                                        </span>
                                    </td>
                                </tr>
                                <div class="modal fade" id="imageModal{{ $checkout->id }}">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content bg-transparent border-0">
                                            <div class="text-end">
                                                <button class="btn-close bg-white p-2 m-2" data-bs-dismiss="modal"></button>
                                            </div>
                                            <img src="{{ asset($checkout->bukti_transfer) }}"
                                                class="img-fluid rounded shadow">
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach

                        @if(!$hasAny)

                        <tr>
                            <td colspan="11" class="text-center text-muted">
                                Tidak ada data
                            </td>
                        </tr>

                        @endif

                    </tbody>

                </table>
            </div>
        </div>
    </div>

</div>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    rel="stylesheet">

    <style>
        body{
            background:#f6f7f9;
            color:#1f2937;
            font-size:13px;
        }

        /* PAGE */
        .page-title{
            color:#111827;
            font-weight:700;
            font-size:22px;
            letter-spacing:.3px;
        }

        .text-muted{
            color:#9ca3af !important;
        }

        /* CARD */
        .card-custom{
            background:#232323;
            border:1px solid #3a3a3a;
            border-radius:18px;
            overflow:hidden;
            box-shadow:0 10px 25px rgba(0,0,0,.12);
        }

        .card-header{
            background:#232323;
            border-bottom:1px solid #3a3a3a;
            padding:16px 20px;
            color:#fff;
        }

        /* TABS */
        .nav-tabs{
            background:#232323;
            border-bottom:1px solid #3a3a3a;
        }

        .nav-tabs .nav-link{
            border:none;
            color:#bdbdbd;
            font-weight:500;
            padding:12px 18px;
            transition:.25s;
        }

        .nav-tabs .nav-link:hover{
            color:#fff;
        }

        .nav-tabs .nav-link.active{
            background:transparent;
            color:#fff;
            border:none;
            border-bottom:3px solid #fff;
            font-weight:600;
        }

        /* TABLE */
        .custom-table{
            border-radius:14px;
        }

        .table{
            margin-bottom:0;
            vertical-align:middle;
        }

        .table thead th{
            background:#2b2b2b;
            color:#fff;
            border-color:#3a3a3a;
            font-size:12px;
            font-weight:700;
            padding:14px;
            white-space:nowrap;
            text-transform:uppercase;
            letter-spacing:.5px;
        }

        .table tbody td{
            background:#232323;
            color:#f3f4f6;
            border-color:#3a3a3a;
            padding:14px;
        }

        .table tbody tr{
            transition:.2s;
        }

        .table tbody tr:hover td{
            background:#2d2d2d;
        }

        /* CUSTOMER CARD */
        .customer-card{
            background:#2b2b2b;
            border:1px solid #404040;
            border-radius:14px;
            padding:14px;
            line-height:1.6;
        }

        .customer-card .fw-bold{
            color:#fff;
            font-size:15px;
        }

        .customer-card .text-muted{
            color:#d1d5db !important;
            font-size:12px;
        }

        .customer-card .border-top{
            border-color:#404040 !important;
        }

        .customer-name{
            color:#fff;
            font-weight:600;
        }

        .customer-phone{
            color:#d1d5db;
            font-size:12px;
        }

        /* PRODUCT IMAGE */
        .customer-card img{
            border-radius:10px;
            border:1px solid #404040;
            object-fit:cover;
            background:#1f1f1f;
        }

        /* BADGES */
        .badge{
            border-radius:30px;
            padding:7px 12px;
            font-size:11px;
            font-weight:600;
        }

        .bg-primary{
            background:#ffffff !important;
            color:#232323 !important;
        }

        .bg-secondary{
            background:#525252 !important;
            color:#fff !important;
        }

        .bg-info{
            background:#374151 !important;
            color:#fff !important;
        }

        .bg-success{
            background:#16a34a !important;
            color:#fff !important;
        }

        .bg-danger{
            background:#dc2626 !important;
            color:#fff !important;
        }

        /* TOTAL */
        .total-price{
            color:#fff;
            font-weight:700;
            font-size:14px;
        }

        /* BUTTON */
        .btn{
            border-radius:10px;
            font-size:12px;
        }

        .btn-outline-dark{
            border-color:#fff;
            color:#fff;
        }

        .btn-outline-dark:hover{
            background:#fff;
            color:#232323;
        }

        .btn-outline-warning:hover,
        .btn-outline-primary:hover,
        .btn-outline-success:hover{
            color:#fff;
        }

        /* SELECT */
        .form-select,
        .form-select-sm{
            border-radius:10px;
            border:1px solid #404040;
            background:#2b2b2b;
            color:#fff;
        }

        .form-select:focus,
        .form-select-sm:focus{
            border-color:#fff;
            box-shadow:none;
            background:#2b2b2b;
            color:#fff;
        }

        /* IMAGE */
        .img-thumbnail{
            border-radius:10px;
            border:1px solid #404040;
            background:#1f1f1f;
            transition:.25s;
        }

        .img-thumbnail:hover{
            transform:scale(1.05);
        }

        /* MODAL */
        .modal-content{
            background:#2b2b2b;
            border:1px solid #404040;
            border-radius:18px;
            color:#fff;
        }

        /* SCROLLBAR */
        .table-responsive::-webkit-scrollbar{
            height:8px;
        }

        .table-responsive::-webkit-scrollbar-thumb{
            background:#6b7280;
            border-radius:10px;
        }

        /* PAGINATION */
        .pagination .page-link{
            background:#232323;
            color:#fff;
            border:1px solid #404040;
            margin:0 3px;
            border-radius:10px;
        }

        .pagination .page-link:hover{
            background:#2d2d2d;
        }

        .pagination .active .page-link{
            background:#fff;
            color:#232323;
            border-color:#fff;
        }

        /* HR */
        hr{
            border-color:#404040;
            opacity:1;
        }

        /* ICON */
        .bi{
            margin-right:4px;
        }
        /* =========================
   DATATABLES DARK THEME
========================= */

/* wrapper atas & bawah */
.dataTables_wrapper,
.dt-container{
    color:#f3f4f6 !important;
    font-size:13px;
}

/* bagian show entries + search */
.dataTables_wrapper .dataTables_length,
.dataTables_wrapper .dataTables_filter,
.dataTables_wrapper .dataTables_info,
.dataTables_wrapper .dataTables_paginate{
    color:#f3f4f6 !important;
    margin-bottom:10px;
}

/* label */
.dataTables_wrapper .dataTables_length label,
.dataTables_wrapper .dataTables_filter label{
    color:#f3f4f6 !important;
    font-weight:500;
}

/* input search */
.dataTables_wrapper .dataTables_filter input,
div.dataTables_wrapper div.dataTables_filter input,
.dataTables_filter input.form-control,
div.dt-container .dt-search input{
    background:#2b2b2b !important;
    border:1px solid #404040 !important;
    color:#fff !important;
    border-radius:10px !important;
    padding:8px 12px !important;
    outline:none !important;
    box-shadow:none !important;
}

.dataTables_wrapper .dataTables_filter input:focus,
div.dataTables_wrapper div.dataTables_filter input:focus,
div.dt-container .dt-search input:focus{
    border-color:#fff !important;
    box-shadow:0 0 0 0.15rem rgba(255,255,255,.08) !important;
    background:#2b2b2b !important;
    color:#fff !important;
}

/* placeholder search */
.dataTables_wrapper .dataTables_filter input::placeholder,
div.dt-container .dt-search input::placeholder{
    color:#9ca3af !important;
}

/* dropdown show entries */
.dataTables_wrapper .dataTables_length select,
div.dataTables_wrapper div.dataTables_length select,
div.dt-container .dt-length select{
    background:#2b2b2b !important;
    border:1px solid #404040 !important;
    color:#fff !important;
    border-radius:10px !important;
    padding:6px 34px 6px 12px !important;
    min-width:80px;
    box-shadow:none !important;
    outline:none !important;
}

.dataTables_wrapper .dataTables_length select:focus,
div.dt-container .dt-length select:focus{
    border-color:#fff !important;
    box-shadow:0 0 0 0.15rem rgba(255,255,255,.08) !important;
}

/* option di dropdown */
.dataTables_wrapper .dataTables_length select option,
div.dt-container .dt-length select option{
    background:#232323 !important;
    color:#fff !important;
}

/* tulisan info bawah */
.dataTables_wrapper .dataTables_info,
div.dt-container .dt-info{
    color:#d1d5db !important;
    padding-top:12px !important;
    font-size:12px !important;
}

/* pagination container */
.dataTables_wrapper .dataTables_paginate,
div.dt-container .dt-paging{
    padding-top:8px !important;
}

/* tombol pagination */
.dataTables_wrapper .paginate_button,
.dataTables_wrapper .paginate_button.current,
.dataTables_wrapper .paginate_button.disabled,
div.dt-container .dt-paging .dt-paging-button{
    background:#232323 !important;
    color:#fff !important;
    border:1px solid #404040 !important;
    border-radius:10px !important;
    margin:0 3px !important;
    min-width:38px;
    padding:7px 12px !important;
    transition:.2s ease;
    box-shadow:none !important;
}

/* hover pagination */
.dataTables_wrapper .paginate_button:hover,
div.dt-container .dt-paging .dt-paging-button:hover{
    background:#2d2d2d !important;
    color:#fff !important;
    border-color:#5a5a5a !important;
}

/* tombol aktif */
.dataTables_wrapper .paginate_button.current,
.dataTables_wrapper .paginate_button.current:hover,
div.dt-container .dt-paging .dt-paging-button.current{
    background:#fff !important;
    color:#232323 !important;
    border-color:#fff !important;
    font-weight:700;
}

/* disabled */
.dataTables_wrapper .paginate_button.disabled,
.dataTables_wrapper .paginate_button.disabled:hover,
div.dt-container .dt-paging .dt-paging-button.disabled{
    opacity:.45 !important;
    cursor:not-allowed !important;
}

/* hilangkan background biru bawaan datatables */
.dataTables_wrapper .paginate_button.current:focus,
.dataTables_wrapper .paginate_button:focus,
div.dt-container .dt-paging .dt-paging-button:focus{
    box-shadow:none !important;
    outline:none !important;
}

/* sorting arrow header biar terlihat */
table.dataTable thead th.sorting,
table.dataTable thead th.sorting_asc,
table.dataTable thead th.sorting_desc,
table.dataTable thead td.sorting,
table.dataTable thead td.sorting_asc,
table.dataTable thead td.sorting_desc{
    position:relative;
    padding-right:30px !important;
}

/* line antara top tools dan table */
.dataTables_wrapper .row:first-child{
    margin-bottom:12px;
}

.dataTables_wrapper .row:last-child{
    margin-top:14px;
}

/* kalau pakai bootstrap form-select datatables */
div.dataTables_wrapper div.dataTables_length select.form-select,
div.dataTables_wrapper div.dataTables_filter input.form-control{
    background-color:#2b2b2b !important;
    color:#fff !important;
    border:1px solid #404040 !important;
}

/* biar text "Search:" & "Show _ entries" tidak hitam */
div.dataTables_wrapper div.dataTables_length,
div.dataTables_wrapper div.dataTables_filter,
div.dataTables_wrapper div.dataTables_info,
div.dataTables_wrapper div.dataTables_paginate{
    color:#f3f4f6 !important;
}

/* responsif spacing */
@media (max-width: 768px){
    .dataTables_wrapper .dataTables_filter{
        margin-top:10px;
        text-align:left !important;
    }

    .dataTables_wrapper .dataTables_filter input{
        width:100% !important;
        margin-left:0 !important;
    }

    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter,
    .dataTables_wrapper .dataTables_info,
    .dataTables_wrapper .dataTables_paginate{
        text-align:left !important;
    }
}
    </style>
<script>
    function cetakPaket(url) {
        let win = window.open(url, '_blank');

        win.onload = function () {
            win.print();
        };
    }
</script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function () {
        $('#pesananTable').DataTable({
            paging: true,
            searching: true,
            ordering: true,
            info: true,
            responsive: true,
            pageLength: 10,
            lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                infoEmpty: "Tidak ada data",
                zeroRecords: "Data tidak ditemukan",
                paginate: {
                    first: "Awal",
                    last: "Akhir",
                    next: "›",
                    previous: "‹"
                }
            }
        });
    });
</script>
@endsection
