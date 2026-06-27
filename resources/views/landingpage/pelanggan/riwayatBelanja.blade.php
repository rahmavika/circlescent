@extends('landingpage.layouts.main')
@section('content')

<style>
    body {
        background: linear-gradient(
            180deg,
            #000000 0%,
            #111111 50%,
            #000000 100%
        );
        color: #fff;
        min-height: 100vh;
    }

    section.py-5 {
        background: transparent;
        min-height: 100vh;
    }

    .card-clean {
        background: #ffffff;
        border-radius: 18px;
        border: 1px solid rgba(0,0,0,0.08);
        box-shadow:
            0 15px 40px rgba(0,0,0,0.35),
            0 0 20px rgba(255,255,255,0.05);
        overflow: hidden;
    }

    .title-clean::after {
        content: "";
        display: block;
        width: 80px;
        height: 2px;
        background: linear-gradient(to right, #000, #c9a227, #000);
        margin: 10px auto 0;
    }

    .table-clean {
        margin-bottom: 0;
    }

    .table-clean thead th {
        background: #000;
        color: #fff;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 1px;
        text-align: center;
        border: none;
        padding: 16px 12px;
        font-weight: 600;
    }

    .table-clean tbody tr {
        transition: all 0.3s ease;
    }

    .table-clean tbody tr:hover {
        background: #f8f8f8;
    }

    .table-clean td {
        font-size: 14px;
        color: #222;
        text-align: center;
        vertical-align: middle;
        padding: 16px 10px;
        border-color: #ececec;
    }

    .link-date {
        color: #000;
        text-decoration: none;
        font-weight: 600;
        transition: .3s;
    }

    .link-date:hover {
        color: #555;
    }

    /* STATUS */

    .status {
        font-size: 12px;
        padding: 7px 14px;
        border-radius: 30px;
        font-weight: 600;
        display: inline-block;
        letter-spacing: .3px;
    }

    .status-menunggu {
        background: #f3f4f6;
        color: #111827;
        border: 1px solid #e5e7eb;
    }

    .status-proses {
        background: #e5e7eb;
        color: #111827;
        border: 1px solid #d1d5db;
    }

    .status-kirim {
        background: #d1d5db;
        color: #000;
        border: 1px solid #9ca3af;
    }

    .status-selesai {
        background: #000;
        color: #fff;
        border: 1px solid #000;
    }

    .status-belum {
        background: #fafafa;
        color: #666;
        border: 1px solid #ddd;
    }

    .status-lunas {
        background: #000;
        color: #fff;
        border: 1px solid #000;
    }

    /* BUTTON */

    .btn-clean {
        background: #fff;
        color: #000;
        border: 1px solid #000;
        border-radius: 8px;
        padding: 8px 15px;
        font-size: 12px;
        font-weight: 600;
        transition: all .3s ease;
    }

    .btn-clean:hover {
        background: #000;
        color: #fff;
    }

    .btn-primary-clean {
        background: #000;
        color: #fff;
        border: 1px solid #000;
        border-radius: 8px;
        padding: 8px 15px;
        font-size: 12px;
        font-weight: 600;
        transition: all .3s ease;
    }

    .btn-primary-clean:hover {
        background: #222;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,.25);
    }

    /* TEXT INFO */

    .text-success-custom {
        color: #000;
        font-weight: 600;
    }

    .text-muted-custom {
        color: #9ca3af;
    }

    /* MODAL */

    .modal-custom {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        padding-top: 60px;
        background: rgba(0,0,0,0.92);
        backdrop-filter: blur(5px);
    }

    .modal-custom img {
        display: block;
        margin: auto;
        max-width: 85%;
        max-height: 85%;
        border-radius: 15px;
        border: 3px solid #fff;
        box-shadow: 0 15px 40px rgba(0,0,0,.6);
    }

    .close-btn {
        position: absolute;
        top: 20px;
        right: 35px;
        color: #fff;
        font-size: 38px;
        cursor: pointer;
        transition: .3s;
    }

    .close-btn:hover {
        transform: scale(1.1);
    }

    /* PAGINATION */

    .pagination {
        justify-content: center;
        margin-top: 20px;
    }

    .pagination .page-link {
        color: #000;
        border: 1px solid #ddd;
        padding: 8px 14px;
        margin: 0 3px;
        border-radius: 8px;
    }

    .pagination .page-link:hover {
        background: #000;
        color: #fff;
        border-color: #000;
    }

    .pagination .active .page-link {
        background: #000;
        border-color: #000;
        color: #fff;
    }

    /* MOBILE */

    @media (max-width: 768px) {

        .card-clean {
            padding: 15px !important;
        }

        .title-clean {
            font-size: 20px;
        }

        .table-clean td,
        .table-clean th {
            font-size: 12px;
            padding: 10px 6px;
        }

        .btn-clean,
        .btn-primary-clean {
            padding: 6px 10px;
            font-size: 11px;
        }

        .status {
            font-size: 11px;
            padding: 5px 10px;
        }
    }
</style>

<section class="py-5 mt-5">
    <div class="container">
        <div class="card card-clean p-4">
            <h4 class="text-center mb-4 title-clean">Riwayat Belanja</h4>
            <div class="table-responsive">
                <table class="table table-clean">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Total</th>
                            <th>Bukti</th>
                            <th>Status</th>
                            <th>Pembayaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($riwayatBelanja as $checkout)
                        <tr>
                            <td>
                                <a href="{{ route('checkout.detail', $checkout->id) }}" class="link-date">
                                    {{ \Carbon\Carbon::parse($checkout->tanggal_pemesanan)->format('d M Y') }}
                                </a>
                            </td>
                            <td>
                                Rp {{ number_format($checkout->total_harga, 0, ',', '.') }}
                            </td>
                            <td id="button-cell-{{ $checkout->id }}">
                                @if($checkout->metode_pembayaran === 'transfer')
                                    @if($checkout->bukti_transfer)
                                        <button class="btn-primary-clean"
                                            onclick="showPreview('{{ asset($checkout->bukti_transfer) }}')">
                                            Lihat
                                        </button>
                                    @else
                                        <button class="btn-clean"
                                            onclick="document.getElementById('fileInput{{ $checkout->id }}').click()">
                                            Upload
                                        </button>
                                        <input type="file"
                                            id="fileInput{{ $checkout->id }}"
                                            style="display:none;"
                                            onchange="uploadBukti({{ $checkout->id }})">
                                    @endif
                                @else
                                    <span style="font-size:12px; color:#6b7280;">
                                        Tidak diperlukan (COD)
                                    </span>
                                @endif
                            </td>
                            <td>
                                @switch($checkout->status)
                                    @case('pending')
                                        <span class="status status-menunggu">Pending</span>
                                    @break
                                    @case('diproses')
                                        <span class="status status-proses">Diproses</span>
                                    @break
                                    @case('dikirim')
                                        <span class="status status-kirim">Dikirim</span>
                                    @break
                                    @case('selesai')
                                        <span class="status status-selesai">Selesai</span>
                                    @break
                                @endswitch
                            </td>
                            <td>
                                @switch($checkout->status_pembayaran)
                                    @case('belum_lunas')
                                        <span class="status status-belum">Belum Bayar</span>
                                    @break
                                    @case('lunas')
                                        <span class="status status-lunas">Lunas</span>
                                    @break
                                @endswitch
                            </td>
                            <td>
                                @if($checkout->status === 'dikirim')

                                    <button class="btn-primary-clean"
                                        onclick="terimaPesanan({{ $checkout->id }})">
                                        Pesanan Diterima
                                    </button>

                                @elseif($checkout->status === 'pending')

                                    <button class="btn-clean"
                                        onclick="batalkanPesanan({{ $checkout->id }})">
                                        Batalkan
                                    </button>

                                @elseif($checkout->status === 'selesai')

                                    <span style="font-size:12px; color:#065f46; font-weight:600;">
                                        Sudah Diterima
                                    </span>

                                @elseif($checkout->status === 'dibatalkan')

                                    <span style="font-size:12px; color:#b91c1c; font-weight:600;">
                                        Dibatalkan
                                    </span>

                                @else

                                    <span style="font-size:12px; color:#9ca3af;">
                                        -
                                    </span>

                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4 text-center">
                {{ $riwayatBelanja->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</section>

<div id="previewModal" class="modal-custom">
    <span class="close-btn" onclick="closePreview()">×</span>
    <img id="previewImage">
</div>

<script>
    function batalkanPesanan(id) {
        if (!confirm('Yakin ingin membatalkan pesanan ini?')) return;

        fetch('/checkout/batal/' + id, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                alert('Pesanan dibatalkan');
                location.reload();
            } else {
                alert(data.message || 'Gagal membatalkan pesanan');
            }
        });
    }
    function showPreview(url) {
        document.getElementById('previewImage').src = url;
        document.getElementById('previewModal').style.display = 'block';
    }
    function closePreview() {
        document.getElementById('previewModal').style.display = 'none';
    }
    window.onclick = function(e) {
        let modal = document.getElementById('previewModal');
        if (e.target === modal) {
            modal.style.display = "none";
        }
    }
    document.addEventListener('keydown', function(e) {
        if (e.key === "Escape") closePreview();
    });
    function uploadBukti(id) {
        let fileInput = document.getElementById('fileInput' + id);
        let formData = new FormData();

        formData.append('bukti_transfer', fileInput.files[0]);
        formData.append('_token', '{{ csrf_token() }}');

        fetch('/upload-bukti/' + id, {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                alert('Berhasil upload');
                location.reload();
            }
        });
    }
    function terimaPesanan(id) {
        if (!confirm('Apakah pesanan sudah diterima?')) return;
        fetch('/checkout/terima/' + id, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                alert('Pesanan berhasil dikonfirmasi');
                location.reload();
            } else {
                alert('Gagal update status');
            }
        });
    }
</script>

@endsection