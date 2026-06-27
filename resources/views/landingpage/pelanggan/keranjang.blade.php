@extends('landingpage.layouts.main')
@section('content')

<style>
    :root{
        --bg-primary:#050505;
        --bg-secondary:#0d0d0d;

        --card:#141414;
        --card-light:#1b1b1b;

        --border:rgba(255,255,255,.08);

        --text:#ffffff;
        --text-secondary:#d1d5db;
        --text-muted:#9ca3af;

        --shadow:
            0 20px 60px rgba(0,0,0,.45);
    }

    /* ==========================
       BODY
    ========================== */

    body{
        background:
            radial-gradient(
                circle at top,
                rgba(255,255,255,.04),
                transparent 35%
            ),
            linear-gradient(
                135deg,
                #050505 0%,
                #0d0d0d 40%,
                #121212 100%
            );

        color:var(--text);
    }

    /* ==========================
       CARD
    ========================== */

    .card-clean{
        background:
            linear-gradient(
                180deg,
                rgba(20,20,20,.96),
                rgba(10,10,10,.98)
            );

        border:1px solid var(--border);

        border-radius:20px;

        overflow:hidden;

        box-shadow:var(--shadow);
    }

    /* ==========================
       TITLE
    ========================== */

    .title-clean{
        color:#fff;

        font-size:1.5rem;
        font-weight:700;

        position:relative;

        padding-bottom:15px;

        margin-bottom:20px;
    }

    .title-clean::after{
        content:'';

        position:absolute;
        left:0;
        bottom:0;

        width:70px;
        height:2px;

        background:#fff;

        border-radius:50px;
    }

    /* ==========================
       TABLE
    ========================== */

    .table-clean{
        color:#fff;
        margin-bottom:0;
    }

    .table-clean thead th{
        background:#1b1b1b;

        color:#d1d5db;

        border:none;

        font-size:.75rem;

        text-transform:uppercase;

        letter-spacing:1px;

        font-weight:600;

        padding:16px;
    }

    .table-clean td{
        background:transparent;

        color:#f8fafc;

        border-bottom:1px solid rgba(255,255,255,.06);

        vertical-align:middle;

        padding:18px 16px;
    }

    .table-clean tbody tr{
        transition:.25s;
    }

    .table-clean tbody tr:hover{
        background:#1a1a1a;
    }

    /* ==========================
       IMAGE
    ========================== */

    .product-img{
        width:90px;
        height:90px;

        object-fit:cover;

        border-radius:14px;

        border:1px solid rgba(255,255,255,.08);

        background:#111;

        box-shadow:
            0 10px 25px rgba(0,0,0,.35);
    }

    /* ==========================
       PRODUCT
    ========================== */

    .fw-semibold{
        color:#fff !important;
        font-weight:600 !important;
    }

    .variant-badge{
        display:inline-block;

        margin-top:8px;

        padding:6px 14px;

        background:#181818;

        border:1px solid rgba(255,255,255,.06);

        border-radius:50px;

        color:#d1d5db;

        font-size:11px;

        letter-spacing:.5px;
    }

    .stock-info{
        margin-top:8px;

        color:var(--text-muted);

        font-size:12px;
    }

    /* ==========================
       PRICE
    ========================== */

    .price-text{
        color:#d1d5db;

        font-weight:500;
    }

    .total-text{
        color:#fff;

        font-weight:700;

        font-size:15px;
    }

    /* ==========================
       QUANTITY
    ========================== */

    .qty-btn{
        width:38px;
        height:38px;

        background:#1c1c1c;

        border:1px solid rgba(255,255,255,.08);

        border-radius:10px;

        color:#fff;

        transition:.25s;
    }

    .qty-btn:hover{
        background:#fff;
        color:#111;
    }

    .qty-btn:disabled{
        opacity:.4;
    }

    .qty-number{
        min-width:40px;
        text-align:center;
        color:#fff;
        font-weight:600;
    }

    /* ==========================
       DELETE
    ========================== */

    .btn-delete{
        width:42px;
        height:42px;

        background:#181818;

        border:1px solid rgba(255,255,255,.06);

        border-radius:10px;

        color:#ef4444;

        transition:.25s;
    }

    .btn-delete:hover{
        background:#ef4444;
        color:#fff;
    }

    /* ==========================
       CHECKBOX
    ========================== */

    .check-item,
    #checkAll{
        width:18px;
        height:18px;

        accent-color:#ffffff;

        cursor:pointer;
    }

    /* ==========================
       CHECKOUT BAR
    ========================== */

    .checkout-bar{
        background:
            linear-gradient(
                180deg,
                rgba(20,20,20,.96),
                rgba(10,10,10,.98)
            );

        border:1px solid rgba(255,255,255,.08);

        border-radius:20px;

        padding:22px 26px;

        box-shadow:var(--shadow);
    }

    /* ==========================
       TOTAL
    ========================== */

    .checkout-total{
        color:#fff;

        font-size:1.3rem;
        font-weight:700;
    }

    .checkout-total span{
        color:#fff;
    }

    /* ==========================
       BUTTON CHECKOUT
    ========================== */

    .btn-checkout-clean{
        background:
            linear-gradient(
                135deg,
                #ffffff,
                #d8d8d8
            );

        color:#000;

        border:none;

        border-radius:12px;

        padding:14px 32px;

        font-weight:700;

        transition:.3s;

        box-shadow:
            0 12px 25px rgba(255,255,255,.10);
    }

    .btn-checkout-clean:hover{
        transform:translateY(-2px);

        box-shadow:
            0 18px 35px rgba(255,255,255,.15);
    }

    /* ==========================
       EMPTY CART
    ========================== */

    .btn-icon-only{
        width:65px;
        height:65px;

        border-radius:16px;

        background:#fff;

        color:#111;

        display:flex;
        align-items:center;
        justify-content:center;

        text-decoration:none;

        transition:.25s;
    }

    .btn-icon-only:hover{
        transform:translateY(-3px);
    }

    /* ==========================
       TEXT
    ========================== */

    .text-muted{
        color:#9ca3af !important;
    }

    /* ==========================
       SCROLLBAR
    ========================== */

    ::-webkit-scrollbar{
        width:8px;
    }

    ::-webkit-scrollbar-track{
        background:#111;
    }

    ::-webkit-scrollbar-thumb{
        background:#444;
        border-radius:20px;
    }

    ::-webkit-scrollbar-thumb:hover{
        background:#666;
    }

    /* ==========================
       MOBILE
    ========================== */

    @media(max-width:768px){

        .product-img{
            width:70px;
            height:70px;
        }

        .table-clean{
            font-size:13px;
        }

        .checkout-total{
            font-size:1.1rem;
        }

        .btn-checkout-clean{
            width:100%;
            margin-top:12px;
        }
    }
