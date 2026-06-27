@extends('landingpage.layouts.main')

@section('title', 'Kebijakan Privasi')

@section('content')

<style>
    body{
        background: #0b0b0b;
        color: #fff;
    }

    .privacy-section{
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
        margin-bottom: 12px;
    }

    .page-title{
        font-size: 48px;
        font-weight: 700;
        margin-bottom: 20px;
        color: #fff;
    }

    .page-desc{
        max-width: 800px;
        color: rgba(255,255,255,.72);
        line-height: 1.9;
        margin: auto;
    }

    .policy-wrapper{
        max-width: 950px;
        margin: 70px auto 0;
    }

    .policy-card{
        background: rgba(255,255,255,.03);
        border: 1px solid rgba(255,255,255,.08);
        border-radius: 24px;
        padding: 35px;
        margin-bottom: 25px;
        backdrop-filter: blur(12px);
        transition: all .3s ease;
    }

    .policy-card:hover{
        transform: translateY(-4px);
        border-color: rgba(255,255,255,.15);
        background: rgba(255,255,255,.05);
    }

    .policy-card h4{
        color: #fff;
        font-size: 22px;
        margin-bottom: 18px;
        font-weight: 600;
    }

    .policy-card p{
        color: rgba(255,255,255,.75);
        line-height: 1.9;
        margin-bottom: 0;
    }

    .policy-card ul{
        padding-left: 18px;
        color: rgba(255,255,255,.75);
        line-height: 2;
    }

    .contact-box{
        margin-top: 70px;
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

    .contact-box h3{
        margin-bottom: 15px;
        font-size: 30px;
        color: #fff;
    }

    .contact-box p{
        color: rgba(255,255,255,.72);
        margin-bottom: 25px;
    }

    .btn-contact{
        background: #fff;
        color: #000;
        padding: 14px 35px;
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

        .policy-card{
            padding: 28px;
        }

        .contact-box{
            padding: 35px 25px;
        }
    }
</style>

<section class="privacy-section">
    <div class="container">

        {{-- HEADER --}}
        <div class="text-center">
            <span class="small-title">
                Privacy & Security
            </span>

            <h1 class="page-title">
                Kebijakan Privasi
            </h1>

            <p class="page-desc">
                Circle Scent menghargai privasi pelanggan dan berkomitmen
                untuk menjaga keamanan informasi pribadi yang diberikan
                selama penggunaan layanan, pembelian produk, maupun
                interaksi dengan website kami.
            </p>
        </div>

        {{-- CONTENT --}}
        <div class="policy-wrapper">

            <div class="policy-card">
                <h4>Informasi yang Kami Kumpulkan</h4>

                <p>
                    Kami dapat mengumpulkan beberapa informasi pelanggan
                    untuk kebutuhan transaksi dan pelayanan, meliputi:
                </p>

                <ul>
                    <li>Nama lengkap pelanggan</li>
                    <li>Alamat email</li>
                    <li>Nomor telepon</li>
                    <li>Alamat pengiriman</li>
                    <li>Riwayat transaksi pembelian</li>
                </ul>
            </div>

            <div class="policy-card">
                <h4>Penggunaan Informasi</h4>

                <p>
                    Informasi pelanggan digunakan untuk memproses pesanan,
                    mengatur pengiriman, memberikan pembaruan status
                    transaksi, meningkatkan kualitas layanan, serta
                    menghadirkan pengalaman belanja yang lebih nyaman
                    di Circle Scent.
                </p>
            </div>

            <div class="policy-card">
                <h4>Keamanan Data</h4>

                <p>
                    Kami menjaga keamanan data pelanggan melalui langkah
                    perlindungan yang wajar dan tidak membagikan informasi
                    pribadi kepada pihak ketiga tanpa izin pelanggan,
                    kecuali apabila diwajibkan oleh hukum atau proses
                    pengiriman pesanan.
                </p>
            </div>

            <div class="policy-card">
                <h4>Perubahan Kebijakan</h4>

                <p>
                    Circle Scent dapat memperbarui kebijakan privasi
                    sewaktu-waktu untuk menyesuaikan perkembangan layanan
                    dan kebutuhan operasional. Perubahan akan diinformasikan
                    melalui halaman ini.
                </p>
            </div>

        </div>

        {{-- CONTACT --}}
        <div class="contact-box">
            <h3>Butuh Bantuan?</h3>

            <p>
                Jika memiliki pertanyaan mengenai kebijakan privasi
                atau keamanan data pelanggan, silakan hubungi tim
                layanan pelanggan Circle Scent.
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