@extends('landingpage.layouts.main')

@section('title', 'Informasi Pengiriman')

@section('content')

<style>
    body{
        background: #0b0b0b;
        color: #fff;
    }

    .shipping-section{
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

    .shipping-wrapper{
        max-width: 950px;
        margin: 70px auto 0;
    }

    .shipping-card{
        background: rgba(255,255,255,.03);
        border: 1px solid rgba(255,255,255,.08);
        border-radius: 24px;
        padding: 35px;
        margin-bottom: 25px;
        backdrop-filter: blur(12px);
        transition: all .3s ease;
    }

    .shipping-card:hover{
        transform: translateY(-4px);
        border-color: rgba(255,255,255,.15);
        background: rgba(255,255,255,.05);
    }

    .shipping-card h4{
        color: #fff;
        margin-bottom: 18px;
        font-size: 22px;
        font-weight: 600;
    }

    .shipping-card p,
    .shipping-card li{
        color: rgba(255,255,255,.75);
        line-height: 1.9;
    }

    .shipping-card ul{
        padding-left: 20px;
        margin-bottom: 0;
    }

    .shipping-note{
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

    .shipping-note h3{
        margin-bottom: 15px;
        font-size: 30px;
        color: #fff;
    }

    .shipping-note p{
        color: rgba(255,255,255,.72);
        margin-bottom: 25px;
    }

    .btn-track{
        background: #fff;
        color: #000;
        padding: 14px 34px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        transition: .3s;
        display: inline-block;
    }

    .btn-track:hover{
        background: #e8e8e8;
        transform: translateY(-2px);
        color: #000;
    }

    @media(max-width:768px){
        .page-title{
            font-size: 34px;
        }

        .shipping-card{
            padding: 28px;
        }

        .shipping-note{
            padding: 35px 25px;
        }
    }
</style>

<section class="shipping-section">
    <div class="container">

        {{-- HEADER --}}
        <div class="text-center">
            <span class="small-title">
                Shipping Information
            </span>

            <h1 class="page-title">
                Informasi Pengiriman
            </h1>

            <p class="page-desc">
                Circle Scent melayani pengiriman ke seluruh Indonesia
                dengan pengemasan aman dan elegan untuk menjaga kualitas
                parfum tetap terjaga hingga sampai ke tangan Anda.
            </p>
        </div>

        {{-- CONTENT --}}
        <div class="shipping-wrapper">

            <div class="shipping-card">
                <h4>Waktu Pemrosesan Pesanan</h4>

                <p>
                    Pesanan akan diproses dalam waktu 1–2 hari kerja
                    setelah pembayaran berhasil diverifikasi.
                    Pemesanan pada akhir pekan atau hari libur nasional
                    akan diproses pada hari kerja berikutnya.
                </p>
            </div>

            <div class="shipping-card">
                <h4>Estimasi Pengiriman</h4>

                <ul>
                    <li><strong>Sumatera:</strong> 2–4 hari kerja</li>
                    <li><strong>Jawa:</strong> 2–5 hari kerja</li>
                    <li><strong>Kalimantan & Sulawesi:</strong> 3–7 hari kerja</li>
                    <li><strong>Wilayah lainnya:</strong> menyesuaikan lokasi tujuan dan ekspedisi</li>
                </ul>
            </div>

            <div class="shipping-card">
                <h4>Keamanan Pengemasan</h4>

                <p>
                    Seluruh produk Circle Scent dikemas menggunakan
                    perlindungan tambahan untuk meminimalkan risiko
                    kerusakan, kebocoran, atau pecah selama proses
                    pengiriman.
                </p>
            </div>

            <div class="shipping-card">
                <h4>Pelacakan Pesanan</h4>

                <p>
                    Setelah pesanan dikirim, pelanggan akan menerima
                    nomor resi pengiriman yang dapat digunakan untuk
                    memantau status paket secara langsung melalui
                    layanan ekspedisi terkait.
                </p>
            </div>

        </div>

        {{-- NOTE --}}
        <div class="shipping-note">
            <h3>Butuh Bantuan Pengiriman?</h3>

            <p>
                Jika mengalami kendala pada proses pengiriman atau
                ingin mengetahui status pesanan, tim Circle Scent
                siap membantu Anda.
            </p>

            <a href="https://wa.me/628138251880"
                target="_blank"
                class="btn-track">
                Hubungi Kami
            </a>
        </div>

    </div>
</section>

@endsection