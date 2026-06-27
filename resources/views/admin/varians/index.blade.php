@extends('admin.layouts.main')
@section('title', 'Data Varian')
@section('navVarian', 'active')

@section('content')

<div class="card border-0 shadow-sm mb-4">
    <div class="card-body d-flex justify-content-between align-items-center">
        <div>
            <h3 class="fw-bold mb-1">Data Varian</h3>
            <small class="text-muted">Manajemen varian produk</small>
        </div>

        <div>
            <i class="bi bi-layers fs-2 text-primary"></i>
        </div>
    </div>
</div>

<a href="/dashboard-varian/create" class="btn btn-add-user mb-3">
    <i class="bi bi-plus-circle-fill me-2"></i>
    Tambah Varian
</a>

<table id="varianTable" class="table table-dashboard">
    <thead>
        <tr>
            <th>No</th>
            <th>Produk</th>
            <th>Level</th>
            <th>Ukuran</th>
            <th>Stok</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($varians as $varian)
        <tr>
            <td>{{ $loop->iteration }}</td>

            <td>{{ $varian->produk->nama_produk ?? '-' }}</td>

            <td>{{ $varian->level }}</td>
            <td>{{ $varian->ukuran }}</td>
            <td>{{ $varian->stok }}</td>
            <td>Rp {{ number_format($varian->harga, 0, ',', '.') }}</td>

            <td class="text-nowrap">
                <div class="d-flex gap-2">
                    <button type="button"
                        class="btn btn-stock btn-add"
                        data-bs-toggle="modal"
                        data-bs-target="#modalTambahStok-{{ $varian->id }}">
                        <i class="bi bi-plus-lg"></i>
                    </button>

                    <button type="button"
                        class="btn btn-stock btn-minus"
                        data-bs-toggle="modal"
                        data-bs-target="#modalKurangiStok-{{ $varian->id }}">
                        <i class="bi bi-dash-lg"></i>
                    </button>

                    <a href="{{ route('dashboard-varian.edit', $varian->id) }}"
                        class="btn btn-sm btn-primary border-0 d-flex align-items-center justify-content-center"
                        title="Edit">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                    <!-- Tombol Hapus -->
                        <button type="button"
                        class="btn btn-danger btn-sm btn-delete border-0 d-flex align-items-center justify-content-center"
                        data-id="{{ $varian->id }}"
                        title="Hapus">
                        <i class="bi bi-trash-fill"></i>
                    </button>

                    <!-- Form Hidden Delete -->
                    <form id="form-delete-{{ $varian->id }}"
                        action="{{ route('dashboard-varian.destroy', $varian->id) }}"
                        method="POST"
                        style="display: none;">

                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </td>
        </tr>
        <div class="modal fade" id="modalTambahStok-{{ $varian->id }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content modal-luxury border-0">

                    <form action="{{ route('stok.tambah', $varian->id) }}" method="POST">
                        @csrf

                        <div class="modal-header border-0">
                            <h5 class="modal-title text-gold fw-semibold">
                                Tambah Stok -
                                {{ $varian->produk->nama_produk ?? '-' }}
                                ({{ $varian->level }} - {{ $varian->ukuran }})
                            </h5>

                            <button type="button"
                                class="btn-close btn-close-white"
                                data-bs-dismiss="modal">
                            </button>
                        </div>

                        <div class="modal-body">
                            <label class="form-label text-soft">
                                Jumlah
                            </label>

                            <input type="number"
                                name="jumlah"
                                class="form-control input-luxury"
                                min="1"
                                required>
                        </div>

                        <div class="modal-footer border-0">
                            <button type="submit"
                                class="btn btn-gold w-100">
                                Simpan
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
        <div class="modal fade" id="modalKurangiStok-{{ $varian->id }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content modal-luxury border-0">

                    <form action="{{ route('stok.kurangi', $varian->id) }}" method="POST">
                        @csrf

                        <div class="modal-header border-0">
                            <h5 class="modal-title text-danger-soft fw-semibold">
                                Kurangi Stok -
                                {{ $varian->produk->nama_produk ?? '-' }}
                                ({{ $varian->level }} - {{ $varian->ukuran }})
                            </h5>

                            <button type="button"
                                class="btn-close btn-close-white"
                                data-bs-dismiss="modal">
                            </button>
                        </div>

                        <div class="modal-body">

                            <label class="form-label text-soft">
                                Jumlah
                            </label>

                            <input type="number"
                                name="jumlah"
                                class="form-control input-luxury mb-3"
                                min="1"
                                required>

                            <label class="form-label text-soft">
                                Keterangan
                            </label>

                            <input type="text"
                                name="keterangan"
                                class="form-control input-luxury"
                                placeholder="Penjualan / rusak / dll"
                                required>

                        </div>

                        <div class="modal-footer border-0">
                            <button type="submit"
                                class="btn btn-danger-soft w-100">
                                Simpan
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
        @endforeach
    </tbody>
