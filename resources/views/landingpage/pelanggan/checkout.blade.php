@extends('landingpage.layouts.main')

@section('content')
<section class="checkout-page py-5">
    <div class="container">
        <form action="{{ route('checkout.store') }}" method="POST">
            @csrf

            @foreach($keranjangs as $item)
                <input type="hidden" name="selected_items[]" value="{{ $item->id }}">
            @endforeach
            <div class="row justify-content-center">
                <div class="row g-4">

                    <!-- KIRI -->
                    <div class="col-lg-8">

                        <!-- Alamat -->
                        <div class="checkout-card mb-4">
                            <div class="card-header-custom">
                                <i class="bi bi-geo-alt"></i>
                                Alamat Pengiriman
                            </div>

                            <div class="card-body-custom">

                                <div class="user-info mb-3">
                                    <div>
                                        <strong>{{ $user->name }}</strong>
                                    </div>

                                    <div class="text-muted">
                                        {{ $user->phone ?? '-' }}
                                    </div>
                                </div>

                                <textarea
                                    name="alamat_pengiriman"
                                    class="form-control checkout-input"
                                    rows="4"
                                    required
                                    placeholder="Masukkan alamat lengkap..."></textarea>

                            </div>
                        </div>

                        <!-- Produk -->
                        <div class="checkout-card">

                            <div class="card-header-custom">
                                <i class="bi bi-bag"></i>
                                Produk Dipesan
                            </div>

                            <div class="card-body-custom">

                                @foreach($keranjangs as $item)

                                @php
                                    $gambar = $item->produk->gambarProduk->first();
                                @endphp

                                <div class="product-item">

                                    <div class="product-left">

                                        @if($gambar)
                                            <img
                                                src="{{ asset('storage/'.$gambar->gambar) }}"
                                                class="product-image">
                                        @else
                                            <img
                                                src="{{ asset('images/no-image.png') }}"
                                                class="product-image">
                                        @endif

                                        <div>

                                            <div class="product-name">
                                                {{ $item->produk->nama_produk }}
                                            </div>

                                            <div class="product-varian">
                                                {{ $item->varian->level }}

                                                @if($item->varian->ukuran)
                                                    • {{ $item->varian->ukuran }}
                                                @endif
                                            </div>

                                            <div class="product-price">
                                                Rp {{ number_format($item->harga,0,',','.') }}
                                            </div>

                                        </div>

                                    </div>

                                    <div class="product-right">

                                        <div class="qty">
                                            x{{ $item->jumlah }}
                                        </div>

                                        <div class="subtotal">
                                            Rp {{ number_format($item->jumlah * $item->harga,0,',','.') }}
                                        </div>

                                    </div>

                                </div>

                                @endforeach

                            </div>
                        </div>

                    </div>

                    <!-- KANAN -->
                    <div class="col-lg-4">

                        <div class="checkout-summary">

                            <h6 class="summary-title">
                                Ringkasan Pesanan
                            </h6>

                            <div class="summary-row">
                                <span>Total Belanja</span>

                                <strong>
                                    Rp {{ number_format($totalHargaProduk,0,',','.') }}
                                </strong>
                            </div>

                            <hr>

                            <div class="mb-3">
                                <label class="fw-semibold mb-2">
                                    Metode Pembayaran
                                </label>

                                <div class="payment-list">

                                    <label class="payment-item">
                                        <input type="radio"
                                            name="metode_pembayaran"
                                            value="cod"
                                            required>

                                        COD
                                    </label>

                                    <label class="payment-item">
                                        <input type="radio"
                                            name="metode_pembayaran"
                                            value="transfer">

                                        Transfer Bank
                                    </label>

                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="fw-semibold mb-2">
                                    Metode Pengiriman
                                </label>

                                <div class="payment-list">

                                    <label class="payment-item">
                                        <input type="radio"
                                            name="metode_pengiriman"
                                            value="ditoko"
                                            required>

                                        Ambil di Toko
                                    </label>

                                    <label class="payment-item">
                                        <input type="radio"
                                            name="metode_pengiriman"
                                            value="delivery">

                                        Delivery Toko
                                    </label>

                                </div>
                            </div>

                            <div class="summary-total">

                                <span>Total Bayar</span>

                                <h4>
                                    Rp {{ number_format($totalHargaProduk,0,',','.') }}
                                </h4>

                            </div>

                            <button
                                type="submit"
                                id="btnPesan"
                                class="btn-order">

                                Buat Pesanan

                            </button>

                        </div>

                    </div>

                </div>
            </div>
        </form>
    </div>
