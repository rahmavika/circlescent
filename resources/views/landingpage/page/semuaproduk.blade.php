@extends('landingpage.layouts.main')
@section('content')

<style>
    /* ==========================
       PAGE WRAPPER
    ========================== */
    .page-wrapper{
        position: relative;
        min-height: 100vh;
        padding: 50px 0 80px;
        overflow: hidden;
        z-index: 1;
    }

    .page-wrapper::before{
        content:'';
        position:absolute;
        inset:0;
        background:
            url('/storage/image.png')
            center center / cover
            no-repeat fixed;
        z-index:-2;
    }

    .page-wrapper::after{
        content:'';
        position:absolute;
        inset:0;
        background:
            linear-gradient(
                to bottom,
                rgba(8,8,8,.82),
                rgba(15,15,15,.94)
            );
        z-index:-1;
    }

    /* ==========================
       HEADER SECTION
    ========================== */
    .section-header-modern{
        position: relative;
        overflow: hidden;

        display:flex;
        justify-content:space-between;
        align-items:center;
        gap:40px;

        padding:42px;

        background:
            rgba(12,12,12,.92);

        border:1px solid rgba(255,255,255,.08);

        margin-bottom:50px;
    }

    /* subtle white glow */
    .section-header-modern::before{
        content:'';
        position:absolute;
        top:-120px;
        right:-120px;

        width:260px;
        height:260px;

        background:
            radial-gradient(
                rgba(255,255,255,.06),
                transparent 70%
            );

        pointer-events:none;
    }

    /* badge */
    .mini-badge{
        display:inline-flex;
        align-items:center;

        padding:9px 18px;

        border:
            1px solid rgba(255,255,255,.14);

        background:
            rgba(255,255,255,.04);

        color:#f5f5f5;

        font-size:11px;
        font-weight:500;
        letter-spacing:1.5px;
        text-transform:uppercase;

        margin-bottom:18px;
    }

    /* title */
    .header-title{
        font-size:54px;
        font-weight:300;
        letter-spacing:-1px;
        color:#fff;
        margin-bottom:12px;
    }

    /* subtitle */
    .header-subtitle{
        margin:0;
        max-width:560px;

        color:#a3a3a3;

        font-size:15px;
        line-height:1.9;
        font-weight:300;
    }

    /* ==========================
       SEARCH BOX
    ========================== */
    .search-box-modern{
        display:flex;
        align-items:center;

        width:430px;

        background:
            rgba(20,20,20,.96);

        border:
            1px solid rgba(255,255,255,.08);

        padding:8px 8px 8px 16px;

        transition:.3s ease;
    }

    .search-box-modern:focus-within{
        border-color:
            rgba(255,255,255,.18);

        box-shadow:
            0 0 0 3px rgba(255,255,255,.03);
    }

    .search-modern-icon{
        color:#888;
        font-size:14px;
        margin-right:12px;
    }

    .search-modern-input{
        flex:1;
        border:none;
        outline:none;
        background:transparent;

        color:#fff;
        font-size:14px;
        font-weight:300;
    }

    .search-modern-input::placeholder{
        color:#777;
    }

    .search-modern-btn{
        border:none;
        background:#fff;
        color:#111;

        padding:13px 28px;

        font-size:13px;
        font-weight:600;
        letter-spacing:.5px;

        transition:.25s ease;
    }

    .search-modern-btn:hover{
        background:#e5e5e5;
    }

    /* ==========================
       PRODUCT CARD
    ========================== */
    .product-card-modern{
        position: relative;
        height:100%;
        overflow:hidden;

        background:#111;

        border:
            1px solid rgba(255,255,255,.08);

        transition:
            transform .35s ease,
            border-color .35s ease;
    }

    .product-card-modern:hover{
        transform: translateY(-4px);

        border-color:
            rgba(255,255,255,.18);
    }

    /* image area */
    .product-img-modern{
        position: relative;
        overflow:hidden;
        background:#161616;
    }

    .product-img-modern img{
        width:100%;
        aspect-ratio:1/1.18;
        object-fit:cover;

        transition:
            transform .7s ease;
    }

    .product-card-modern:hover
    .product-img-modern img{
        transform:scale(1.03);
    }

    /* product body */
    .product-body-modern{
        padding:22px 18px 20px;
    }

    /* subtle divider */
    .product-body-modern::before{
        content:'';
        display:block;

        width:28px;
        height:1px;

        background:
            rgba(255,255,255,.20);

        margin-bottom:18px;
    }

    /* ==========================
    PRODUCT TITLE
    ========================== */
    .product-title-modern{
        color:#bcbcbc; /* lebih soft */

        font-size:15px;
        font-weight:400;
        line-height:1.8;

        letter-spacing:.1px;

        min-height:56px;

        display:-webkit-box;
        -webkit-line-clamp:2;
        -webkit-box-orient:vertical;
        overflow:hidden;
    }

    /* ==========================
    PRICE
    ========================== */
    .price-modern{
        margin-top:20px;

        color:#ffffff;

        font-size:38 ;
        font-weight:200;

        letter-spacing:-1.2px;
        line-height:1;
    }
    .price-label{
        margin-top:18px;

        color:#7b7b7b;

        font-size:11px;
        font-weight:500;

        letter-spacing:2px;
        text-transform:uppercase;
    }

    /* ==========================
       SOLD OUT
    ========================== */
    .product-card-modern.habis{
        opacity:.72;
    }

    .product-card-modern.habis:hover{
        transform:none;
        border-color:
            rgba(255,255,255,.08);
    }

    .product-card-modern.habis img{
        filter:
            brightness(.45)
            grayscale(.1);
    }

    /* badge habis */
    .badge-habis-overlay{
        position:absolute;
        top:50%;
        left:50%;

        transform:
            translate(-50%, -50%);

        z-index:10;

        background:
            rgba(10,10,10,.88);

        border:
            1px solid rgba(255,255,255,.12);

        color:#fff;

        padding:12px 26px;

        font-size:12px;
        font-weight:600;

        letter-spacing:3px;
        text-transform:uppercase;

        backdrop-filter: blur(8px);
    }

    /* disabled product */
    .disabled-link{
        pointer-events:none;
        cursor:not-allowed;
    }

    /* ==========================
       EMPTY STATE
    ========================== */
    .text-danger{
        color:#fff !important;
        text-align:center;
        width:100%;
    }

    /* ==========================
       RESPONSIVE
    ========================== */
    @media(max-width:992px){

        .section-header-modern{
            flex-direction:column;
            align-items:flex-start;
        }

        .search-box-modern{
            width:100%;
        }

        .header-title{
            font-size:44px;
        }
    }

    @media(max-width:768px){

        .page-wrapper{
            padding:35px 0 60px;
        }

        .section-header-modern{
            padding:28px;
            gap:24px;
        }

        .header-title{
            font-size:36px;
        }

        .header-subtitle{
            font-size:14px;
        }

        .product-body-modern{
            padding:16px;
        }

        .product-title-modern{
            font-size:13px;
            line-height:1.7;
            min-height:44px;
        }

        .price-modern{
            font-size:16px;
        }

        .search-modern-btn{
            padding:12px 18px;
        }
    }

    @media(max-width:576px){

        .header-title{
            font-size:30px;
        }

        .mini-badge{
            font-size:10px;
        }

        .search-modern-input{
            font-size:13px;
        }

        .search-modern-btn{
            font-size:12px;
            padding:12px 14px;
        }

        .badge-habis-overlay{
            font-size:11px;
            letter-spacing:2px;
            padding:10px 18px;
        }
    }
    .variant-meta{
        display:flex;
        flex-wrap:wrap;
        gap:6px;
        margin-top:6px;
    }

    .variant-badge{
        display:inline-flex;
        align-items:center;
        padding:4px 10px;
        border-radius:999px;
        background:#353535;
        border:1px solid #4a4a4a;
        color:#f9fafb !important;
        font-size:11px;
        font-weight:500;
        line-height:1.2;
    }
