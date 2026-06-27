@extends('landingpage.layouts.main')

@section('content')

<section class="cabang-section">
    <div class="container">

        {{-- HEADER --}}
        <div class="text-center section-header">
            <h2 class="section-title">Toko Cabang</h2>

            <p class="section-subtitle">
                Temukan lokasi toko cabang kami
            </p>

            <div class="branch-search-wrapper">
                <div class="branch-search-box">

                    <input
                        type="text"
                        id="branchSearch"
                        class="branch-search"
                        placeholder="Cari cabang..."
                    >

                    <button type="button" class="search-btn">
                        <i class="fas fa-search"></i>
                    </button>

                </div>
            </div>
        </div>

        {{-- ================= DKI JAKARTA ================= --}}
        <h3 class="province-title">
            <span>📍</span> DKI Jakarta
        </h3>

        <div class="row g-4">

            {{-- Tebet 1 --}}
            <div class="col-lg-4 col-md-6 branch-item">
                <div class="branch-card">
                    <div class="branch-header">
                        <h5>Circle Scent Tebet 1</h5>
                    </div>

                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d8076931.56722158!2d102.3915231!3d-8.7091831!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f30028c95801%3A0xb206a28fd5f711ac!2sCircle%20Scent%20Tebet%201!5e0!3m2!1sid!2sid!4v1780283638583!5m2!1sid!2sid"
                        allowfullscreen
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>

                    <div class="branch-info">
                        <p><i class="fas fa-location-dot"></i> Tebet, Jakarta Selatan</p>
                        <p><i class="fas fa-clock"></i> 09.00 - 22.00 WIB</p>
                    </div>
                </div>
            </div>

            {{-- Tebet 2 --}}
            <div class="col-lg-4 col-md-6 branch-item">
                <div class="branch-card">
                    <div class="branch-header">
                        <h5>Circle Scent Tebet 2</h5>
                    </div>

                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d8076931.56722158!2d102.3915231!3d-8.7091831!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f34bf2ca6653%3A0x555dcca135d2e8db!2sCircle%20Scent%20Tebet%202!5e0!3m2!1sid!2sid!4v1780283791814!5m2!1sid!2sid"
                        allowfullscreen
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>

                    <div class="branch-info">
                        <p><i class="fas fa-location-dot"></i> Tebet, Jakarta Selatan</p>
                        <p><i class="fas fa-clock"></i> 09.00 - 22.00 WIB</p>
                    </div>
                </div>
            </div>

            {{-- Pondok Kelapa --}}
            <div class="col-lg-4 col-md-6 branch-item">
                <div class="branch-card">
                    <div class="branch-header">
                        <h5>Circle Scent Pondok Kelapa</h5>
                    </div>

                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d8076931.56722158!2d102.3915231!3d-8.7091831!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e698d347a025d8f%3A0xa34c82fc0b984eed!2sCircle%20Scent%20Pondok%20Kelapa!5e0!3m2!1sid!2sid!4v1780284172426!5m2!1sid!2sid"
                        allowfullscreen
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>

                    <div class="branch-info">
                        <p><i class="fas fa-location-dot"></i> Pondok Kelapa, Jakarta Timur</p>
                        <p><i class="fas fa-clock"></i> 09.00 - 22.00 WIB</p>
                    </div>
                </div>
            </div>

        </div>

        {{-- ================= JAWA BARAT ================= --}}
        <h3 class="province-title mt-5">
            <span>📍</span> Jawa Barat (Depok & Bekasi)
        </h3>

        <div class="row g-4">

            {{-- Margonda --}}
            <div class="col-lg-4 col-md-6 branch-item">
                <div class="branch-card">
                    <div class="branch-header">
                        <h5>Circle Scent Margonda</h5>
                    </div>

                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d8076931.56722158!2d102.3915231!3d-8.7091831!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69ed4ac5b82103%3A0x3bc80bd52b9e362b!2sCircle%20Scent%20Margonda!5e0!3m2!1sid!2sid!4v1780291294214!5m2!1sid!2sid"
                        allowfullscreen
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>

                    <div class="branch-info">
                        <p><i class="fas fa-location-dot"></i> Margonda, Depok</p>
                        <p><i class="fas fa-clock"></i> 09.00 - 22.00 WIB</p>
                    </div>
                </div>
            </div>

            {{-- Galaxy --}}
            <div class="col-lg-4 col-md-6 branch-item">
                <div class="branch-card">
                    <div class="branch-header">
                        <h5>Circle Scent Galaxy</h5>
                    </div>

                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d8076931.56722158!2d102.3915231!3d-8.7091831!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e698dd0c3b2b667%3A0x3225b390346460b7!2sCircle%20Scent%20Galaxy!5e0!3m2!1sid!2sid!4v1780284111846!5m2!1sid!2sid"
                        allowfullscreen
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>

                    <div class="branch-info">
                        <p><i class="fas fa-location-dot"></i> Galaxy, Bekasi</p>
                        <p><i class="fas fa-clock"></i> 09.00 - 22.00 WIB</p>
                    </div>
                </div>
            </div>

        </div>

        {{-- ================= DI YOGYAKARTA ================= --}}
        <h3 class="province-title mt-5">
            <span>📍</span> DI Yogyakarta
        </h3>

        <div class="row g-4">

            {{-- Gejayan --}}
            <div class="col-lg-4 col-md-6 branch-item">
                <div class="branch-card">

                    <div class="branch-header">
                        <h5>Circle Scent Gejayan</h5>
                    </div>

                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d8076931.56722158!2d102.3915231!3d-8.7091831!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a59edb5adc231%3A0x27dd0c5d4262bf45!2sCircle%20Scent%20Gejayan!5e0!3m2!1sid!2sid!4v1780284041471!5m2!1sid!2sid"
                        allowfullscreen
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>

                    <div class="branch-info">
                        <p>
                            <i class="fas fa-location-dot"></i>
                            Gejayan, Yogyakarta
                        </p>

                        <p>
                            <i class="fas fa-clock"></i>
                            09.00 - 22.00 WIB
                        </p>
                    </div>

                </div>
            </div>

            {{-- Colombo --}}
            <div class="col-lg-4 col-md-6 branch-item">
                <div class="branch-card">

                    <div class="branch-header">
                        <h5>Circle Scent Colombo</h5>
                    </div>

                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d8076931.56722158!2d102.3915231!3d-8.7091831!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a59675e9e42a5%3A0xea5cdfd61a3c4a9f!2sCircle%20Scent%20Colombo!5e0!3m2!1sid!2sid!4v1780284132247!5m2!1sid!2sid"
                        allowfullscreen
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>

                    <div class="branch-info">
                        <p>
                            <i class="fas fa-location-dot"></i>
                            Colombo, Yogyakarta
                        </p>

                        <p>
                            <i class="fas fa-clock"></i>
                            09.00 - 22.00 WIB
                        </p>
                    </div>

                </div>
            </div>

            {{-- Godean --}}
            <div class="col-lg-4 col-md-6 branch-item">
                <div class="branch-card">

                    <div class="branch-header">
                        <h5>Circle Scent Godean</h5>
                    </div>

                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d8076931.56722158!2d102.3915231!3d-8.7091831!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7af798e931e1c3%3A0x885ded888b28c064!2sCircle%20Scent%20Godean!5e0!3m2!1sid!2sid!4v1780284207165!5m2!1sid!2sid"
                        allowfullscreen
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>

                    <div class="branch-info">
                        <p>
                            <i class="fas fa-location-dot"></i>
                            Godean, Yogyakarta
                        </p>

                        <p>
                            <i class="fas fa-clock"></i>
                            09.00 - 22.00 WIB
                        </p>
                    </div>

                </div>
            </div>

            {{-- Taman Siswa --}}
            <div class="col-lg-4 col-md-6 branch-item">
                <div class="branch-card">

                    <div class="branch-header">
                        <h5>Circle Scent Taman Siswa</h5>
                    </div>

                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d8076931.56722158!2d102.3915231!3d-8.7091831!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a57e5ae9e8719%3A0xc487fbb485037374!2sCircle%20Scent%20Taman%20Siswa!5e0!3m2!1sid!2sid!4v1780284245100!5m2!1sid!2sid"
                        allowfullscreen
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>

                    <div class="branch-info">
                        <p>
                            <i class="fas fa-location-dot"></i>
                            Taman Siswa, Yogyakarta
                        </p>

                        <p>
                            <i class="fas fa-clock"></i>
                            09.00 - 22.00 WIB
                        </p>
                    </div>

                </div>
            </div>

        </div>

        {{-- ================= HEAD OFFICE ================= --}}
        <h3 class="province-title mt-5">
            <span>📍</span> Head Office
        </h3>

        <div class="row g-4">

            <div class="col-lg-4 col-md-6 branch-item">
                <div class="branch-card">

                    <div class="branch-header">
                        <h5>Circle Scent Head Quarters (HQ)</h5>
                    </div>

                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d8076931.56722158!2d102.3915231!3d-8.7091831!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x403abaa47290b887%3A0xab026e44d599c871!2sCircle%20Scent%20Head%20Quarters%20(HQ)!5e0!3m2!1sid!2sid!4v1780284280936!5m2!1sid!2sid"
                        allowfullscreen
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>

                    <div class="branch-info">
                        <p><i class="fas fa-location-dot"></i> Head Office Circle Scent</p>
                        <p><i class="fas fa-clock"></i> 09.00 - 22.00 WIB</p>
                    </div>

                </div>
            </div>

        </div>

    </div>
