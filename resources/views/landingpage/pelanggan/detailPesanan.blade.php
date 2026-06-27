@extends('landingpage.layouts.main')
@section('content')

<section class="invoice-wrap">

    <div id="invoiceArea" class="invoice">

        <!-- HEADER -->
        <div class="invoice-header">

            <div>
                <div class="brand">CIRCLE SCENT</div>
                <div class="sub">
                    Tebet, Jakarta Selatan, Indonesia  <br>
                    08138251880
                </div>
            </div>

            <div class="text-right">
                <div class="title">INVOICE</div>
                <div class="sub">
                    No: {{ $checkout->id }} <br>
                    {{ \Carbon\Carbon::parse($checkout->tanggal_pemesanan)->format('d M Y') }}
                </div>
            </div>

        </div>

        <div class="line"></div>

        <!-- CUSTOMER -->
        <div class="section">
            <div class="section-title">DATA PELANGGAN</div>

            <div class="grid">
                <div>Nama</div>
                <div>{{ $checkout->user->name ?? '-' }}</div>

                <div>No HP</div>
                <div>{{ $checkout->user->phone ?? '-' }}</div>

                <div>Alamat</div>
                <div>{{ $checkout->alamat_pengiriman }}</div>
            </div>
        </div>

        <div class="line"></div>

        <!-- PRODUCT -->
        <div class="section">
            <div class="section-title">DETAIL PESANAN</div>

            <table class="table">
                <thead>
                    <tr>
                        <th>PRODUK</th>
                        <th>VARIAN</th>
                        <th>QTY</th>
                        <th>HARGA</th>
                        <th>TOTAL</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($produkDetails as $produk)
                    <tr>

                        <!-- PRODUK -->
                        <td>
                            <div class="product">

                                @php
                                    $urlGambar = !empty($produk['gambar'])
                                        ? asset('storage/' . $produk['gambar'])
                                        : asset('images/no-image.png');
                                @endphp

                                <img src="{{ $urlGambar }}">
                                <span>{{ $produk['nama'] }}</span>
                            </div>
                        </td>

                        <td>
                            @php
                            $varian = \App\Models\Varian::find($produk['varian_id'] ?? null);
                            @endphp

                            @if($varian)
                                <div class="product-varian">
                                    {{ $varian->level }}
                                    @if($varian->ukuran)
                                        • {{ $varian->ukuran }}
                                    @endif
                                </div>
                            @else
                                <span style="color:#999;">-</span>
                            @endif
                        </td>

                        <!-- QTY -->
                        <td>{{ $produk['jumlah'] }}</td>

                        <!-- HARGA -->
                        <td>
                            Rp {{ number_format($produk['harga'],0,',','.') }}
                        </td>

                        <!-- TOTAL -->
                        <td class="bold">
                            Rp {{ number_format($produk['total'],0,',','.') }}
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- TOTAL PESANAN (SHOPEE STYLE) -->
            <div class="order-summary">
                <div class="summary-row">
                    <span>Subtotal Produk</span>
                    <span>Rp {{ number_format($totalHargaAkhir,0,',','.') }}</span>
                </div>

                <div class="summary-row">
                    <span>Ongkir</span>
                    <span>Rp 0</span>
                </div>

                <div class="summary-row bold-total">
                    <span>Total Pesanan</span>
                    <span>Rp {{ number_format($totalHargaAkhir,0,',','.') }}</span>
                </div>
            </div>

        </div>

        <div class="line"></div>

        <!-- STATUS -->
        <div class="section">
            <div class="section-title">STATUS</div>

            <div class="status-row">
                <span>Status Pesanan</span>
                <span>{{ ucfirst(str_replace('_',' ', $checkout->status)) }}</span>
            </div>

            <div class="status-row">
                <span>Pembayaran</span>
                <span>{{ ucfirst($checkout->status_pembayaran) }}</span>
            </div>

            <div class="status-row">
                <span>Metode</span>
                <span>{{ ucfirst($checkout->metode_pembayaran) }}</span>
            </div>

            <div class="status-row">
                <span>Pengiriman</span>
                <span>
                    {{ $checkout->metode_pengiriman == 'ditoko' ? 'Ambil di Toko' : 'Delivery' }}
                </span>
            </div>
        </div>
        @if(strtolower($checkout->metode_pembayaran) === 'transfer')
        <div class="rekening-box">

            <div class="rekening-card">
                <div class="rekening-title">BANK MANDIRI</div>

                <div class="rekening-item">
                    <span>No Rekening</span>
                    <strong>1260004932561</strong>
                </div>

                <div class="rekening-item">
                    <span>Atas Nama</span>
                    <strong>NOFRI ANDI</strong>
                </div>
            </div>

            <div class="rekening-card">
                <div class="rekening-title">BANK BCA</div>

                <div class="rekening-item">
                    <span>No Rekening</span>
                    <strong>4760200307</strong>
                </div>

                <div class="rekening-item">
                    <span>Atas Nama</span>
                    <strong>RIJAL GOJALI</strong>
                </div>
            </div>

        </div>
        @endif
        <!-- TIMELINE -->
        <div class="section">
            <div class="section-title">RIWAYAT WAKTU</div>

            <div class="timeline">

                <div class="timeline-row">
                    <span class="t-label">Waktu Pemesanan</span>
                    <span class="t-value">
                        {{ \Carbon\Carbon::parse($checkout->tanggal_pemesanan)->format('d M Y, H:i') }}
                    </span>
                </div>

                <div class="timeline-row">
                    <span class="t-label">Waktu Pembayaran</span>
                    <span class="t-value">
                        {{ $checkout->waktu_pembayaran
                            ? \Carbon\Carbon::parse($checkout->waktu_pembayaran)->format('d M Y, H:i')
                            : '-' }}
                    </span>
                </div>

                <div class="timeline-row">
                    <span class="t-label">Waktu Pengiriman</span>
                    <span class="t-value">
                        {{ $checkout->waktu_pengiriman
                            ? \Carbon\Carbon::parse($checkout->waktu_pengiriman)->format('d M Y, H:i')
                            : '-' }}
                    </span>
                </div>

            </div>
        </div>

    </div>

