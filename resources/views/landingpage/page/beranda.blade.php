@extends('landingpage.layouts.main')
@section('title', 'Beranda')
@section('navAdm', 'active')

@section('content')

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    background:#0d0d0d;
    overflow-x:hidden;
    font-family:'Helvetica Neue', sans-serif;
}

section{
    overflow:hidden;
}

/* =========================
   HERO
========================= */
.hero{
    position:relative;
    height:auto;
    padding:120px 0 80px;
    background:
        linear-gradient(
            to bottom,
            rgba(0,0,0,.25),
            rgba(0,0,0,.75)
        ),
        url('/storage/image.png');
    background-size:cover;
    background-position:center;
    background-attachment:fixed;
    display:flex;
    align-items:center;
    justify-content:center;
    text-align:center;
    color:#fff;
}

.hero-content{
    max-width:850px;
    padding:20px;
    animation:fadeUp 1s ease;
}

.hero-small{
    letter-spacing:8px;
    text-transform:uppercase;
    font-size:13px;
    color:rgba(255,255,255,.85);
    margin-bottom:20px;
}

.hero-title{
    font-size:5rem;
    font-weight:300;
    text-transform:uppercase;
    line-height:1.05;
    margin-bottom:25px;
    letter-spacing:2px;
    color:#fff;
}

.hero-tagline{
    font-size:1.2rem;
    letter-spacing:3px;
    text-transform:uppercase;
    color:rgba(255,255,255,.95);
    margin-top:-10px;
    margin-bottom:25px;
    font-weight:300;
    font-style:italic;
}

.hero-desc{
    max-width:650px;
    margin:auto;
    line-height:2;
    color:rgba(255,255,255,.82);
    font-size:16px;
}

.btn-luxury{
    margin-top:35px;
    border:1px solid rgba(255,255,255,.7);
    color:#fff;
    padding:15px 42px;
    background:transparent;
    text-transform:uppercase;
    letter-spacing:3px;
    transition:.4s;
    border-radius:50px;
}

.btn-luxury:hover{
    background:#fff;
    color:#000;
    transform:translateY(-3px);
}

/* =========================
   GLOBAL SECTION
========================= */
.section-padding{
    padding:120px 0;
}

.section-small{
    text-transform:uppercase;
    letter-spacing:4px;
    color:rgba(255,255,255,.65);
    font-size:12px;
    margin-bottom:10px;
}

.section-title{
    font-size:3rem;
    font-weight:300;
    text-transform:uppercase;
    color:#fff;
    line-height:1.2;
}

.section-text{
    color:rgba(255,255,255,.72);
    line-height:2;
    margin-top:25px;
}

/* =========================
   STORY IMAGE
========================= */
.story-image{
    width:100%;
    height:720px;
    object-fit:cover;
    border-radius:20px;
    transition:
        transform .7s ease,
        box-shadow .5s ease;
}

.story-image:hover{
    transform:scale(1.03);
    box-shadow:0 20px 60px rgba(255,255,255,.08);
}

/* =========================
   COLLECTION
========================= */
.collection-card{
    position:relative;
    overflow:hidden;
    border-radius:20px;
    cursor:pointer;
    background:#111;
}

.collection-card img{
    width:100%;
    height:600px;
    object-fit:cover;
    transition:.8s;
}

.collection-card:hover img{
    transform:scale(1.08);
}

.overlay{
    position:absolute;
    inset:0;
    background:linear-gradient(
        transparent,
        rgba(0,0,0,.88)
    );
}

.card-content{
    position:absolute;
    bottom:40px;
    left:35px;
    color:#fff;
    z-index:10;
}

.card-content h4{
    font-size:1.5rem;
    font-weight:300;
    text-transform:uppercase;
    letter-spacing:2px;
    color:#fff;
}

.card-content p{
    margin-top:8px;
    color:rgba(255,255,255,.82);
}

/* =========================
   WHY SECTION
========================= */
.why-box{
    text-align:center;
    padding:40px 20px;
    transition:.3s;
}

.why-box:hover{
    transform:translateY(-5px);
}

.why-box i{
    color:#fff;
    font-size:40px;
    margin-bottom:20px;
}

.why-box h5{
    color:#fff;
    text-transform:uppercase;
    letter-spacing:2px;
    margin-bottom:10px;
    font-weight:400;
}

