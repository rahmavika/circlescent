@extends('landingpage.layouts.main')
@section('content')

<style>
    body{
        margin:0;
        padding:0;
        font-family:'Poppins', sans-serif;
        background:#0d0d0d;
        color:#fff;
    }

    /* ==========================
    BACKGROUND LUXURY
    ========================== */
    .page-contact{
        position:relative;
        overflow:hidden;
        z-index:1;
        padding:80px 0;
    }

    .page-contact::before{
        content:'';
        position:absolute;
        inset:0;
        background-image:url('{{ asset('storage/image.png') }}');
        background-size:cover;
        background-position:center;
        background-repeat:no-repeat;
        background-attachment:fixed;
        filter:brightness(.16);
        transform:scale(1.03);
        z-index:-2;
    }

    .page-contact::after{
        content:'';
        position:absolute;
        inset:0;
        background:
            linear-gradient(
                to bottom,
                rgba(0,0,0,.55),
                rgba(0,0,0,.90)
            );
        z-index:-1;
    }

    .page-contact .container{
        position:relative;
        z-index:2;
    }

    /* ==========================
    HEADING
    ========================== */
    .page-heading{
        text-align:center;
        margin-bottom:60px;
    }

    .page-heading span{
        display:inline-block;
        color:#ffffff;
        text-transform:uppercase;
        letter-spacing:4px;
        font-size:12px;
        margin-bottom:14px;
        font-weight:500;
    }

    .page-heading h2{
        font-size:3rem;
        font-weight:700;
        color:#fff;
        margin-bottom:16px;
        letter-spacing:-0.5px;
    }

    .page-heading p{
        color:rgba(255,255,255,.68);
        max-width:650px;
        margin:auto;
        line-height:1.9;
        font-size:15px;
    }

    /* ==========================
    FORMAL LUXURY CARD
    ========================== */
    .glass-card{
        position:relative;
        overflow:hidden;

        background:
            linear-gradient(
                180deg,
                rgba(255,255,255,.08),
                rgba(255,255,255,.03)
            );

        border:1px solid rgba(255,255,255,.10);

        backdrop-filter:blur(16px);
        -webkit-backdrop-filter:blur(16px);

        border-radius:16px;
        padding:34px;

        box-shadow:
            0 20px 50px rgba(0,0,0,.25);

        transition:.35s ease;
    }

    .glass-card:hover{
        transform:translateY(-4px);
        border-color:rgba(255,255,255,.18);

        box-shadow:
            0 28px 60px rgba(0,0,0,.32);
    }

    /* subtle premium highlight */
    .glass-card::before{
        content:'';
        position:absolute;
        top:0;
        left:0;
        width:100%;
        height:1px;
        background:
            linear-gradient(
                to right,
                transparent,
                rgba(255,255,255,.18),
                transparent
            );
    }

    /* ==========================
    CARD TITLE
    ========================== */
    .card-title{
        color:#fff;
        font-weight:700;
        margin-bottom:28px;
        padding-bottom:18px;
        border-bottom:
            1px solid rgba(255,255,255,.08);
        font-size:1.2rem;
        letter-spacing:.3px;
    }

    .card-title i{
        margin-right:10px;
        opacity:.9;
    }

    /* ==========================
    FORM
    ========================== */
    .form-label{
        color:rgba(255,255,255,.90);
        font-weight:500;
        margin-bottom:10px;
        font-size:14px;
    }

    .form-control{
        background:rgba(255,255,255,.04);
        border:1px solid rgba(255,255,255,.12);
        border-radius:10px;
        color:#fff;
        padding:15px 18px;
        transition:.3s ease;
        min-height:54px;
    }

    .form-control::placeholder{
        color:rgba(255,255,255,.40);
    }

    .form-control:focus{
        background:rgba(255,255,255,.06);
        border-color:rgba(212,175,55,.45);
        box-shadow:none;
        color:#fff;
    }

    textarea.form-control{
        resize:none;
        min-height:140px;
    }

    /* ==========================
    BUTTON
    ========================== */
    .btn-custom{
        width:100%;
        border:none;
        border-radius:12px;
        padding:15px 20px;

        background:
            linear-gradient(
                135deg,
                #ffffff,
                #ffffff
            );

        color:#111;
        font-weight:700;
        letter-spacing:.5px;
        transition:.35s ease;
    }

    .btn-custom:hover{
        transform:translateY(-2px);

        background:
            linear-gradient(
                135deg,
                #ffffff,
                #ffffff
            );

        color:#111;

        box-shadow:
            0 12px 30px rgba(212,175,55,.18);
    }

    /* ==========================
    FAQ
    ========================== */
    .accordion-item{
        border:1px solid rgba(255,255,255,.08)!important;
        border-radius:12px !important;
        overflow:hidden;
        background:transparent;
        margin-bottom:12px;
    }

    .accordion-button{
        background:rgba(255,255,255,.04);
        color:#fff;
        font-weight:600;
        border:none;
        padding:20px;
        box-shadow:none !important;
        font-size:15px;
    }

    .accordion-button:not(.collapsed){
        background:rgba(255,255,255,.08);
        color:#fff;
    }

    .accordion-button::after{
        filter:brightness(0) invert(1);
    }

    .accordion-body{
        background:rgba(255,255,255,.02);
        color:rgba(255,255,255,.72);
        line-height:1.9;
        padding:20px;
    }

    /* ==========================
    INFO CONTACT
    ========================== */
    .info-contact h5{
        font-size:1.05rem;
        margin-bottom:22px;
    }

    .info-contact p{
        color:rgba(255,255,255,.82);
        margin-bottom:14px;
        font-size:14px;
        display:flex;
        align-items:center;
    }

    .info-contact i{
        width:24px;
        font-size:15px;
        margin-right:10px;
        color:#ffffff;
    }

    /* ==========================
    WHATSAPP BUTTON
    ========================== */
    .btn-whatsapp{
        display:flex;
        justify-content:center;
        align-items:center;
        gap:10px;

        background:
            linear-gradient(
                180deg,
                rgba(255,255,255,.08),
                rgba(255,255,255,.03)
            );

        border:1px solid rgba(255,255,255,.10);
        color:#fff;
        border-radius:12px;
        padding:15px;
        font-weight:600;
        transition:.35s ease;
        text-decoration:none;
    }

    .btn-whatsapp:hover{
        background:#25D366;
        border-color:#25D366;
        color:#fff;
        transform:translateY(-2px);
    }

    /* ==========================
    TEXT
    ========================== */
    .text-muted{
        color:rgba(255,255,255,.60)!important;
    }

    /* ==========================
    OPERATIONAL HOURS
    ========================== */
    .glass-card p{
        color:rgba(255,255,255,.75);
        margin-bottom:0;
        font-size:14px;
    }

    /* ==========================
    RESPONSIVE
    ========================== */
    @media(max-width:992px){
        .page-heading h2{
            font-size:2.5rem;
        }
    }

    @media(max-width:768px){

        .page-contact{
            padding:60px 0;
        }

        .page-heading{
            margin-bottom:40px;
        }

        .page-heading h2{
            font-size:2rem;
        }

        .page-heading p{
            font-size:14px;
        }

        .glass-card{
            padding:24px;
            border-radius:14px;
        }

        .card-title{
            font-size:1.1rem;
        }

        .accordion-button{
            padding:18px;
            font-size:14px;
        }
    }