</section>

<style>
:root{
    --bg:#050505;
    --card:#0f0f0f;
    --card2:#151515;
    --border:rgba(255,255,255,.08);
    --text:#ffffff;
    --muted:#9ca3af;
    --accent:#e5e7eb;
}

/* =========================
   PAGE
========================= */

body{
    background:
        radial-gradient(
            circle at top,
            rgba(255,255,255,.04),
            transparent 35%
        ),
        #050505;
}

section{
    position:relative;
}
/* =========================
   DARK LUXURY BACKGROUND
========================= */

.checkout-page{
    min-height:100vh;
    position:relative;
    overflow:hidden;

    background:
        radial-gradient(circle at top left,
            rgba(255,255,255,.05),
            transparent 35%),
        radial-gradient(circle at bottom right,
            rgba(255,255,255,.03),
            transparent 30%),
        linear-gradient(
            135deg,
            #050505 0%,
            #0c0c0c 30%,
            #111111 70%,
            #050505 100%
        );
}

.checkout-page::before{
    content:'';
    position:absolute;
    inset:0;

    background:
        linear-gradient(
            90deg,
            transparent,
            rgba(255,255,255,.015),
            transparent
        );

    pointer-events:none;
}

body{
    background:#050505 !important;
    color:#ffffff;
}

/* container */
.container{
    position:relative;
    z-index:2;
}

/* =========================
   CARD
========================= */

.checkout-card{
    background:
        linear-gradient(
            180deg,
            rgba(20,20,20,.95),
            rgba(10,10,10,.98)
        );

    border:1px solid rgba(255,255,255,.08);

    border-radius:24px;

    overflow:hidden;

    box-shadow:
        0 20px 60px rgba(0,0,0,.55);
}

.card-header-custom{
    padding:18px 22px;

    font-size:15px;
    font-weight:700;

    color:#ffffff;

    background:
        linear-gradient(
            90deg,
            #121212,
            #1a1a1a
        );

    border-bottom:1px solid rgba(255,255,255,.08);
}

.card-header-custom i{
    margin-right:8px;
    color:#fff;
}

.card-body-custom{
    padding:22px;
}

/* =========================
   USER INFO
========================= */

.user-info{
    display:flex;
    justify-content:space-between;
    align-items:center;

    border-bottom:1px dashed rgba(255,255,255,.08);

    padding-bottom:14px;
    margin-bottom:15px;
}

.user-info strong{
    color:#fff;
}

.user-info .text-muted{
    color:var(--muted)!important;
}

/* =========================
   INPUT
========================= */

.checkout-input{
    background:#141414 !important;

    border:1px solid rgba(255,255,255,.08) !important;

    color:#fff !important;

    border-radius:16px !important;

    padding:15px !important;
}

.checkout-input::placeholder{
    color:#777;
}

.checkout-input:focus{
    background:#161616 !important;

    border-color:#fff !important;

    box-shadow:
        0 0 0 4px rgba(255,255,255,.06) !important;
}

/* =========================
   PRODUCT ITEM
========================= */

.product-item{
    display:flex;
    justify-content:space-between;
    align-items:center;

    padding:18px 0;

    border-bottom:1px solid rgba(255,255,255,.05);

    transition:.3s;
}

.product-item:hover{
    transform:translateX(5px);
}

.product-item:last-child{
    border-bottom:none;
}

.product-left{
    display:flex;
    align-items:center;
    gap:15px;
}

/* =========================
   IMAGE
========================= */

.product-image{
    width:85px;
    height:85px;

    object-fit:cover;

    border-radius:14px;

    border:1px solid rgba(255,255,255,.08);

    box-shadow:
        0 8px 25px rgba(0,0,0,.4);
}

/* =========================
   PRODUCT INFO
========================= */

.product-name{
    color:#fff;

    font-size:15px;
    font-weight:700;

    margin-bottom:6px;
}

.product-varian{
    display:inline-block;

    background:
        rgba(255,255,255,.05);

    border:
        1px solid rgba(255,255,255,.06);

    color:#bdbdbd;

    padding:5px 10px;

    border-radius:30px;

    font-size:12px;

    margin-bottom:8px;
}

.product-price{
    color:#8e8e8e;
    font-size:13px;
}

/* =========================
   RIGHT
========================= */

.product-right{
    text-align:right;
}

.qty{
    color:#8e8e8e;
    margin-bottom:6px;
}

