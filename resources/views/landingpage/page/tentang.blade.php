@extends('landingpage.layouts.main')
@section('title', 'Tentang Kami')
@section('navTentang', 'active')

@section('content')

<style>
    /* =========================
       GLOBAL
    ========================= */
    body{
        background:#0b0b0b;
    }

    /* =========================
       ABOUT WRAPPER
    ========================= */
    .about-wrapper{
        position:relative;
        padding:120px 0 80px;
        overflow:hidden;
        background:#0b0b0b;
        z-index:1;
    }

    /* background luxury */
    .about-wrapper::before{
        content:'';
        position:absolute;
        inset:0;
        z-index:-2;

        background:
            linear-gradient(
                rgba(0,0,0,.82),
                rgba(0,0,0,.88)
            ),
            url('/storage/image.png');

        background-size:cover;
        background-position:center;
        background-repeat:no-repeat;
        background-attachment:fixed;
    }

    /* glow putih */
    .about-wrapper::after{
        content:'';
        position:absolute;
        inset:0;
        z-index:-1;

        background:
            radial-gradient(
                circle at top left,
                rgba(255,255,255,.06),
                transparent 35%
            ),
            radial-gradient(
                circle at bottom right,
                rgba(255,255,255,.03),
                transparent 30%
            );
    }

    footer{
        position:relative;
        z-index:5;
    }

    /* =========================
       SECTION
    ========================= */
    section,
    .about-section{
        position:relative;
        z-index:2;
    }

    .about-section{
        padding:70px 0;
    }

    /* =========================
       GLASS CARD
    ========================= */
    .glass-box{
        background:rgba(18,18,18,.92);
        border:1px solid rgba(255,255,255,.10);
        border-radius:24px;
        backdrop-filter:blur(10px);
        box-shadow:0 15px 40px rgba(0,0,0,.45);
        transition:.4s ease;
    }

    .glass-box:hover{
        transform:translateY(-4px);
        border-color:rgba(255,255,255,.25);
    }

    /* =========================
       TYPOGRAPHY
    ========================= */
    .section-title{
        color:#fff;
        font-weight:800;
        letter-spacing:1px;
    }

    .about-text,
    .text-muted,
    ul li{
        color:#cfcfcf !important;
        line-height:1.9;
    }

    /* =========================
       BADGE
    ========================= */
    .about-badge{
        display:inline-block;
        padding:8px 18px;
        margin-bottom:16px;

        background:rgba(255,255,255,.06);
        border:1px solid rgba(255,255,255,.12);
        border-radius:999px;

        color:#fff;
        font-size:13px;
        letter-spacing:1px;
    }

    /* =========================
       IMAGE
    ========================= */
    .about-image{
        border-radius:26px;
        border:1px solid rgba(255,255,255,.08);
        box-shadow:0 12px 30px rgba(0,0,0,.5);
    }

    /* =========================
       LIST
    ========================= */
    .about-list li{
        margin-bottom:12px;
        font-size:15px;
        color:#d8d8d8;
    }

    /* =========================
       HERO BOX
    ========================= */
    .about-hero-box{
        position:relative;
        overflow:hidden;
    }

    /* glow effect */
    .about-hero-box::before{
        content:'';
        position:absolute;
        top:-100px;
        right:-100px;
        width:220px;
        height:220px;
        border-radius:50%;

        background:rgba(255,255,255,.04);
        filter:blur(40px);
    }

    /* =========================
       COMMITMENT CARD
    ========================= */
    .commit-card{
        padding:35px 25px;
        border-radius:22px;

        background:linear-gradient(
            145deg,
            #171717,
            #111111
        );

        border:1px solid rgba(255,255,255,.08);
        box-shadow:0 8px 24px rgba(0,0,0,.35);
        transition:.4s ease;
    }

    .commit-card:hover{
        transform:translateY(-8px);
        border-color:rgba(255,255,255,.22);
        box-shadow:0 18px 35px rgba(0,0,0,.55);
    }

    .commit-icon{
        font-size:40px;
        color:#fff;
    }

    .commit-card h5{
        color:#fff;
    }

    .commit-card p{
        color:rgba(255,255,255,.72);
    }

    /* =========================
       STATS
    ========================= */
    .stats-box{
        text-align:center;
        padding:25px;

        background:rgba(255,255,255,.02);
        border:1px solid rgba(255,255,255,.08);
        border-radius:22px;

        transition:.3s ease;
    }

    .stats-box:hover{
        transform:translateY(-6px);
        border-color:rgba(255,255,255,.22);
    }

    .stats-box h2{
        color:#fff;
        font-weight:700;
    }

    .stats-box p{
        color:rgba(255,255,255,.7);
    }

    /* =========================
       QUOTE
    ========================= */
    .quote-box{
        position:relative;
        max-width:900px;
        margin:auto;
    }

    .quote-box::before{
        content:'❝';
        position:absolute;
        top:20px;
        left:30px;

        font-size:80px;
        color:rgba(255,255,255,.08);
    }

    /* =========================
       GALLERY
    ========================= */
    .galeri-card{
        width:100%;
        height:280px;
        overflow:hidden;

        background:#111;
        border:1px solid rgba(255,255,255,.08);
        border-radius:24px;
        box-shadow:0 10px 30px rgba(0,0,0,.35);

        transition:.4s ease;
    }

    .galeri-card:hover{
        transform:translateY(-6px);
        border-color:rgba(255,255,255,.22);
    }

    .galeri-card img{
        width:100%;
        height:100%;
        object-fit:cover;
        transition:.5s ease;
    }

    .galeri-card:hover img{
        transform:scale(1.08);
    }

    /* =========================
       MAP
    ========================= */
    .map-card{
        background:rgba(18,18,18,.95);
        border:1px solid rgba(255,255,255,.08);
        border-radius:24px;
        color:#d8d8d8;
        box-shadow:0 10px 30px rgba(0,0,0,.4);
    }

    .map-card h5{
        color:#fff;
    }

    iframe{
        border-radius:20px;
        filter:
            grayscale(20%)
            contrast(1.05)
            brightness(.92);
    }

    /* =========================
       BUTTON
    ========================= */
    .btn-luxury{
        padding:14px 36px;
        border:none;
        border-radius:999px;

        background:#fff;
        color:#111;
        font-weight:700;

        box-shadow:0 0 25px rgba(255,255,255,.10);
        transition:.3s ease;
    }

    .btn-luxury:hover{
        transform:translateY(-4px);
        background:#f5f5f5;
        box-shadow:0 0 30px rgba(255,255,255,.22);
    }

    /* =========================
       MOBILE
    ========================= */
    @media(max-width:768px){

        .about-wrapper{
            padding-top:100px;
        }

        .section-title{
            font-size:28px;
        }

        .galeri-card{
            height:220px;
        }
    }