</section>

<style>
    /* =========================
       GLOBAL
    ========================= */
    body,
    main{
        background:#0f0f0f;
    }

    /* =========================
       CABANG SECTION
    ========================= */
    .cabang-section{
        position:relative;
        padding:120px 0 60px;
        background:#0f0f0f;
        overflow:hidden;
    }

    /* glow background */
    .cabang-section::before{
        content:"";
        position:absolute;
        inset:0;
        pointer-events:none;

        background:
            radial-gradient(
                circle at top left,
                rgba(255,255,255,.05),
                transparent 35%
            ),
            radial-gradient(
                circle at bottom right,
                rgba(255,255,255,.03),
                transparent 30%
            );
    }

    /* =========================
       HEADER
    ========================= */
    .section-header{
        position:relative;
        z-index:2;
        text-align:center;
        margin-bottom:65px;
    }

    .section-title{
        margin-bottom:12px;
        color:#fff;
        font-size:42px;
        font-weight:700;
        letter-spacing:1px;
        text-transform:uppercase;
    }

    .section-subtitle{
        max-width:620px;
        margin:auto;
        color:#bdbdbd;
        font-size:15px;
        line-height:1.8;
    }

    /* =========================
       SEARCH
    ========================= */
    .branch-search-wrapper{
        display:flex;
        justify-content:center;
        margin-top:28px;
    }

    .branch-search-box{
        position:relative;
        width:100%;
        max-width:500px;
    }

    .branch-search{
        width:100%;
        height:58px;
        padding:0 78px 0 24px;

        background:
        linear-gradient(
            180deg,
            #1a1a1a,
            #101010
        );

        border:1.5px solid rgba(255,255,255,.12);
        border-radius:12px;

        color:#fff;
        font-size:15px;
        outline:none;

        transition:.3s ease;

        box-shadow:
            inset 0 1px 2px rgba(255,255,255,.04),
            0 8px 20px rgba(0,0,0,.25);
    }

    .branch-search::placeholder{
        color:#9c9c9c;
    }

    .branch-search:focus{
        border-color:rgba(255,255,255,.28);

        box-shadow:
            0 0 0 3px rgba(255,255,255,.04),
            0 8px 25px rgba(0,0,0,.4);
    }

    /* =========================
       SEARCH BUTTON
    ========================= */
    .search-btn{
        position:absolute;
        top:50%;
        right:7px;
        transform:translateY(-50%);

        width:46px;
        height:46px;

        border:none;
        border-radius:10px;

        background:#fff;
        color:#111;
        cursor:pointer;

        transition:.3s ease;

        box-shadow:
            0 6px 18px rgba(255,255,255,.12);
    }

    .search-btn:hover{
        transform:
        translateY(-50%)
        scale(1.05);
    }

    .search-btn i{
        font-size:15px;
    }

    /* =========================
       PROVINCE TITLE
    ========================= */
    .province-title{
        position:relative;
        z-index:2;

        display:flex;
        align-items:center;
        gap:12px;

        margin-bottom:30px;
        margin-top:15px;

        color:#fff;
        font-size:26px;
        font-weight:700;
        letter-spacing:.5px;
    }

    .province-title::after{
        content:"";
        flex:1;
        height:1px;

        background:
        linear-gradient(
            to right,
            rgba(255,255,255,.22),
            transparent
        );
    }

    /* =========================
       BRANCH CARD
    ========================= */
    .branch-card{
        position:relative;
        z-index:2;
        overflow:hidden;
        height:100%;

        background:
        linear-gradient(
            180deg,
            #171717 0%,
            #101010 100%
        );

        border:1px solid rgba(255,255,255,.10);
        border-radius:10px;

        transition:.35s ease;

        box-shadow:
            0 18px 40px rgba(0,0,0,.45),
            inset 0 1px 0 rgba(255,255,255,.03);
    }

    /* top line premium */
    .branch-card::before{
        content:"";
        position:absolute;
        top:0;
        left:0;

        width:100%;
        height:3px;

        background:
        linear-gradient(
            to right,
            rgba(255,255,255,.95),
            rgba(255,255,255,.15)
        );
    }

    /* inner frame luxury */
    .branch-card::after{
        content:"";
        position:absolute;
        inset:10px;
        border:1px solid rgba(255,255,255,.04);
        pointer-events:none;
    }

    .branch-card:hover{
        transform:translateY(-8px);

        border-color:
        rgba(255,255,255,.22);

        box-shadow:
            0 24px 50px rgba(0,0,0,.60);
    }

    /* =========================
       HEADER CARD
    ========================= */
    .branch-header{
        position:relative;
        padding:22px 20px;
        text-align:center;

        background:
        linear-gradient(
            to bottom,
            rgba(255,255,255,.04),
            transparent
        );

        border-bottom:
        1px solid rgba(255,255,255,.06);
    }

    .branch-header h5{
        margin:0;

        color:#f5f5f5;
        font-size:16px;
        font-weight:700;
        letter-spacing:.8px;
        text-transform:uppercase;
    }

    /* =========================
       MAP
    ========================= */
    .branch-card iframe{
        width:100%;
        height:210px;
        display:block;
        border:none;

        filter:
            brightness(.95)
            contrast(1.05)
            grayscale(8%);

        border-bottom:
        1px solid rgba(255,255,255,.05);
    }

    /* =========================
       INFO
    ========================= */
    .branch-info{
        padding:22px 22px 18px;
    }

    .branch-info p{
        display:flex;
        align-items:flex-start;
        gap:10px;

        margin-bottom:14px;

        color:#d6d6d6;
        font-size:14px;
        font-weight:500;
        line-height:1.7;
    }

    .branch-info p:last-child{
        margin-bottom:0;
    }

    .branch-info i{
        width:18px;
        flex-shrink:0;
        margin-top:3px;
        color:#fff;
        opacity:.9;
    }

    /* =========================
       ROW SPACING
    ========================= */
    .row.g-4{
        --bs-gutter-y:1.6rem;
    }

    /* =========================
       MOBILE
    ========================= */
    @media(max-width:768px){

        .cabang-section{
            padding-top:100px;
        }

        .section-title{
            font-size:30px;
        }

        .section-subtitle{
            font-size:14px;
        }

        .province-title{
            font-size:22px;
        }

        .branch-search{
            height:54px;
            border-radius:10px;
            font-size:14px;
        }

        .search-btn{
            width:42px;
            height:42px;
        }

        .branch-header{
            padding:18px;
        }

        .branch-header h5{
            font-size:14px;
        }

        .branch-card iframe{
            height:180px;
        }

        .branch-info{
            padding:18px;
        }
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const searchInput = document.getElementById('branchSearch');
        const branchItems = document.querySelectorAll('.branch-item');

        searchInput.addEventListener('keyup', function () {

            const keyword = this.value.toLowerCase();

            branchItems.forEach(item => {

                const title = item.querySelector('.branch-header h5')
                                  .textContent
                                  .toLowerCase();

                if(title.includes(keyword)){
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }

            });
        });

    });
</script>
@endsection
