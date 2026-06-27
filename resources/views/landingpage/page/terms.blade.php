@extends('landingpage.layouts.main')

@section('title', 'Syarat & Ketentuan')

@section('content')

<style>
    body{
        background: #0b0b0b;
        color: #fff;
    }

    .terms-section{
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
        margin: auto;
        color: rgba(255,255,255,.72);
        line-height: 1.9;
    }

    .terms-wrapper{
        max-width: 950px;
        margin: 70px auto 0;
    }

    .terms-card{
        background: rgba(255,255,255,.03);
        border: 1px solid rgba(255,255,255,.08);
        border-radius: 24px;
        padding: 35px;
        margin-bottom: 25px;
        backdrop-filter: blur(12px);
        transition: all .3s ease;
    }

    .terms-card:hover{
        transform: translateY(-4px);
        border-color: rgba(255,255,255,.15);
        background: rgba(255,255,255,.05);
    }

    .terms-card h4{
        color: #fff;
        margin-bottom: 18px;
        font-size: 22px;
        font-weight: 600;
    }

    .terms-card p,
    .terms-card li{
        color: rgba(255,255,255,.75);
        line-height: 1.9;
    }

    .terms-card ul{
        padding-left: 20px;
        margin-bottom: 0;
    }

    .terms-note{
        margin-top: 60px;
        background:
            linear-gradient(
                135deg,
                rgba(255,255,255,.08),
                rgba(255,255,255,.02)
            );
        border: 1px solid rgba(255,255,255,.08);
        border-radius: 30px;
        padding: 45px;
        text-align: center;
        backdrop-filter: blur(10px);
    }

    .terms-note h3{
        margin-bottom: 15px;
        font-size: 30px;
        color: #fff;
    }

    .terms-note p{
        color: rgba(255,255,255,.72);
        margin-bottom: 25px;
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

        .terms-card{
            padding: 28px;
        }

        .terms-note{
            padding: 35px 25px;
        }
    }
</style>

<section class="terms-section">
    <div class="container">

        {{-- HEADER --}}
        <div class="text-center">
            <span class="small-title">
                Terms & Conditions
            </span>

            <h1 class="page-title">
                Syarat & Ketentuan
            </h1>

            <p class="page-desc">
                Dengan mengakses website dan melakukan pembelian
                di Circle Scent, pelanggan dianggap telah membaca,
                memahami, dan menyetujui seluruh syarat serta
                ketentuan yang berlaku.
            </p>
        </div>

        {{-- CONTENT --}}
        <div class="terms-wrapper">

            <div class="terms-card">
                <h4>Pemesanan & Pembayaran</h4>

                <p>
                    Seluruh pesanan akan diproses setelah pembayaran
                    berhasil diverifikasi melalui metode pembayaran
                    yang tersedia di website Circle Scent.
                </p>
            </div>

            <div class="terms-card">
                <h4>Ketersediaan Produk</h4>

                <p>
                    Ketersediaan stok produk dapat berubah sewaktu-waktu.
                    Apabila produk yang dipesan tidak tersedia,
                    pelanggan akan dihubungi untuk proses penggantian
                    produk atau pengembalian dana sesuai kebijakan.
                </p>
            </div>

            <div class="terms-card">
                <h4>Pengiriman Produk</h4>

                <p>
                    Estimasi waktu pengiriman mengikuti wilayah tujuan
                    dan kebijakan jasa ekspedisi. Circle Scent tidak
                    bertanggung jawab atas keterlambatan yang disebabkan
                    oleh pihak ekspedisi atau kondisi tertentu di luar
                    kendali kami.
                </p>
            </div>

            <div class="terms-card">
                <h4>Pengembalian Produk</h4>

                <p>
                    Pengembalian produk hanya berlaku apabila produk
                    mengalami kerusakan, kebocoran, kesalahan pengiriman,
                    atau ketidaksesuaian pesanan dengan batas pelaporan
                    maksimal 2×24 jam setelah produk diterima.
                </p>
            </div>

            <div class="terms-card">
                <h4>Perubahan Ketentuan</h4>

                <p>
                    Circle Scent berhak memperbarui syarat dan ketentuan
                    sewaktu-waktu tanpa pemberitahuan sebelumnya.
                    Perubahan akan ditampilkan melalui halaman ini.
                </p>
            </div>

        </div>

        {{-- HELP --}}
        <div class="terms-note">
            <h3>Masih Ada Pertanyaan?</h3>

            <p>
                Jika Anda memerlukan informasi lebih lanjut mengenai
                syarat dan ketentuan Circle Scent, silakan hubungi
                layanan pelanggan kami.
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