</style>

<section class="py-5 mt-5">
    <div class="container">
        <div class="card card-clean p-4">
            <h4 class="title-clean mb-4">
                Keranjang Belanja
            </h4>
            <div class="table-responsive">
                <table class="table table-clean align-middle">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="checkAll"></th>
                            <th>Produk</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-center">Harga</th>
                            <th class="text-center">Total</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php $stokKurang = false; @endphp
                        @foreach($keranjangs as $keranjang)
                        @php
                            $stokTersedia = $keranjang->varian->stok ?? 0;
                            $harga = $keranjang->varian->harga ?? 0;

                            if($keranjang->jumlah > $stokTersedia) {
                                $stokKurang = true;
                            }
                        @endphp
                        <tr>
                            <td>
                                <input type="checkbox"
                                    class="check-item"
                                    name="selected_items[]"
                                    form="checkoutForm"
                                    value="{{ $keranjang->id }}"
                                    data-total="{{ $keranjang->jumlah * $harga }}"
                                    {{ $keranjang->jumlah > $stokTersedia ? 'disabled' : '' }}>
                            </td>
                            <td class="text-start">
                                <div class="d-flex align-items-center gap-3">
                                    @if($keranjang->produk && $keranjang->produk->gambarProduk->count())
                                        <img
                                            src="{{ asset('storage/' . $keranjang->produk->gambarProduk->first()->gambar) }}"
                                            class="product-img">
                                    @else
                                        <img
                                            src="{{ asset('images/default.jpg') }}"
                                            class="product-img">
                                    @endif
                                    <div>
                                        <div class="fw-semibold">
                                            {{ $keranjang->produk->nama_produk }}
                                        </div>

                                        <div class="variant-badge">
                                            {{ $keranjang->varian->level }}
                                            @if($keranjang->varian->ukuran)
                                                • {{ $keranjang->varian->ukuran }}
                                            @endif
                                        </div>

                                        <div class="stock-info">
                                            Stok tersedia: {{ $stokTersedia }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <form action="{{ route('keranjangs.update', $keranjang->id) }}"
                                    method="POST"
                                    class="d-flex justify-content-center align-items-center gap-2">
                                    @csrf
                                    @method('PUT')
                                    <button name="action" value="decrease"
                                        class="qty-btn"
                                        {{ $keranjang->jumlah <= 1 ? 'disabled' : '' }}>
                                        -
                                    </button>
                                    <span class="fw-semibold">
                                        {{ $keranjang->jumlah }}
                                    </span>
                                    <button name="action" value="increase"
                                        class="qty-btn"
                                        {{ $keranjang->jumlah >= $stokTersedia ? 'disabled' : '' }}>
                                        +
                                    </button>
                                </form>
                            </td>
                            <td>
                                Rp {{ number_format($harga, 0, ',', '.') }}
                            </td>
                            <td class="fw-semibold">
                                Rp {{ number_format($keranjang->jumlah * $harga, 0, ',', '.') }}
                            </td>
                            <td>
                                <form action="{{ route('keranjangs.destroy', $keranjang->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"
                                        class="btn-delete btn-delete-trigger">
                                        🗑
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($keranjangs->isEmpty())
            <div class="text-center py-5">
                <p class="text-muted">Keranjang masih kosong</p>
                <a href="/semuaproduk" class="btn-icon-only">
                    <i class="bi bi-bag-plus"></i>
                </a>
            </div>
            @else
            <form action="/checkout" method="GET" id="checkoutForm">
                <div class="checkout-bar d-flex justify-content-between align-items-center mt-4 flex-wrap gap-3">
                    <div class="checkout-total">
                        Total:
                        <span id="totalHarga">Rp 0</span>
                    </div>
                    <button type="submit"
                        id="btnCheckout"
                        class="btn-checkout-clean"
                        {{ $stokKurang ? 'disabled' : '' }}>
                        Checkout
                    </button>
                </div>
            </form>
            @endif
        </div>
    </div>
</section>
@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkAll = document.getElementById('checkAll');
        const items = document.querySelectorAll('.check-item');
        const totalText = document.getElementById('totalHarga');
        const btnCheckout = document.getElementById('btnCheckout');

        function updateTotal() {
            let total = 0;
            let checked = 0;
            items.forEach(item => {
                if (item.checked) {
                    total += parseInt(item.dataset.total);
                    checked++;
                }
            });
            totalText.innerText = 'Rp ' + total.toLocaleString('id-ID');
            btnCheckout.disabled = checked === 0;
        }
        checkAll.addEventListener('change', function () {
            items.forEach(item => {
                if (!item.disabled) {
                    item.checked = this.checked;
                }
            });
            updateTotal();
        });
        items.forEach(item => {
            item.addEventListener('change', updateTotal);
        });
        updateTotal();
        document.querySelectorAll('.btn-delete-trigger').forEach(button => {
            button.addEventListener('click', function () {
                let form = this.closest('form');
                Swal.fire({
                    title: 'Hapus produk ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'OK',
                    cancelButtonText: 'Cancel',
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>