.why-box p{
    color:rgba(255,255,255,.7);
    line-height:1.8;
}

/* =========================
   CTA
========================= */
.cta-section{
    position:relative;
    height:450px;
    background:
        linear-gradient(
            rgba(0,0,0,.55),
            rgba(0,0,0,.75)
        ),
        url('/storage/image.png');
    background-size:cover;
    background-position:center;
    display:flex;
    justify-content:center;
    align-items:center;
    text-align:center;
}

.cta-title{
    color:#fff;
    font-size:3rem;
    font-weight:300;
    text-transform:uppercase;
    margin-bottom:20px;
}

/* =========================
   EXPERIENCE SECTION
========================= */
.luxury-section{
    position:relative;
}

.luxury-image-wrapper{
    position:relative;
}

.luxury-image{
    width:100%;
    height:720px;
    object-fit:cover;
    border-radius:24px;
    transition:.5s ease;
}

.luxury-image:hover{
    transform:scale(1.02);
}

/* frame mewah */
.luxury-image-wrapper::before{
    content:'';
    position:absolute;
    top:-20px;
    left:-20px;
    width:100%;
    height:100%;
    border:1px solid rgba(255,255,255,.15);
    border-radius:24px;
    z-index:-1;
}

/* =========================
   PREMIUM ANIMATION
========================= */
.fade-left{
    opacity:0;
    transform:translateX(-60px);
    animation:fadeLeft 1s ease forwards;
}

.fade-right{
    opacity:0;
    transform:translateX(60px);
    animation:fadeRight 1s ease forwards;
}

.fade-up{
    opacity:0;
    transform:translateY(50px);
    animation:fadeUpSoft 1s ease forwards;
}

.delay-1{
    animation-delay:.2s;
}

.delay-2{
    animation-delay:.4s;
}

/* =========================
   KEYFRAMES
========================= */
@keyframes fadeUp{
    from{
        opacity:0;
        transform:translateY(30px);
    }
    to{
        opacity:1;
        transform:translateY(0);
    }
}

@keyframes fadeLeft{
    from{
        opacity:0;
        transform:translateX(-60px);
    }
    to{
        opacity:1;
        transform:translateX(0);
    }
}

@keyframes fadeRight{
    from{
        opacity:0;
        transform:translateX(60px);
    }
    to{
        opacity:1;
        transform:translateX(0);
    }
}

@keyframes fadeUpSoft{
    from{
        opacity:0;
        transform:translateY(50px);
    }
    to{
        opacity:1;
        transform:translateY(0);
    }
}

/* =========================
   MOBILE
========================= */
@media(max-width:768px){

    .hero{
        padding:100px 20px 70px;
        background-attachment:scroll;
    }

    .hero-small{
        letter-spacing:4px;
    }

    .hero-title{
        font-size:2.8rem;
    }

    .hero-tagline{
        font-size:.9rem;
        letter-spacing:2px;
        margin-bottom:20px;
    }

    .hero-desc{
        font-size:14px;
        line-height:1.8;
    }

    .section-title{
        font-size:2rem;
    }

    .story-image,
    .luxury-image,
    .collection-card img{
        height:420px;
    }

    .luxury-image-wrapper::before{
        display:none;
    }

    .cta-title{
        font-size:2rem;
    }

    .btn-luxury{
        padding:12px 30px;
        font-size:14px;
    }
}
</style>
{{-- HERO --}}
<section class="hero">

    <div class="hero-content">

        <p class="hero-small">
            Luxury Fragrance
        </p>

        <h1 class="hero-title">
            Circle Scent
        </h1>

        <p class="hero-tagline">
            Wangi yang Memikat, Kesan yang Melekat
        </p>

        <p class="hero-desc">
            Temukan aroma yang meninggalkan kesan.
            Circle Scent menghadirkan parfum premium
            dengan karakter elegan, mewah,
            dan tahan lama untuk setiap momen spesial.
        </p>

        <a href="/semuaproduk"
            class="btn btn-luxury">
            Explore Collection
        </a>

    </div>

</section>

