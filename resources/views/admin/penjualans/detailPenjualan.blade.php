@extends('admin.layouts.main')
@section('title', 'Detail Penjualan')
@section('content')

<div class="lux-wrap">

    <div class="card lux-card">

        <!-- HEADER -->
        <div class="card-header lux-header d-flex justify-content-between align-items-center">
            <h6 class="mb-0 fw-semibold">Detail Penjualan</h6>
            <span class="lux-id">#{{ $checkout->id }}</span>
        </div>

        <div class="card-body p-3">

            <!-- INFO -->
            <div class="mb-3">
                <table class="table table-sm mb-0 lux-table">
                    <tbody>

                        <tr>
                            <th width="30%">Tanggal Pemesanan</th>
                            <td>
                                {{ \Carbon\Carbon::parse($checkout->tanggal_pemesanan)->format('d-m-Y') }}
                            </td>
                        </tr>

                        <tr>
                            <th>User</th>
                            <td>{{ $checkout->user->name }}</td>
                        </tr>

                        <tr>
                            <th>Alamat</th>
                            <td style="white-space: normal;">
                                {{ $checkout->alamat_pengiriman }}
                            </td>
                        </tr>

                        <tr>
                            <th>Metode Pembayaran</th>
                            <td>
                                <span class="badge-soft-purple">
                                    {{ ucfirst($checkout->metode_pembayaran) }}
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <th>Metode Pengiriman</th>
                            <td>
                                @if($checkout->metode_pengiriman == 'delivery')
                                    <span class="badge-soft-blue">Delivery Toko</span>
                                @else
                                    <span class="badge-soft-gray">Ambil di Toko</span>
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <th>Total</th>
                            <td class="text-total">
                                Rp {{ number_format($checkout->total_harga, 0, ',', '.') }}
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

            <!-- DETAIL PRODUK -->
            <div>
                <h6 class="fw-semibold mb-2">Detail Produk</h6>

                <div class="table-responsive">
                    <table class="table table-sm mb-0 lux-table2">

                        <thead>
                            <tr class="text-center">
                                <th width="5%">No</th>
                                <th class="text-start">Produk</th>
                                <th width="10%">Qty</th>
                                <th width="20%">Harga</th>
                                <th width="20%">Total</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php
                                $details = $checkout->produk_details;
                                $subtotal = 0;
                            @endphp

                            @foreach ($details as $index => $detail)
                                @php
                                    $totalItem = $detail['jumlah'] * $detail['harga'];
                                    $subtotal += $totalItem;

                                    // ambil data produk + variannya
                                    $produk = \App\Models\Produk::with('varians')->find($detail['produk_id'] ?? null);

                                    $varian = null;
                                    if ($produk && !empty($detail['varian_id'])) {
                                        $varian = $produk->varians->where('id', $detail['varian_id'])->first();
                                    }
                                @endphp

                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>

                                    <td>
                                        <div class="fw-semibold text-white">{{ $detail['nama'] ?? '-' }}</div>

                                        @if($varian && ($varian->ukuran || $varian->level))
                                            <div class="variant-meta mt-1">
                                                @if($varian->ukuran)
                                                    <span class="variant-badge">Ukuran: {{ $varian->ukuran }}</span>
                                                @endif

                                                @if($varian->level)
                                                    <span class="variant-badge">Level: {{ $varian->level }}</span>
                                                @endif
                                            </div>
                                        @endif
                                    </td>

                                    <td class="text-center">{{ $detail['jumlah'] }}</td>

                                    <td class="text-end">
                                        Rp {{ number_format($detail['harga'], 0, ',', '.') }}
                                    </td>

                                    <td class="text-end fw-semibold">
                                        Rp {{ number_format($totalItem, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                        <tfoot>
                            <tr class="lux-footer">
                                <td colspan="3"></td>
                                <td class="text-end fw-semibold">Total</td>
                                <td class="text-end fw-bold text-green">
                                    Rp {{ number_format($subtotal, 0, ',', '.') }}
                                </td>
                            </tr>
                        </tfoot>

                    </table>
                </div>
            </div>

        </div>
    </div>

</div>

<style>
body {
    background: #000000; /* pure black */
    color: #e5e7eb;
    font-family: 'Inter', sans-serif;
}

/* WRAPPER */
.lux-wrap {
    min-height: 100vh;
    padding: 20px;
    background: #000000;
}

/* CARD LUX - lebih deep black */
.lux-card {
    background: #0a0a0a; /* hampir hitam */
    border: 1px solid rgba(255,255,255,0.06);
    border-radius: 16px;
    box-shadow:
        0 25px 70px rgba(0,0,0,0.9);
    overflow: hidden;
}

/* HEADER lebih gelap */
.lux-header {
    background: #0d0d0d;
    border-bottom: 1px solid rgba(255,255,255,0.06);
    color: #fff;
}

/* TABLE tetap clean tapi lebih kontras */
.lux-table th,
.lux-table2 th {
    color: #9ca3af;
}

.lux-table td,
.lux-table2 td {
    color: #f3f4f6;
}

/* hover lebih soft */
.lux-table2 tbody tr:hover {
    background: rgba(255,255,255,0.03);
}

/* total gold tetap biar luxury pop */
.text-total {
    color: #facc15;
    text-shadow: 0 0 10px rgba(250,204,21,0.2);
}

/* footer lebih hitam */
.lux-footer {
    background: #0b0b0b;
    border-top: 1px solid rgba(255,255,255,0.06);
}
/* ===== GLOBAL SPACING UPGRADE ===== */
.card-body {
    padding: 18px !important;
}

/* ===== TABLE MODERN CLEAN ===== */
.lux-table,
.lux-table2 {
    border-collapse: separate;
    border-spacing: 0 10px; /* bikin float */
}

/* hilangkan garis keras */
.lux-table tr,
.lux-table2 tbody tr {
    background: rgba(255,255,255,0.02);
    border: none !important;
    border-radius: 10px;
}

/* kasih efek card di row */
.lux-table td,
.lux-table th,
.lux-table2 td,
.lux-table2 th {
    border: none !important;
    padding: 12px 14px;
}

/* hover lebih halus */
.lux-table2 tbody tr:hover {
    background: rgba(255,255,255,0.05);
    transform: translateY(-1px);
    transition: .2s;
}

/* ===== LABEL STYLE (BIAR KAYA SHOPEE DETAIL INFO) ===== */
.lux-table th {
    color: #9ca3af;
    font-weight: 500;
    width: 35%;
}

/* VALUE LEBIH MENONJOL */
.lux-table td {
    color: #ffffff;
    font-weight: 500;
}

/* ===== SECTION TITLE ===== */
h6.fw-semibold {
    margin-top: 10px;
    margin-bottom: 12px;
    font-size: 14px;
    color: #ffffff;
    letter-spacing: .3px;
}

/* ===== CARD HEADER LEBIH PREMIUM ===== */
.lux-header {
    padding: 14px 18px;
}

/* ID badge lebih clean */
.lux-id {
    background: rgba(255,255,255,0.06);
    padding: 4px 10px;
    border-radius: 999px;
    color: #facc15;
    font-weight: 600;
}

/* ===== TOTAL BOX (BIAR NGAJAK LIAT) ===== */
.text-total {
    font-size: 14px;
    font-weight: 700;
}

.lux-footer td {
    padding-top: 14px;
    padding-bottom: 14px;
}
.lux-table tr td:first-child,
.lux-table2 tr td:first-child {
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px;
}

.lux-table tr td:last-child,
.lux-table2 tr td:last-child {
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px;
}
</style>

@endsection