</table>

<!-- MODAL DETAIL -->
<div class="modal fade" id="detailModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content modern-detail-modal border-0">

            <div class="modal-header-custom">
                <div>
                    <span class="badge-detail">Varian</span>
                    <h4 class="modal-title-detail mb-0">Detail Varian</h4>
                </div>
            </div>

            <div class="modal-body px-4 pb-4">

                <div class="detail-content">

                    <h2 class="detail-title mb-3" id="detailProduk"></h2>

                    <div class="d-flex gap-2 flex-wrap mb-3">
                        <span class="badge-pill" id="detailLevel"></span>
                        <span class="badge-pill dark" id="detailUkuran"></span>
                        <span class="badge-pill" id="detailStok"></span>
                        <span class="badge-pill dark" id="detailHarga"></span>
                    </div>

                    <button type="button"
                        class="btn-close-modern w-100"
                        data-bs-dismiss="modal">
                        Tutup
                    </button>

                </div>

            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    // DELETE
    document.querySelectorAll('.btn-delete').forEach(btn => {
        btn.addEventListener('click', function () {

            let id = this.dataset.id;

            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('form-delete-' + id).submit();
                }
            });

        });
    });

    // DETAIL
    document.querySelectorAll('.btn-detail').forEach(btn => {
        btn.addEventListener('click', function () {

            document.getElementById('detailProduk').innerText = this.dataset.produk;
            document.getElementById('detailLevel').innerText = "Level: " + this.dataset.level;
            document.getElementById('detailUkuran').innerText = "Ukuran: " + this.dataset.ukuran;
            document.getElementById('detailStok').innerText = "Stok: " + this.dataset.stok;

            document.getElementById('detailHarga').innerText =
                "Rp " + new Intl.NumberFormat('id-ID').format(this.dataset.harga);

            new bootstrap.Modal(document.getElementById('detailModal')).show();
        });
    });

});
</script>

<script>
    $(document).ready(function() {
        $('#varianTable').DataTable({
            paging: true,
            searching: true,
            ordering:  true,
            lengthChange: true,
            language: {
                "sSearch": "Cari:",
                "lengthMenu": "Tampilkan _MENU_ data per halaman",
                "zeroRecords": "Data tidak ditemukan",
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                "infoEmpty": "Tidak ada data",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Berikutnya",
                    "previous": "Sebelumnya"
                }
            }
        });
    });
</script>
<style>

.btn-stock{
    width:44px;
    height:44px;
    border-radius:14px;
    display:flex;
    align-items:center;
    justify-content:center;
    border:none;
    transition:.25s ease;
    box-shadow:0 8px 20px rgba(0,0,0,.25);
}