</section>

<style>
    /* ==========================
       PREMIUM PERFUME THEME
    ========================== */

    body{
        background: linear-gradient(
            180deg,
            #000000 0%,
            #111111 50%,
            #000000 100%
        );
        font-family: "Segoe UI", sans-serif;
    }

    /* WRAPPER */
    .invoice-wrap{
        display:flex;
        justify-content:center;
        padding:0 15px 50px;
        margin-top:120px;
    }

    /* INVOICE CARD */
    .invoice{
        width:100%;
        max-width:900px;
        background:#fff;
        border:none;
        border-radius:20px;
        padding:35px;
        box-shadow:
            0 20px 50px rgba(0,0,0,.45),
            0 0 30px rgba(255,255,255,.04);
    }

    /* HEADER */
    .invoice-header{
        display:flex;
        justify-content:space-between;
        align-items:flex-start;
        gap:20px;
    }

    .brand{
        font-size:28px;
        font-weight:800;
        letter-spacing:4px;
        color:#000;
    }

    .title{
        font-size:16px;
        font-weight:700;
        letter-spacing:3px;
        color:#000;
        text-align:right;
    }

    .sub{
        font-size:13px;
        color:#666;
        line-height:1.8;
    }

    /* LINE */
    .line{
        height:1px;
        background:linear-gradient(
            to right,
            transparent,
            #000,
            transparent
        );
        margin:20px 0;
        opacity:.2;
    }

    /* SECTION */
    .section{
        margin-bottom:20px;
    }

    .section-title{
        font-size:13px;
        font-weight:700;
        letter-spacing:2px;
        color:#000;
        margin-bottom:15px;
        text-transform:uppercase;
    }

    /* GRID */
    .grid{
        display:grid;
        grid-template-columns:140px 1fr;
        gap:10px;
        font-size:14px;
        color:#222;
    }

    /* TABLE */
    .table{
        width:100%;
        border-collapse:collapse;
    }

    .table thead th{
        background:#000;
        color:#fff;
        padding:14px 10px;
        font-size:12px;
        letter-spacing:1px;
        font-weight:600;
    }

    .table td{
        padding:16px 10px;
        border-bottom:1px solid #ececec;
        vertical-align:middle;
        color:#222;
        font-size:14px;
    }

    .table tbody tr:hover{
        background:#fafafa;
    }

    /* COLUMN WIDTH */
    .table th:nth-child(1),
    .table td:nth-child(1){
        width:40%;
    }

    .table th:nth-child(2),
    .table td:nth-child(2){
        width:20%;
    }

    .table th:nth-child(3),
    .table td:nth-child(3){
        width:10%;
        text-align:center;
    }

    .table th:nth-child(4),
    .table td:nth-child(4){
        width:15%;
    }

    .table th:nth-child(5),
    .table td:nth-child(5){
        width:15%;
    }

    /* PRODUCT */
    .product{
        display:flex;
        align-items:center;
        gap:15px;
    }

    .product img{
        width:80px;
        height:80px;
        object-fit:cover;
        border-radius:10px;
        border:1px solid #ddd;
        background:#fff;
    }

    .product span{
        font-size:15px;
        font-weight:600;
        color:#111;
        line-height:1.5;
    }

    .product-varian{
        display:inline-block;
        padding:5px 10px;
        background:#f4f4f4;
        border-radius:20px;
        font-size:12px;
        color:#444;
    }

    /* VARIANT */
    .variant-box{
        display:flex;
        flex-direction:column;
        gap:5px;
    }

    .variant-item{
        width:max-content;
        padding:4px 8px;
        background:#f5f5f5;
        border-radius:20px;
        font-size:11px;
        border:1px solid #ddd;
    }

    /* ORDER SUMMARY */
    .order-summary{
        margin-top:20px;
        margin-left:auto;
        width:320px;
        background:#fafafa;
        border-radius:12px;
        padding:15px;
        border:1px solid #eee;
    }

    .summary-row{
        display:flex;
        justify-content:space-between;
        padding:6px 0;
        font-size:14px;
    }

    .bold-total{
        font-size:16px;
        font-weight:700;
        color:#000;
        border-top:1px solid #ddd;
        margin-top:8px;
        padding-top:12px;
    }

    /* STATUS */
    .status-row{
        display:flex;
        justify-content:space-between;
        align-items:center;
        padding:10px 0;
        border-bottom:1px dashed #ddd;
        font-size:14px;
    }

    .status-row:last-child{
        border-bottom:none;
    }

    /* REKENING */
    .rekening-box{
        display:grid;
        grid-template-columns:1fr 1fr;
        gap:20px;
        margin:25px 0;
    }

    .rekening-card{
        background:#fff;
        border:1px solid #e5e5e5;
        border-radius:14px;
        padding:18px;
        box-shadow:0 5px 15px rgba(0,0,0,.04);
    }

    .rekening-title{
        font-size:14px;
        font-weight:700;
        letter-spacing:1px;
        color:#000;
        padding-bottom:10px;
        margin-bottom:10px;
        border-bottom:1px solid #eee;
    }

    .rekening-item{
        display:flex;
        justify-content:space-between;
        align-items:center;
        padding:8px 0;
    }

    .rekening-item span{
        font-size:13px;
        color:#666;
    }

    .rekening-item strong{
        color:#000;
        font-size:14px;
    }

    /* TIMELINE */
    .timeline{
        display:flex;
        flex-direction:column;
        gap:8px;
    }

    .timeline-row{
        display:flex;
        justify-content:space-between;
        align-items:center;
        padding:10px 0;
        border-bottom:1px dashed #ddd;
    }

    .t-label{
        font-size:13px;
        color:#666;
    }

    .t-value{
        font-size:13px;
        color:#000;
        font-weight:600;
    }

    /* BOLD */
    .bold{
        font-weight:700;
        color:#000;
    }

    /* MOBILE */
    @media(max-width:768px){

        .invoice{
            padding:20px;
            border-radius:15px;
        }

        .invoice-header{
            flex-direction:column;
            gap:10px;
        }

        .brand{
            font-size:22px;
        }

        .title{
            text-align:left;
        }

        .grid{
            grid-template-columns:100px 1fr;
            font-size:12px;
        }

        .product{
            gap:10px;
        }

        .product img{
            width:60px;
            height:60px;
        }

        .product span{
            font-size:13px;
        }

        .rekening-box{
            grid-template-columns:1fr;
        }

        .order-summary{
            width:100%;
        }

        .table{
            font-size:12px;
        }

        .table th,
        .table td{
            padding:10px 6px;
        }
    }

    /* PRINT */
    @media print{

        body{
            background:#fff;
        }

        body *{
            visibility:hidden;
        }

        .invoice,
        .invoice *{
            visibility:visible;
        }

        .invoice{
            position:absolute;
            left:0;
            top:0;
            width:100%;
            box-shadow:none;
            border:none;
        }
    }
</style>

@endsection