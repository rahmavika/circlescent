@extends('landingpage.layouts.main')

@section('title', 'FAQ')

@section('content')

<style>
    body{
        background: #0b0b0b;
        color: #fff;
    }

    .faq-section{
        padding: 120px 0 90px;
        background:
            radial-gradient(circle at top right,
                rgba(255,255,255,.05),
                transparent 35%),
            #0b0b0b;
    }

    .small-title{
        color: rgba(255,255,255,.75);
        text-transform: uppercase;
        letter-spacing: 3px;
        font-size: 13px;
        display: block;
        margin-bottom: 10px;
    }

    .page-title{
        font-size: 48px;
        font-weight: 700;
        color: #fff;
        margin-bottom: 15px;
    }

    .page-desc{
        color: rgba(255,255,255,.72);
        max-width: 700px;
        line-height: 1.9;
        margin-bottom: 60px;
    }

    .faq-wrapper{
        max-width: 950px;
        margin: auto;
    }

    .accordion-item{
        background: rgba(255,255,255,.03);
        border: 1px solid rgba(255,255,255,.08);
        border-radius: 18px;
        margin-bottom: 20px;
        overflow: hidden;
        backdrop-filter: blur(10px);
        transition: all .3s ease;
    }

    .accordion-item:hover{
        border-color: rgba(255,255,255,.15);
        background: rgba(255,255,255,.05);
    }

    .accordion-button{
        background: transparent !important;
        color: #fff !important;
        font-weight: 600;
        padding: 25px;
        box-shadow: none !important;
        font-size: 17px;
    }

    .accordion-button:not(.collapsed){
        color: #fff !important;
    }

    .accordion-button:focus{
        box-shadow: none !important;
    }

    .accordion-button::after{
        filter: brightness(0) invert(1);
    }

    .accordion-body{
        color: rgba(255,255,255,.75);
        line-height: 1.9;
        padding: 0 25px 25px;
    }

    .help-box{
        margin-top: 80px;
        background:
            linear-gradient(
                135deg,
                rgba(255,255,255,.08),
                rgba(255,255,255,.02)
            );
        border: 1px solid rgba(255,255,255,.08);
        border-radius: 30px;
        padding: 50px;
        text-align: center;
        backdrop-filter: blur(10px);
    }

    .help-box h3{
        font-size: 30px;
        margin-bottom: 15px;
        color: #fff;
    }

    .help-box p{
        color: rgba(255,255,255,.72);
        margin-bottom: 30px;
    }

    .btn-contact{
        background: #fff;
        color: #000;
        padding: 14px 34px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        transition: .3s;
        display: inline-block;
    }

    .btn-contact:hover{
        background: #e8e8e8;
        transform: translateY(-2px);
        color: #000;
    }

    @media(max-width:768px){
        .page-title{
            font-size: 34px;
        }

        .help-box{
            padding: 35px 25px;
        }
    }
</style>
<section class="faq-section">
    <div class="container">

        {{-- HEADER --}}
        <div class="text-center mb-5">
            <span class="small-title">
                Customer Support
            </span>

            <h1 class="page-title">
                Frequently Asked Questions
            </h1>

            <p class="page-desc mx-auto">
                Temukan jawaban atas pertanyaan yang paling sering diajukan
                mengenai produk, pengiriman, pembayaran, hingga layanan
                pelanggan Circle Scent.
            </p>
        </div>

        {{-- FAQ --}}
        <div class="faq-wrapper">

            <div class="accordion" id="faqAccordion">

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#faq1">
                            Apakah parfum Circle Scent tahan lama?
                        </button>
                    </h2>

                    <div id="faq1"
                        class="accordion-collapse collapse show"
                        data-bs-parent="#faqAccordion">

                        <div class="accordion-body">
                            Ya, parfum Circle Scent diformulasikan
                            menggunakan bahan premium dengan ketahanan
                            aroma sekitar 6–12 jam tergantung aktivitas,
                            jenis kulit, dan lingkungan penggunaan.
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#faq2">
                            Apakah parfum cocok digunakan sehari-hari?
                        </button>
                    </h2>

                    <div id="faq2"
                        class="accordion-collapse collapse"
                        data-bs-parent="#faqAccordion">

                        <div class="accordion-body">
                            Tentu. Koleksi Circle Scent dirancang untuk
                            berbagai kebutuhan, mulai dari aktivitas
                            sehari-hari, bekerja, hingga acara formal
                            dan spesial.
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#faq3">
                            Bagaimana cara mengetahui status pesanan?
                        </button>
                    </h2>

                    <div id="faq3"
                        class="accordion-collapse collapse"
                        data-bs-parent="#faqAccordion">

                        <div class="accordion-body">
                            Setelah pesanan diproses, pelanggan akan
                            menerima nomor resi pengiriman untuk
                            melacak status paket secara real-time.
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#faq4">
                            Apakah produk dapat dikembalikan?
                        </button>
                    </h2>

                    <div id="faq4"
                        class="accordion-collapse collapse"
                        data-bs-parent="#faqAccordion">

                        <div class="accordion-body">
                            Pengembalian produk hanya berlaku apabila
                            produk rusak, bocor, atau tidak sesuai
                            pesanan dengan batas maksimal 2×24 jam
                            setelah produk diterima.
                        </div>
                    </div>
                </div>

            </div>

        </div>

        {{-- HELP --}}
        <div class="help-box">
            <h3>Masih memiliki pertanyaan?</h3>

            <p>
                Tim layanan pelanggan Circle Scent siap membantu
                memberikan informasi lebih lanjut mengenai produk
                maupun pesanan Anda.
            </p>

            <a href="https://wa.me/628138251880"
                target="_blank"
                class="btn-contact">
                Hubungi Kami
            </a>
        </div>

    </div>
</section>

@endsection