</style>

<div class="about-wrapper">

    {{-- PROFILE --}}
    <section class="about-section">
        <div class="container">
            <div class="glass-box p-4 p-lg-5 about-hero-box">
                <div class="row align-items-center">

                    <div class="col-md-6 mb-4 mb-md-0">
                        <img src="{{ asset('storage/cs11.png') }}"
                             class="img-fluid about-image"
                             alt="Tentang Circle Scent">
                    </div>

                    <div class="col-md-6">
                        <span class="about-badge">
                            Luxury Fragrance
                        </span>

                        <h3 class="fw-bold mb-3 section-title">
                            Tentang Circle Scent
                        </h3>

                        <p class="about-text">
                            <strong>Circle Scent</strong> menghadirkan parfum
                            premium dengan aroma yang elegan, mewah,
                            dan tahan lama untuk menemani setiap momen
                            berharga Anda.
                        </p>

                        <p class="about-text">
                            Kami percaya bahwa parfum bukan sekadar
                            wangi, tetapi identitas diri, kepercayaan diri,
                            dan kesan yang akan selalu diingat.
                        </p>

                        <ul class="list-unstyled about-list">
                            <li>✦ Aroma premium & elegan</li>
                            <li>✦ Wangi tahan lama</li>
                            <li>✦ Cocok untuk pria & wanita</li>
                            <li>✦ Pilihan fragrance beragam</li>
                            <li>✦ Kualitas terbaik dengan harga terjangkau</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </section>

    {{-- KOMITMEN --}}
    <section class="about-section">
        <div class="container">

            <h4 class="fw-bold text-center mb-5 section-title">
                Komitmen Kami
            </h4>

            <div class="row text-center g-4">

                <div class="col-md-4">
                    <div class="p-4 commit-card h-100">
                        <i class="bi bi-stars commit-icon"></i>

                        <h5 class="fw-semibold mt-3">
                            Kualitas Premium
                        </h5>

                        <p class="mb-0 text-muted">
                            Menghadirkan parfum berkualitas
                            dengan aroma eksklusif dan elegan.
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-4 commit-card h-100">
                        <i class="bi bi-heart commit-icon"></i>

                        <h5 class="fw-semibold mt-3">
                            Kepuasan Pelanggan
                        </h5>

                        <p class="mb-0 text-muted">
                            Memberikan pelayanan terbaik
                            untuk pengalaman belanja parfum
                            yang nyaman dan menyenangkan.
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-4 commit-card h-100">
                        <i class="bi bi-gem commit-icon"></i>

                        <h5 class="fw-semibold mt-3">
                            Elegan & Berkelas
                        </h5>

                        <p class="mb-0 text-muted">
                            Menyediakan aroma yang memberi
                            kesan mewah dan meningkatkan
                            rasa percaya diri.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- STATS --}}
    <section class="about-section">
        <div class="container">
            <div class="glass-box p-4 p-lg-5 about-hero-box">
                <div class="row text-center g-4">

                    <div class="col-6 col-md-3">
                        <div class="stats-box">
                            <h2 class="fw-bold text-white">
                                100+
                            </h2>
                            <p class="text-muted mb-0">
                                Varian Aroma
                            </p>
                        </div>
                    </div>

                    <div class="col-6 col-md-3">
                        <div class="stats-box">
                            <h2 class="fw-bold text-white">
                                10+
                            </h2>
                            <p class="text-muted mb-0">
                                Cabang Store
                            </p>
                        </div>
                    </div>

                    <div class="col-6 col-md-3">
                        <div class="stats-box">
                            <h2 class="fw-bold text-white">
                                10K+
                            </h2>
                            <p class="text-muted mb-0">
                                Pelanggan Puas
                            </p>
                        </div>
                    </div>

                    <div class="col-6 col-md-3">
                        <div class="stats-box">
                            <h2 class="fw-bold text-white">
                                Premium
                            </h2>
                            <p class="text-muted mb-0">
                                Quality Fragrance
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    {{-- QUOTE --}}
    <section class="about-section">
        <div class="container">
            <div class="glass-box p-5 text-center quote-box">

                <h2 class="text-white fst-italic fw-light"
                    style="line-height:1.8;">
                    “Wangi yang Memikat,
                    Kesan yang Melekat.”
                </h2>

                <p class="text-muted mt-3 mb-0">
                    — Circle Scent
                </p>

            </div>
        </div>
    </section>

    {{-- VISI MISI --}}
    <section class="about-section">
        <div class="container">

            <h3 class="text-center fw-bold mb-5 section-title">
                Visi & Misi Kami
            </h3>

            <div class="row g-4">

                <div class="col-md-6">
                    <div class="glass-box p-4 h-100">

                        <h5 class="fw-semibold mb-3 text-white">
                            Visi
                        </h5>

                        <p class="text-muted">
                            Menjadi brand parfum terpercaya
                            yang menghadirkan pengalaman aroma
                            berkualitas, elegan, dan berkesan
                            untuk setiap individu, serta membangun
                            komunitas pelanggan dalam satu lingkaran
                            keharuman Circle Scent.
                        </p>

                    </div>
                </div>

                <div class="col-md-6">
                    <div class="glass-box p-4 h-100">

                        <h5 class="fw-semibold mb-3 text-white">
                            Misi
                        </h5>

                        <ul class="text-muted">
                            <li>✦ Menyediakan parfum berkualitas premium</li>
                            <li>✦ Menghadirkan aroma elegan & tahan lama</li>
                            <li>✦ Memberikan pelayanan terbaik kepada pelanggan</li>
                            <li>✦ Menjadi pilihan utama parfum modern</li>
                        </ul>

                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- GALERI --}}
    <section class="about-section">
        <div class="container">

            <h4 class="text-center fw-bold mb-5 section-title">
                Galeri Circle Scent
            </h4>

            <div class="row g-4">

                <div class="col-md-4">
                    <div class="galeri-card">
                        <img src="/storage/g1.png">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="galeri-card">
                        <img src="/storage/g3.png">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="galeri-card">
                        <img src="/storage/g2.png">
                    </div>
                </div>

            </div>
        </div>
    </section>
    <section class="about-section">
        <div class="container">

            <div class="glass-box p-5 text-center">

                <h2 class="section-title mb-3">
                    Temukan Aroma Favoritmu
                </h2>

                <p class="text-muted mb-4">
                    Jelajahi koleksi parfum premium
                    Circle Scent sekarang.
                </p>

                <a href="/produk" class="btn btn-luxury">
                    Belanja Sekarang
                </a>

            </div>
        </div>
    </section>

    {{-- LOKASI --}}
    <section class="about-section">
        <div class="container">

            <h2 class="text-center fw-bold mb-5 section-title">
                Head Office Circle Scent
            </h2>

            <div class="row align-items-start g-4">

                <div class="col-md-6">
                    <div class="p-4 map-card h-100">

                        <h5 class="fw-semibold mb-3">
                            Informasi Lokasi
                        </h5>

                        <p class="text-muted"
                           style="line-height:1.9;">

                            Circle Scent Headquarters (HQ)
                            <br>

                            Temukan store kami dan rasakan
                            pengalaman memilih aroma premium
                            favorit Anda.

                            <br><br>

                            <strong>Jam Operasional:</strong>
                            Setiap Hari

                            <br>

                            <strong>Customer Service:</strong>
                            Hubungi admin Circle Scent

                        </p>

                    </div>
                </div>

                <div class="col-md-6">
                    <div class="shadow rounded-4 overflow-hidden"
                         style="height:320px;">

                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d8076931.56722158!2d102.3915231!3d-8.7091831!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x403abaa47290b887%3A0xab026e44d599c871!2sCircle%20Scent%20Head%20Quarters%20(HQ)!5e0!3m2!1sid!2sid!4v1780284280936!5m2!1sid!2sid"
                            width="100%"
                            height="100%"
                            style="border:0;"
                            allowfullscreen
                            loading="lazy">
                        </iframe>

                    </div>
                </div>

            </div>
        </div>
    </section>

</div>

@endsection