{{-- STORY --}}
<section class="section-padding fade-up">
    <div class="container">

        <div class="row align-items-center gy-5">

            {{-- IMAGE --}}
            <div class="col-lg-6 fade-left">

                <img src="/storage/cs11.png"
                    class="story-image"
                    alt="About CircleScent">

            </div>

            {{-- TEXT --}}
            <div class="col-lg-5 offset-lg-1 fade-right delay-1">

                <p class="section-small">
                    About Circle Scent
                </p>

                <h2 class="section-title">
                    Crafted To Be Remembered
                </h2>

                <p class="section-text">
                    Circle Scent menghadirkan wewangian
                    premium yang dirancang untuk lebih
                    dari sekadar harum. Dengan karakter
                    aroma yang elegan, memikat, dan
                    berkelas, setiap parfum diciptakan
                    untuk meninggalkan kesan yang
                    melekat — karena wangi yang tepat
                    mampu berbicara tanpa kata.
                </p>

            </div>

        </div>

    </div>
</section>

<section class="section-padding fade-up">
    <div class="container">

        <div class="row align-items-center gy-5 flex-lg-row-reverse">

            {{-- IMAGE --}}
            <div class="col-lg-6 fade-right">

                <img src="/storage/cs12.png"
                    class="story-image"
                    alt="CircleScent Luxury">

            </div>

            {{-- TEXT --}}
            <div class="col-lg-5 fade-left delay-1">

                <p class="section-small">
                    The Art of Fragrance
                </p>

                <h2 class="section-title">
                    More Than Just A Perfume
                </h2>

                <p class="section-text">
                    Circle Scent bukan sekadar parfum —
                    tetapi pengalaman aroma yang dirancang
                    untuk membangun kesan, meningkatkan
                    kepercayaan diri, dan meninggalkan
                    identitas yang tak terlupakan.
                </p>

                <p class="section-text">
                    Dengan karakter aroma premium,
                    setiap semprotan menghadirkan
                    kemewahan yang menyatu dalam
                    setiap momen spesial Anda.
                </p>
            </div>
        </div>
    </div>
</section>
{{-- COLLECTION --}}
<section class="section-padding">

    <div class="container-fluid px-lg-5">

        <div class="text-center mb-5">

            <p class="section-small">
                Signature Collection
            </p>

            <h2 class="section-title">
                Best Seller Fragrance
            </h2>

        </div>

        <div class="row g-4">

            <div class="col-lg-4">

                <div class="collection-card">

                    <img src="/storage/forbidden.png">

                    <div class="overlay"></div>

                    <div class="card-content">
                        <h4>FORBIDDEN</h4>
                        <p>Bloom In Mystery</p>
                    </div>

                </div>

            </div>

            <div class="col-lg-4">

                <div class="collection-card">

                    <img src="/storage/vanila.png">

                    <div class="overlay"></div>

                    <div class="card-content">
                        <h4>Vanilla TABAC</h4>
                        <p>Dark. Warm. Addictive</p>
                    </div>

                </div>

            </div>

            <div class="col-lg-4">

                <div class="collection-card">

                    <img src="/storage/oriented.png">

                    <div class="overlay"></div>

                    <div class="card-content">
                        <h4>ORIENDTED</h4>
                        <p>A Scent of Timeless Seduction</p>
                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

{{-- WHY CHOOSE US --}}
<section class="section-padding bg-black">

    <div class="container text-center">

        <p class="section-small">
            Why Circle Scent
        </p>

        <h2 class="section-title mb-5">
            Luxury In Every Spray
        </h2>

        <div class="row">

            <div class="col-md-3">
                <div class="why-box">
                    <i class="bi bi-stars"></i>
                    <h5>Premium Scent</h5>
                    <p>Aroma eksklusif & elegan</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="why-box">
                    <i class="bi bi-clock-history"></i>
                    <h5>Long Lasting</h5>
                    <p>Tahan lama sepanjang hari</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="why-box">
                    <i class="bi bi-gem"></i>
                    <h5>Luxury Quality</h5>
                    <p>Kualitas premium terbaik</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="why-box">
                    <i class="bi bi-box-seam"></i>
                    <h5>Elegant Packaging</h5>
                    <p>Kemasan premium mewah</p>
                </div>
            </div>

        </div>

    </div>

</section>

{{-- CTA --}}
<section class="cta-section">

    <div>

        <h2 class="cta-title">
            Find Your Signature Scent
        </h2>

        <a href="/semuaproduk"
            class="btn btn-luxury mt-4">
            Shop Now
        </a>

    </div>

</section>

@endsection