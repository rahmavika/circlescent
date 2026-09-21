@extends('landingpage.layouts.main')

@section('content')

<style>

    /* ==========================
       MODERN LUXURY DETAIL
    ========================== */

    .detail-wrapper{
        position: relative;
        min-height: 100vh;
        padding: 90px 0;
        background:
        radial-gradient(circle at top,
        rgba(255,255,255,.08),
        transparent 45%),
        linear-gradient(
            180deg,
            #1a1a1a 0%,
            #242424 100%
        );
    }

    /* ==========================
       CARD
    ========================== */

    .product-detail-box{
        background:#2a2a2a;
        border:1px solid rgba(255,255,255,.08);
        box-shadow:
        0 20px 60px rgba(0,0,0,.25);
        border: 1px solid rgba(255,255,255,.06);
        border-radius: 18px;
        padding: 32px;
        overflow: hidden;
        backdrop-filter: blur(20px);
        box-shadow:
        0 20px 60px rgba(0,0,0,.55);
    }

    /* ==========================
       IMAGE
    ========================== */

    .main-image{
        width: 100%;
        height: 560px;
        border-radius: 28px;
        overflow: hidden;
        background: #fff;
        border: 1px solid rgba(255,255,255,.06);
        position: relative;
    }

    .main-image img{
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform .5s ease;
    }

    .main-image:hover img{
        transform: scale(1.04);
    }

    /* ==========================
       THUMBNAIL
    ========================== */

    .thumb-list{
        display: flex;
        gap: 14px;
        margin-top: 18px;
        overflow-x: auto;
        padding-bottom: 5px;
    }

    .thumb-list::-webkit-scrollbar{
        height: 6px;
    }

    .thumb-list::-webkit-scrollbar-thumb{
        background: rgba(255,255,255,.12);
        border-radius: 999px;
    }

    .thumb-item{
        width: 88px;
        height: 88px;
        border-radius: 20px;
        overflow: hidden;
        flex-shrink: 0;
        cursor: pointer;
        background:#3a3a3a;
        border: 1px solid rgba(255,255,255,.08);
        transition: .3s ease;
    }

    .thumb-item img{
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .thumb-item:hover{
        transform: translateY(-4px);
        border-color: rgba(255,255,255,.4);
    }

    .thumb-item.active{
        border: 2px solid #fff;
    }

    /* ==========================
       PRODUCT BADGE
    ========================== */

    .product-badge{
        padding:6px 14px;
        border-radius:6px;
        background:transparent;
        border:1px solid rgba(255,255,255,.08);
        font-size:11px;
        letter-spacing:1.5px;
        text-transform:uppercase;
    }
    /* ==========================
       PRODUCT TITLE
    ========================== */

    .product-title{
        font-size: 42px;
        font-weight: 700;
        color: #fff;
        line-height: 1.1;
        margin-bottom: 16px;
        letter-spacing: -1px;
    }

    /* ==========================
       PRICE
    ========================== */

    .price-wrapper{
        margin-bottom: 34px;
    }

    .price-label{
        color: #7d7d7d;
        font-size: 14px;
        margin-bottom: 8px;
    }

    .product-price{
        font-size: 44px;
        font-weight: 700;
        color: #fff;
        letter-spacing: -1px;
    }

    /* ==========================
       PRODUCT INFO
    ========================== */

    .product-info-box{
        display: flex;
        gap: 16px;
        margin-bottom: 35px;
    }

    .info-item{
        flex: 1;
        background: #111;
        border: 1px solid rgba(255,255,255,.06);
        border-radius: 22px;
        padding: 22px;
    }

    .info-item span{
        display: block;
        font-size: 13px;
        color: #888;
        margin-bottom: 10px;
    }

    .info-item strong{
        font-size: 20px;
        color: #fff;
    }

    /* ==========================
       SECTION
    ========================== */

    .variant-section{
        margin-bottom: 28px;
    }

    .section-title{
        font-size: 13px;
        color: #8d8d8d;
        margin-bottom: 15px;
        font-weight: 600;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    /* ==========================
       OPTION BUTTON
    ========================== */

    .option-group{
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
    }

    .option-btn{
        border: 1px solid rgba(255,255,255,.08);
        background:#3a3a3a;
        color:#fff;
        border-radius:8px;
        padding:10px 20px;
        min-width:80px;
        height:44px;
        font-size:13px;
        transition: .3s ease;
    }

    .option-btn:hover{
        border-color: rgba(255,255,255,.4);
        transform: translateY(-2px);
        background:#474747;
    }

    .option-btn.active{
        background: #fff;
        color: #000;
        border-color: #fff;
        font-weight: 700;
    }

    .option-btn.disabled{
        opacity: .3;
        pointer-events: none;
    }

    /* ==========================
       BUTTON ACTION
    ========================== */

    .action-wrapper{
        display: flex;
        gap: 16px;
        margin: 42px 0;
    }

    .btn-cart,
    .btn-buy{
        flex: 1;
        height:54px;
        border-radius:8px;
        font-size:13px;
        letter-spacing:.5px;
        text-transform:uppercase;
    }

    /* CART */

    .btn-cart{
        background:#3a3a3a;
        border: 1px solid rgba(255,255,255,.1);
        color: #fff;
    }

    .btn-cart:hover{
        background:#4a4a4a;
        transform: translateY(-2px);
    }

    /* BUY */

    .btn-buy{
        border: none;
        background: #fff;
        color: #000;
    }

    .btn-buy:hover{
        transform: translateY(-3px);
        box-shadow:
        0 12px 30px rgba(255,255,255,.12);
    }

    /* ==========================
       DESCRIPTION
    ========================== */

    .desc-box{
        background:#333333;
        border:1px solid rgba(255,255,255,.08);
        border-radius: 26px;
        padding: 30px;
    }

    .desc-header{
        color: #fff;
        font-size: 22px;
        font-weight: 700;
        margin-bottom: 16px;
    }

    .desc-box p{
        color:#e2e2e2;
        line-height: 1.9;
        font-size: 15px;
    }

    /* ==========================
       SCROLLBAR
    ========================== */

    ::-webkit-scrollbar{
        width: 8px;
    }

    ::-webkit-scrollbar-thumb{
        background: rgba(255,255,255,.12);
        border-radius: 999px;
    }

    /* ==========================
       TABLET
    ========================== */

    @media(max-width:992px){

        .product-title{
            font-size: 42px;
        }

        .product-price{
            font-size: 40px;
        }

        .main-image{
            height: 450px;
        }

        .product-info-box{
            flex-direction: column;
        }

        .action-wrapper{
            flex-direction: column;
        }
    }

    /* ==========================
       MOBILE
    ========================== */

    @media(max-width:768px){

        .detail-wrapper{
            padding: 45px 0;
        }

        .product-detail-box{
            padding: 22px;
            border-radius: 26px;
        }

        .main-image{
            height: 340px;
            border-radius: 22px;
        }

        .thumb-item{
            width: 74px;
            height: 74px;
        }

        .product-title{
            font-size: 34px;
        }

        .product-price{
            font-size: 34px;
        }

        .action-wrapper{
            flex-direction: column;
        }

        .btn-cart,
        .btn-buy{
            width: 100%;
        }

        .desc-box{
            padding: 24px;
        }
    }

    /* ==========================
    PRODUCT META
    ========================== */

    .product-meta{
        display:grid;
        grid-template-columns:1fr 1fr;
        gap:18px;
        margin-bottom:18px;
        padding-bottom:18px;
        border-bottom:1px solid rgba(255,255,255,.08);
    }

    .meta-item span{
        display:block;
        color:#777;
        font-size:10px;
        letter-spacing:2px;
        text-transform:uppercase;
        margin-bottom:8px;
    }

    .meta-item strong{
        color:#fff;
        font-size:18px;
        font-weight:600;
    }

    .desc-box{
        background:#0a0a0a;
        border:1px solid rgba(255,255,255,.06);
        border-radius:10px;
        padding:35px;
    }

    .desc-header{
        font-size:24px;
        font-weight:700;
        color:#fff;
        margin-bottom:25px;
    }

    .desc-box p{
        color:#bdbdbd;
        line-height:2;
        margin:0;
    }
    .qty-section{
    margin-top:25px;
    margin-bottom:35px;
}

.qty-box{
    display:flex;
    align-items:center;
    width:170px;
    height:52px;
    border-radius:12px;
    overflow:hidden;
    background:#3a3a3a;
    border:1px solid rgba(255,255,255,.08);
}

.qty-box button{
    width:52px;
    height:52px;
    border:none;
    background:transparent;
    color:#fff;
    font-size:22px;
    font-weight:600;
}

.qty-box button:hover{
    background:#4a4a4a;
}

#qtyDisplay{
    flex:1;
    text-align:center;
    color:#fff;
    font-weight:700;
    font-size:16px;
}
@media (max-width: 768px){

.action-wrapper{
    width:100%;
}

.btn-cart{
    width:100%;
    padding:14px;
    font-size:16px;
}

}
</style>

<div class="detail-wrapper">
    <div class="container">

        <div class="product-detail-box">
            <div class="row g-5">

                {{-- kiri --}}
                <div class="col-lg-5">

                    <div class="main-image">
                        <img id="mainProductImage"
                             src="{{ asset('storage/' . ($produk->gambarProduk->first()->gambar ?? 'default.jpg')) }}">
                    </div>

                    <div class="thumb-list">
                        @foreach($produk->gambarProduk as $gambar)
                            <div class="thumb-item"
                                 onclick="changeImage(this, '{{ asset('storage/' . $gambar->gambar) }}')">

                                <img src="{{ asset('storage/' . $gambar->gambar) }}">
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-7">

                    {{-- nama produk --}}
                    <h1 class="product-title">
                        {{ $produk->nama_produk }}
                    </h1>

                    {{-- harga --}}
                    <div class="price-wrapper">

                        <div class="price-label">
                            Harga Mulai
                        </div>

                        <div class="product-price"
                             id="productPrice">

                            Rp {{ number_format($produk->varians->first()->harga ?? 0,0,',','.') }}
                        </div>

                    </div>

                    <div class="desc-box">

                        <div class="desc-header">
                            Deskripsi Produk
                        </div>

                        <div class="product-meta">

                            <div class="meta-item">
                                <span>Stok Tersedia</span>
                                <strong id="productStock">
                                    {{ $produk->varians->first()->stok ?? 0 }}
                                </strong>
                            </div>

                            <div class="meta-item">
                                <span>Category</span>
                                <strong>
                                    {{ $produk->gender }}
                                </strong>
                            </div>

                        </div>

                        <p>
                            {{ $produk->deskripsi }}
                        </p>

                    </div>

                    {{-- pilih level --}}
                    @if($produk->varians->pluck('level')->filter()->unique()->count())
                    <div class="variant-section">

                        <div class="section-title">
                            Pilih Level
                        </div>

                        <div class="option-group"
                             id="levelGroup">

                            @foreach($produk->varians->pluck('level')->filter()->unique() as $level)

                                <button type="button"
                                        class="option-btn level-option"
                                        data-level="{{ $level }}">

                                    {{ $level }}

                                </button>

                            @endforeach

                        </div>
                    </div>
                    @endif

                    {{-- ukuran --}}
                    <div class="variant-section">

                        <div class="section-title">
                            Pilih Ukuran
                        </div>

                        <div class="option-group"
                             id="ukuranGroup">

                            @foreach($produk->varians->pluck('ukuran')->filter()->unique() as $ukuran)

                                <button type="button"
                                        class="option-btn ukuran-option"
                                        data-ukuran="{{ $ukuran }}">

                                    {{ $ukuran }}

                                </button>

                            @endforeach

                        </div>
                    </div>
                    <div class="qty-section">

                        <div class="section-title">
                            Jumlah
                        </div>

                        <div class="qty-box">

                            <button type="button"
                                    id="qtyMinus">
                                −
                            </button>

                            <span id="qtyDisplay">
                                1
                            </span>

                            <button type="button"
                                    id="qtyPlus">
                                +
                            </button>

                        </div>

                        <input type="hidden"
                               id="qtyInput"
                               value="1">

                    </div>

                    <input type="hidden"
                           id="selectedVarianId">

                    {{-- tombol --}}
                    <div class="action-wrapper">

                        <button class="btn-cart"
                                style="background:white; color:black; border:1px solid #ddd;"
                                onclick="addToCart()">
                            <i class="bi bi-cart-plus"></i>
                            Keranjang
                        </button>

                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

<script>

const varians = @json($produk->varians);

let selectedLevel = null;
let selectedUkuran = null;

const levelButtons =
    document.querySelectorAll('.level-option');

const ukuranButtons =
    document.querySelectorAll('.ukuran-option');

const priceEl =
    document.getElementById('productPrice');

const stockEl =
    document.getElementById('productStock');

function updateVarian(){

    const matched =
        varians.find(v => {

            const levelMatch =
                selectedLevel
                ? v.level == selectedLevel
                : true;

            const ukuranMatch =
                selectedUkuran
                ? v.ukuran == selectedUkuran
                : true;

            return levelMatch && ukuranMatch;
        });

    if(matched){

        priceEl.innerHTML =
            'Rp ' +
            Number(matched.harga)
            .toLocaleString('id-ID');

        stockEl.innerText =
            matched.stok;

        document.getElementById(
            'selectedVarianId'
        ).value = matched.id;
    }

    // disable ukuran yg ga tersedia
    ukuranButtons.forEach(btn => {

        const ukuran =
            btn.dataset.ukuran;

        const available =
            varians.some(v =>
                (!selectedLevel ||
                    v.level == selectedLevel)
                &&
                v.ukuran == ukuran
            );

        btn.classList.toggle(
            'disabled',
            !available
        );
    });
}

// pilih level
levelButtons.forEach(btn => {

    btn.addEventListener('click', function(){

        levelButtons.forEach(
            b => b.classList.remove('active')
        );

        this.classList.add('active');

        selectedLevel =
            this.dataset.level;

        updateVarian();
    });
});

// pilih ukuran
ukuranButtons.forEach(btn => {

    btn.addEventListener('click', function(){

        ukuranButtons.forEach(
            b => b.classList.remove('active')
        );

        this.classList.add('active');

        selectedUkuran =
            this.dataset.ukuran;

        updateVarian();
    });
});

// ganti gambar
function changeImage(el, src){

    document.getElementById(
        'mainProductImage'
    ).src = src;

    document.querySelectorAll(
        '.thumb-item'
    ).forEach(item =>
        item.classList.remove('active')
    );

    el.classList.add('active');
}

let qty = 1;

const qtyDisplay =
    document.getElementById('qtyDisplay');

const qtyInput =
    document.getElementById('qtyInput');

document
.getElementById('qtyPlus')
.addEventListener('click', () => {

    const stock =
        parseInt(stockEl.innerText);

    if(qty < stock){

        qty++;

        qtyDisplay.innerText = qty;
        qtyInput.value = qty;
    }

});

document
.getElementById('qtyMinus')
.addEventListener('click', () => {

    if(qty > 1){

        qty--;

        qtyDisplay.innerText = qty;
        qtyInput.value = qty;
    }

});
function addToCart(){

const varianId =
    document.getElementById(
        'selectedVarianId'
    ).value;

if(!varianId){

    Swal.fire({
        icon:'warning',
        title:'Pilih Varian',
        text:'Silakan pilih level dan ukuran terlebih dahulu'
    });

    return;
}

fetch('/keranjangs',{

    method:'POST',

    headers:{
        'Content-Type':'application/json',
        'X-CSRF-TOKEN':
        '{{ csrf_token() }}'
    },

    body:JSON.stringify({

        varian_id: varianId,

        jumlah:
            document.getElementById(
                'qtyInput'
            ).value

    })

})

.then(res => res.json())
.then(data => {

    Swal.fire({
        icon:'success',
        title:'Berhasil',
        text:'Produk masuk ke keranjang'
    });

});

}

</script>

@endsection