</style>

<div class="page-contact">

    <section class="py-5">

        <div class="container">

            <div class="page-heading">
                <span>Luxury Fragrance</span>
                <h2>Hubungi Circle Scent</h2>
                <p>
                    Kami siap membantu Anda menemukan
                    aroma terbaik dan menjawab semua
                    pertanyaan mengenai parfum favorit Anda.
                </p>
            </div>

            <div class="row g-4">

                {{-- CONTACT FORM --}}
                <div class="col-lg-6">
                    <div class="glass-card">

                        <h4 class="card-title">
                            <i class="bi bi-envelope-fill"></i>
                            Hubungi Kami
                        </h4>

                        @if(session('contact_success'))
                            <div class="alert alert-success">
                                {{ session('contact_success') }}
                            </div>
                        @endif

                        <form action="{{ route('contact_us.store') }}"
                              method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">
                                    Nama
                                </label>

                                <input type="text"
                                       name="nama"
                                       class="form-control"
                                       required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">
                                    Email
                                </label>

                                <input type="email"
                                       name="email"
                                       class="form-control"
                                       required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">
                                    Pesan
                                </label>

                                <textarea name="pertanyaan"
                                          rows="4"
                                          class="form-control"
                                          required></textarea>
                            </div>

                            <button type="submit"
                                    class="btn btn-custom">
                                Kirim Pesan
                            </button>

                        </form>
                    </div>
                </div>

                {{-- FAQ --}}
                <div class="col-lg-6">

                    <div class="glass-card mb-4">

                        <h4 class="card-title">
                            <i class="bi bi-question-circle-fill"></i>
                            FAQ
                        </h4>

                        @if($faqs->count())
                            <div class="accordion"
                                 id="faqAccordion">

                                @foreach ($faqs as $index => $faq)

                                    <div class="accordion-item">

                                        <h2 class="accordion-header">

                                            <button class="accordion-button collapsed"
                                                    type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#collapse{{ $index }}">

                                                {{ $faq->pertanyaan }}

                                            </button>

                                        </h2>

                                        <div id="collapse{{ $index }}"
                                             class="accordion-collapse collapse">

                                            <div class="accordion-body">
                                                {{ $faq->jawaban ?? '-' }}
                                            </div>

                                        </div>
                                    </div>

                                @endforeach
                            </div>
                        @endif
                    </div>

                    {{-- INFO --}}
                    <div class="glass-card mb-3 info-contact">
                        <h5 class="fw-bold mb-3">
                            Info Kontak
                        </h5>

                        <p>
                            <i class="bi bi-telephone"></i>
                            0813-8251-880
                        </p>

                        <p>
                            <i class="bi bi-envelope"></i>
                            circlescent@gmail.com
                        </p>

                        <p>
                            <i class="bi bi-geo-alt"></i>
                            Pekanbaru, Riau
                        </p>
                    </div>

                    <a href="https://wa.me/628138251880 "
                       target="_blank"
                       class="btn btn-whatsapp w-100 mb-3">

                        <i class="bi bi-whatsapp"></i>
                        Chat WhatsApp
                    </a>

                    <div class="glass-card">
                        <h5 class="fw-bold mb-3">
                            Jam Operasional
                        </h5>

                        <p class="mb-1">
                            Setiap Hari: 09.00 - 22.00
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </section>

</div>

@endsection