.subtotal{
    color:#fff;

    font-size:17px;
    font-weight:700;
}

/* =========================
   SUMMARY
========================= */

.checkout-summary{
    position:sticky;
    top:100px;

    background:
        linear-gradient(
            180deg,
            rgba(20,20,20,.95),
            rgba(10,10,10,.98)
        );

    border:1px solid rgba(255,255,255,.08);

    border-radius:24px;

    padding:24px;

    box-shadow:
        0 20px 60px rgba(0,0,0,.55);
}

.summary-title{
    color:#fff;

    font-size:17px;
    font-weight:700;

    margin-bottom:20px;
}

.summary-row{
    display:flex;
    justify-content:space-between;

    margin-bottom:12px;
}

.summary-row span{
    color:#9ca3af;
}

.summary-row strong{
    color:#fff;
}

/* =========================
   PAYMENT
========================= */

.payment-list{
    display:flex;
    flex-direction:column;
    gap:10px;
}

.payment-item{
    display:flex;
    align-items:center;
    gap:10px;

    background:#141414;

    border:1px solid rgba(255,255,255,.08);

    border-radius:14px;

    padding:14px;

    color:#fff;

    cursor:pointer;

    transition:.25s;
}

.payment-item:hover{
    border-color:#fff;

    background:#1a1a1a;
}

.payment-item:has(input:checked){
    border-color:#fff;

    background:
        linear-gradient(
            135deg,
            rgba(255,255,255,.08),
            rgba(255,255,255,.02)
        );
}

.payment-item input{
    accent-color:#fff;
}

/* =========================
   TOTAL
========================= */

.summary-total{
    margin-top:18px;

    padding-top:18px;

    border-top:
        1px solid rgba(255,255,255,.08);
}

.summary-total span{
    color:#9ca3af;
}

.summary-total h4{
    color:#fff;

    font-size:30px;
    font-weight:800;

    margin-top:6px;
}

/* =========================
   BUTTON
========================= */

.btn-order{
    width:100%;
    height:58px;

    margin-top:20px;

    border:none;

    border-radius:15px;

    color:#000;

    font-weight:800;

    background:
        linear-gradient(
            135deg,
            #ffffff,
            #d1d5db
        );

    transition:.3s;
}

.btn-order:hover{
    transform:translateY(-2px);

    box-shadow:
        0 10px 25px rgba(255,255,255,.15);
}

/* =========================
   LABEL
========================= */

label{
    color:#fff;
}

/* =========================
   HR
========================= */

hr{
    border-color:
        rgba(255,255,255,.08);
}

/* =========================
   MOBILE
========================= */

@media(max-width:991px){

    .checkout-summary{
        position:relative;
        top:0;
    }

    .product-item{
        flex-direction:column;
        align-items:flex-start;
        gap:15px;
    }

    .product-right{
        width:100%;
        text-align:left;
    }

    .product-image{
        width:70px;
        height:70px;
    }

    .summary-total h4{
        font-size:24px;
    }
}
</style>

<script>
    document.getElementById('btnPesan').addEventListener('click', function(e) {
        e.preventDefault();

        Swal.fire({
            text: 'Yakin ingin membuat pesanan?',
            width: 260,
            padding: '1.2em',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal',
            buttonsStyling: false,
            customClass: {
                popup: 'rounded-3',
                htmlContainer: 'small text-dark text-center',
                actions: 'd-flex justify-content-center gap-2 mt-3',
                confirmButton: 'btn btn-sm btn-dark',
                cancelButton: 'btn btn-sm btn-outline-secondary'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                this.closest('form').submit();
            }
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('error_checkout'))
<script>
document.addEventListener('DOMContentLoaded', function () {
    Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: "{{ session('error_checkout') }}",
        width: 300,
        padding: '1em',
        confirmButtonText: 'OK',
        buttonsStyling: false,
        customClass: {
            popup: 'rounded-3',
            title: 'fs-6',
            htmlContainer: 'small',
            confirmButton: 'btn btn-sm btn-danger'
        }
    });
});
</script>

@elseif(session('success_checkout'))
<script>
document.addEventListener('DOMContentLoaded', function () {
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: "{{ session('success_checkout') }}",
        width: 300,
        padding: '1em',
        confirmButtonText: 'OK',
        buttonsStyling: false,
        customClass: {
            popup: 'rounded-3',
            title: 'fs-6',
            htmlContainer: 'small',
            confirmButton: 'btn btn-sm btn-primary'
        }
    });
});
</script>
@endif

@endsection