/* GOLD ADD (lebih glow premium) */
.btn-add{
    background: linear-gradient(135deg, #d4af37, #f7e7a9);
    color:#111;
    position:relative;
    overflow:hidden;
}

/* DARK RED MINUS (lebih soft elegant) */
.btn-minus{
    background: linear-gradient(135deg, #1f1f1f, #2e2e2e);
    color:#ff6b6b;
    border:1px solid rgba(255,107,107,.25);
}

/* HOVER EFFECT PREMIUM */
.btn-stock:hover{
    transform:translateY(-3px) scale(1.05);
    box-shadow:0 12px 28px rgba(0,0,0,.35);
}

/* ICON */
.btn-stock i{
    font-size:18px;
}

/* GOLD GLOW ANIMATION */
.btn-add::after{
    content:'';
    position:absolute;
    width:100%;
    height:100%;
    top:0;
    left:-100%;
    background: linear-gradient(120deg, transparent, rgba(255,255,255,.4), transparent);
    transition:.5s;
}

.btn-add:hover::after{
    left:100%;
}

.modal-luxury{
    background: linear-gradient(145deg, #141414, #0f0f0f);
    border-radius:22px;
    box-shadow:0 20px 60px rgba(0,0,0,.5);
}

/* TEXT */
.text-gold{
    color:#d4af37;
}

.text-danger-soft{
    color:#ff6b6b;
}

.text-soft{
    color:rgba(255,255,255,.65);
}

/* INPUT */
.input-luxury{
    background:#1b1b1b;
    border:1px solid rgba(255,255,255,.08);
    border-radius:14px;
    color:#fff;
    padding:10px 14px;
}

.input-luxury:focus{
    border-color:#d4af37;
    box-shadow:none;
    background:#1b1b1b;
    color:#fff;
}

/* BUTTON GOLD */
.btn-gold{
    background: linear-gradient(135deg, #d4af37, #f5e6a3);
    color:#111;
    font-weight:600;
    border-radius:14px;
    padding:10px;
}

/* BUTTON RED SOFT */
.btn-danger-soft{
    background: linear-gradient(135deg, #2b2b2b, #3a3a3a);
    color:#ff6b6b;
    border:1px solid rgba(255,107,107,.25);
    font-weight:600;
    border-radius:14px;
    padding:10px;
}
    .detail-content {
    padding: 10px 5px;
}

/* TITLE */
.detail-title {
    font-weight: 800;
    font-size: 2rem;
    color: #111;
    letter-spacing: -0.5px;
}

/* BADGE CUSTOM */
.badge-pill {
    padding: 6px 14px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 600;
    background: #e9ecef;
    color: #333;
}

.badge-pill.dark {
    background: #111;
    color: #fff;
}

/* DESC */
.detail-desc {
    color: #666;
    line-height: 1.7;
    font-size: 0.95rem;
}

/* INFO GRID */
.info-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 12px;
}

.info-card {
    padding: 12px;
    border-radius: 14px;
    background: #fafafa;
    border: 1px solid #eee;
}

.info-card small {
    display: block;
    color: #999;
    font-size: 11px;
}

.info-card b {
    font-size: 14px;
}

/* BUTTON */
.btn-close-modern {
    background: linear-gradient(135deg, #111, #333);
    color: #fff;
    border: none;
    padding: 12px;
    border-radius: 14px;
    font-weight: 600;
    transition: 0.2s;
}

.btn-close-modern:hover {
    transform: translateY(-2px);
}

.detail-image-box{
    border-radius:24px;
    overflow:hidden;
    background:#181818;
}

.detail-image{
    width:100%;
    height:380px;
    object-fit:cover;
    border-radius:24px;
}

.carousel-control-prev,
.carousel-control-next{
    width:45px;
}

.carousel-control-prev-icon,
.carousel-control-next-icon{
    background-color:rgba(0,0,0,.35);
    border-radius:50%;
    padding:18px;
    background-size:65%;
}

    /* =========================
    HEADER CARD
    ========================= */
    .card{
        border:none !important;
        border-radius:34px;
        overflow:hidden;
        position:relative;
        background:
            linear-gradient(
                135deg,
                #0d0d0d 0%,
                #171717 50%,
                #111111 100%
            ) !important;
        box-shadow:
            0 10px 40px rgba(0,0,0,.22);
    }

    .card::before{
        content:'';
        position:absolute;
        top:-100px;
        right:-100px;
        width:220px;
        height:220px;
        background:
            radial-gradient(
                rgba(212,175,55,.10),
                transparent 70%
            );
    }

    .card-body{
        padding:34px;
    }

    .card h3{
        color:#fff;
        font-size:38px;
        font-weight:700;
    }

    .card small{
        color:rgba(255,255,255,.58)!important;
    }

    .bi-box-seam{
        color:#d4af37 !important;
    }

    /* =========================
    BUTTON TAMBAH
    ========================= */
    .btn-add-user{
        background:
            linear-gradient(
                135deg,
                #b8924f,
                #d4af37,
                #ecd49c
            ) !important;

        border:none !important;
        border-radius:22px;
        color:#111 !important;
        padding:15px 28px;
        font-weight:700;
        transition:.3s ease;
        box-shadow:
            0 10px 30px rgba(212,175,55,.18);
    }

    .btn-add-user:hover{
        transform:translateY(-3px);
    }

    /* =========================
    TABLE WRAPPER
    ========================= */
    .dataTables_wrapper{
        margin-top:18px;
        background:
            linear-gradient(
                145deg,
                rgba(18,18,18,.96),
                rgba(24,24,24,.94)
            );

        border-radius:34px;
        padding:28px;
        border:1px solid rgba(255,255,255,.04);
        box-shadow:
            0 15px 45px rgba(0,0,0,.20);
    }

    /* =========================
    TABLE
    ========================= */
    .table-dashboard{
        width:100%;
        border-collapse:separate;
        border-spacing:0 14px;
    }

    .table-dashboard thead th{
        background:transparent;
        border:none;
        color:#d4af37;
        font-size:15px;
        font-weight:600;
        padding:0 18px 14px;
    }

    .table-dashboard tbody tr{
        background:
            linear-gradient(
                145deg,
                rgba(32,32,32,.95),
                rgba(21,21,21,.96)
            );

        transition:.35s ease;
        border-radius:22px;
    }

    .table-dashboard tbody tr:hover{
        transform:translateY(-3px);
        box-shadow:
            0 12px 28px rgba(212,175,55,.10);
    }

    .table-dashboard td{
        background:transparent !important;
        border:none !important;
        color:#f3f4f6;
        padding:22px 18px;
        vertical-align:middle;
    }

    .table-dashboard td:first-child{
        border-radius:22px 0 0 22px;
    }

    .table-dashboard td:last-child{
        border-radius:0 22px 22px 0;
    }

    /* IMAGE */
    .tab-image{
        width:70px !important;
        height:70px !important;
        object-fit:cover;
        border-radius:16px;
        border:2px solid rgba(212,175,55,.2);
    }

    /* =========================
    BUTTON AKSI
    ========================= */
    .btn-info,
    .btn-primary,
    .btn-danger{
        width:46px;
        height:46px;
        border:none !important;
        border-radius:16px !important;
        transition:.25s ease;
    }

    .btn-info{
        background:
            rgba(212,175,55,.12)!important;
        color:#d4af37!important;
    }

    .btn-primary{
        background:
            rgba(93,124,240,.14)!important;
        color:#89a5ff!important;
    }

    .btn-danger{
        background:
            rgba(255,94,94,.12)!important;
        color:#ff7c7c!important;
    }

    .btn-info:hover,
    .btn-primary:hover,
    .btn-danger:hover{
        transform:translateY(-2px);
    }

    /* =========================
    DATATABLE
    ========================= */
    .dataTables_filter label,
    .dataTables_length label,
    .dataTables_info{
        color:rgba(255,255,255,.72)!important;
    }

    .dataTables_filter input,
    .dataTables_length select{
        background:#1a1a1a !important;
        border:1px solid rgba(255,255,255,.08)!important;
        color:#fff !important;
        border-radius:18px !important;
        padding:10px 16px !important;
    }

    .dataTables_filter input:focus{
        border-color:#d4af37 !important;
        box-shadow:none !important;
    }

    .paginate_button{
        color:#d1d5db !important;
    }

    .paginate_button.current{
        background:
            linear-gradient(
                135deg,
                #b8924f,
                #d4af37
            ) !important;

        border:none !important;
        border-radius:14px !important;
        color:#111 !important;
    }

    /* =========================
    MODAL DETAIL
    ========================= */
    .modern-detail-modal{
        background:
            linear-gradient(
                145deg,
                #171717,
                #101010
            );
        border-radius:30px;
        color:#fff;
    }

    .modal-header-custom{
        padding:24px;
        border-bottom:
            1px solid rgba(255,255,255,.05);
    }

    .badge-detail{
        background:
            rgba(212,175,55,.12);
        color:#d4af37;
        padding:8px 14px;
        border-radius:999px;
    }

    .modal-title-detail{
        color:#fff;
        margin-top:10px;
    }

    .detail-image-box{
        background:#1b1b1b;
        border-radius:24px;
        padding:20px;
    }

    .detail-image{
        max-height:240px;
        object-fit:contain;
    }

    .detail-title{
        color:#fff;
        font-weight:700;
    }

    .detail-desc{
        color:rgba(255,255,255,.65);
    }

    .price-box{
        background:#1b1b1b;
        border-radius:20px;
        padding:18px;
    }

    .price-label{
        color:#9ca3af;
    }

    .price-value{
        font-size:28px;
        font-weight:700;
        color:#d4af37;
    }

    .modern-close-btn{
        border:none;
        border-radius:18px;
        background:
            linear-gradient(
                135deg,
                #b8924f,
                #d4af37
            );
        color:#111;
        font-weight:700;
        padding:14px;
    }
</style>
@endpush