</style>

<div class="page-wrapper">
    <div class="container">
        <div class="section-header-modern mt-5 mb-4">

            <div class="header-left">
                <span class="mini-badge">
                    Circle Scent Collection
                </span>

                <h2 class="header-title">
                    Semua Produk
                </h2>

                <p class="header-subtitle">
                    Temukan koleksi parfum terbaik dengan aroma elegan
                    untuk setiap momen spesial Anda.
                </p>
            </div>

            <div class="header-right">
                <form action="{{ url('/semuaproduk') }}"
                    method="GET"
                    class="search-box-modern">

                    @if(request('gender'))
                        <input type="hidden" name="gender" value="{{ request('gender') }}">
                    @endif

                    <i class="bi bi-search search-modern-icon"></i>

                    <input type="text"
                        name="search"
                        class="search-modern-input"
                        placeholder="Cari parfum favorit..."
                        value="{{ request('search') }}"
                        oninput="clearTimeout(this.delay); this.delay=setTimeout(() => this.form.submit(), 400)">

                    <button type="submit" class="search-modern-btn">
                        Cari
                    </button>
                </form>
            </div>

        </div>
        <div class="tab-content">
            <div class="tab-pane fade show active">
                <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 gx-4 gy-5">
                    @forelse($produks as $produk)
                    <div class="col">
                        <a href="{{ $produk->varians->sum('stok') > 0 ? route('produk.detail', $produk->id) : 'javascript:void(0)' }}"
                            class="text-decoration-none text-dark {{ $produk->varians->sum('stok') <= 0 ? 'disabled-link' : '' }}">

                             <div class="product-card-modern {{ $produk->varians->sum('stok') <= 0 ? 'habis' : '' }}">

                                {{-- badge habis --}}
                                @if($produk->varians->sum('stok') <= 0)
                                    <div class="badge-habis-overlay">
                                        Habis
                                    </div>
                                @endif

                                {{-- gambar produk --}}
                                <div class="product-img-modern">
                                    <img src="{{ asset('storage/' . ($produk->gambarProduk->first()->gambar ?? 'default.jpg')) }}"
                                         alt="{{ $produk->nama_produk }}">
                                </div>

                                {{-- isi card --}}
                                <div class="product-body-modern">

                                    {{-- nama produk --}}
                                    <div class="product-title-modern">
                                        {{ $produk->nama_produk }}
                                    </div>

                                    {{-- harga --}}
                                    <div class="price-label">
                                        Harga mulai
                                    </div>

                                    <div class="price-modern">
                                        Rp{{ number_format($produk->varians->min('harga') ?? 0, 0, ',', '.') }}
                                    </div>

                                </div>
                            </div>

                        </a>
                    </div>
                    @empty
                    <p class="text-center text-danger">
                        Produk tidak tersedia
                    </p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('liveSearchForm');
        const input = document.getElementById('liveSearchInput');

        let timeout = null;

        input.addEventListener('input', function () {
            clearTimeout(timeout);

            timeout = setTimeout(() => {
                form.submit();
            }, 500); // delay 500ms setelah user berhenti mengetik
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {

        // tombol tambah qty
        document.querySelectorAll('.plus').forEach(button => {

            button.addEventListener('click', function () {

                const card =
                    this.closest('.bottom-section');

                const qtyDisplay =
                    card.querySelector('.qty-display');

                const produkId =
                    qtyDisplay.dataset.id;

                const qtyInput =
                    document.querySelector(
                        '.qty-input[data-id="' + produkId + '"]'
                    );

                let qty =
                    parseInt(qtyDisplay.textContent);

                const maxStock =
                    parseInt(this.dataset.max);

                // tambah jika belum melebihi stok
                if (qty < maxStock) {

                    qty++;

                    qtyDisplay.textContent = qty;
                    qtyInput.value = qty;
                }
            });
        });


        // tombol kurang qty
        document.querySelectorAll('.minus').forEach(button => {

            button.addEventListener('click', function () {

                const card =
                    this.closest('.bottom-section');

                const qtyDisplay =
                    card.querySelector('.qty-display');

                const produkId =
                    qtyDisplay.dataset.id;

                const qtyInput =
                    document.querySelector(
                        '.qty-input[data-id="' + produkId + '"]'
                    );

                let qty =
                    parseInt(qtyDisplay.textContent);

                // minimal 1
                if (qty > 1) {

                    qty--;

                    qtyDisplay.textContent = qty;
                    qtyInput.value = qty;
                }
            });
        });

    });

    function addToCart(event, produkId) {

        event.preventDefault();

        const form =
            document.getElementById(
                'form-' + produkId
            );

        const formData =
            new FormData(form);

        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN':
                    '{{ csrf_token() }}',
                'Accept':
                    'application/json',
                'X-Requested-With':
                    'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {

            if (data.success) {

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Produk berhasil ditambahkan ke keranjang',
                    showCancelButton: true,
                    confirmButtonText: 'Lihat Keranjang',
                    cancelButtonText: 'Lanjut Belanja',
                    reverseButtons: true,
                    allowOutsideClick: true,
                    buttonsStyling: false,
                    width: '500px',
                    customClass: {
                        popup: 'cart-popup',
                        title: 'cart-title',
                        htmlContainer: 'cart-text',
                        confirmButton: 'btn-cart-view',
                        cancelButton: 'btn-cart-continue'
                    }

                }).then((result) => {

                    if (result.isConfirmed) {

                        window.location.href =
                            "#";
                    }

                });

            } else {

                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text:
                        'Produk gagal ditambahkan'
                });

            }
        })
        .catch(error => {

            console.error(error);

            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text:
                    'Terjadi kesalahan'
            });
        });

        return false;
    }
</script>
@endsection