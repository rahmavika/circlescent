@extends('admin.layouts.main')
@section('title', 'Data Produk')
@section('navProduk', 'active')
@section('content')

<div class="card product-card-header border-0 shadow-sm mb-4">
    <div class="card-body d-flex justify-content-between align-items-center">
        <div>
            <h3 class="fw-bold mb-1">Data Produk</h3>
            <small class="text-muted">Manajemen produk toko</small>
        </div>

        <div>
            <i class="bi bi-box-seam fs-2 text-primary"></i>
        </div>
    </div>
</div>
<a href="/dashboard-produk/create"
   class="btn btn-add-user mb-3">
    <i class="bi bi-plus-circle-fill me-2"></i>
    Tambah Produk
</a>

<table id=produkTable class="table table-dashboard">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Gender</th>
            <th>Usage</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($produks as $produk)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $produk->nama_produk }}</td>
            <td>{{ $produk->gender }}</td>
            <td>{{ $produk->usage }}</td>
            <td>{{ $produk->deskripsi }}</td>
            <td class="text-nowrap">
                <div class="d-flex align-items-center gap-2">

                    <button
                    type="button"
                    class="btn btn-info btn-sm btn-detail border-0 d-flex align-items-center justify-content-center"
                    data-nama="{{ $produk->nama_produk }}"
                    data-deskripsi="{{ $produk->deskripsi }}"
                    data-gender="{{ $produk->gender }}"
                    data-usage="{{ $produk->usage }}"
                    data-gambar='@json($produk->gambarProduk)'
                    title="Detail">

                    <i class="bi bi-eye"></i>

                </button>

                    <a href="/dashboard-produk/{{ $produk->id }}/edit"
                        class="btn btn-sm btn-primary border-0 d-flex align-items-center justify-content-center"
                        title="Edit">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                    <button type="button"
                        class="btn btn-danger btn-sm btn-delete border-0 d-flex align-items-center justify-content-center"
                        data-id="{{ $produk->id }}"
                        title="Hapus">
                        <i class="bi bi-trash-fill"></i>
                    </button>

                </div>

                <form id="form-delete-{{ $produk->id }}"
                    action="/dashboard-produk/{{ $produk->id }}"
                    method="POST"
                    class="d-none">
                    @csrf
                    @method('DELETE')
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="modal fade" id="detailModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content modern-detail-modal border-0">

            <div class="modal-header-custom">
                <div>
                    <span class="badge-detail">
                        Produk
                    </span>

                    <h4 class="modal-title-detail mb-0">
                        Detail Produk
                    </h4>
                </div>

            </div>

            <div class="modal-body px-4 pb-4">

                <div class="row g-4 align-items-stretch">

                    <!-- IMAGE -->
                    <div class="col-md-5">
                        <div class="detail-image-box h-100">

                            <div id="detailCarousel" class="carousel slide h-100" data-bs-ride="carousel">

                                <div class="carousel-inner h-100 overflow-hidden"
                                    id="detailCarouselInner">
                                </div>

                                <button class="carousel-control-prev" type="button"
                                    data-bs-target="#detailCarousel" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon"></span>
                                </button>

                                <button class="carousel-control-next" type="button"
                                    data-bs-target="#detailCarousel" data-bs-slide="next">
                                    <span class="carousel-control-next-icon"></span>
                                </button>

                            </div>

                        </div>
                    </div>

                    <!-- DETAIL -->
                    <div class="col-md-7">

                        <div class="detail-content">

                            <!-- TITLE -->
                            <h2 class="detail-title mb-2" id="detailNama"></h2>

                            <!-- BADGES -->
                            <div class="d-flex gap-2 mb-3">
                                <span class="badge-pill" id="detailGender"></span>
                                <span class="badge-pill dark" id="detailUsage"></span>
                            </div>

                            <!-- DESC -->
                            <p class="detail-desc mb-4" id="detailDeskripsi"></p>

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
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function () {
                const produkId = this.getAttribute('data-id');
                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: "Data yang dihapus tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('form-delete-' + produkId).submit();
                    }
                });
            });
        });
        document.querySelectorAll('.btn-detail').forEach(button => {
            button.addEventListener('click', function () {

                let nama = this.dataset.nama;
                let deskripsi = this.dataset.deskripsi;
                let gender = this.dataset.gender;
                let usage = this.dataset.usage;

                document.getElementById('detailNama').innerText = nama;
                document.getElementById('detailDeskripsi').innerText = deskripsi;

                document.getElementById('detailGender').innerText = gender;
                document.getElementById('detailUsage').innerText = usage;

                let gambar = JSON.parse(this.dataset.gambar);

                const carousel = document.getElementById('detailCarouselInner');
                carousel.innerHTML = '';

                gambar.forEach((item, index) => {
                    carousel.innerHTML += `
                        <div class="carousel-item ${index === 0 ? 'active' : ''}">
                            <img src="/storage/${item.gambar}" class="detail-image">
                        </div>
                    `;
                });

                let modal = new bootstrap.Modal(document.getElementById('detailModal'));
                modal.show();
            });
        });
        @if (session('pesan'))
            Swal.fire({
                title: 'Berhasil!',
                text: "{{ session('pesan') }}",
                icon: 'success',
                confirmButtonColor: '#0B773D'
            });
        @endif
    });
</script>
<script>
    $(document).ready(function() {
        $('#produkTable').DataTable({
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
@endpush

<style>
    /* ======================================
    PRODUCT PAGE ONLY
    ====================================== */
    .product-page{
        padding-top:10px;
    }

    /* ======================================
    HEADER CARD PRODUK
    ====================================== */
    .product-card-header{
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

    .product-card-header::before{
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

    .product-card-header .card-body{
        padding:34px;
    }

    .product-card-header h3{
        color:#fff;
        font-size:38px;
        font-weight:700;
    }

    .product-card-header small{
        color:rgba(255,255,255,.58)!important;
    }

    .product-card-header .bi-box-seam{
        color:#d4af37 !important;
    }

    /* ======================================
    BUTTON TAMBAH
    ====================================== */
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

    /* ======================================
    DATATABLE WRAPPER
    ====================================== */
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

    /* ======================================
    TABLE
    ====================================== */
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

    /* ======================================
    BUTTON AKSI
    ====================================== */
    .table-dashboard .btn-info,
    .table-dashboard .btn-primary,
    .table-dashboard .btn-danger{
        width:46px;
        height:46px;
        border:none !important;
        border-radius:16px !important;
        transition:.25s ease;
    }

    .table-dashboard .btn-info{
        background:
            rgba(212,175,55,.12)!important;
        color:#d4af37!important;
    }

    .table-dashboard .btn-primary{
        background:
            rgba(93,124,240,.14)!important;
        color:#89a5ff!important;
    }

    .table-dashboard .btn-danger{
        background:
            rgba(255,94,94,.12)!important;
        color:#ff7c7c!important;
    }

    .table-dashboard .btn-info:hover,
    .table-dashboard .btn-primary:hover,
    .table-dashboard .btn-danger:hover{
        transform:translateY(-2px);
    }

    /* ======================================
    DATATABLE INPUT
    ====================================== */
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

    /* ======================================
    MODAL DETAIL
    ====================================== */
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

    /* DETAIL IMAGE */
    .detail-image-box{
        border-radius:24px;
        overflow:hidden;
        background:#1b1b1b;
        padding:20px;
    }

    .detail-image{
        width:100%;
        max-height:240px;
        object-fit:contain;
    }

    /* CAROUSEL MODAL ONLY */
    #detailCarousel .carousel-item{
        overflow:hidden;
    }

    #detailCarousel .carousel-control-prev,
    #detailCarousel .carousel-control-next{
        width:45px;
    }

    #detailCarousel .carousel-control-prev-icon,
    #detailCarousel .carousel-control-next-icon{
        background-color:rgba(0,0,0,.35);
        border-radius:50%;
        padding:18px;
        background-size:65%;
    }

    .detail-content{
        padding:10px 5px;
    }

    #detailNama{
        color:#fff;
        font-weight:700;
        font-size:2rem;
    }

    #detailDeskripsi{
        color:rgba(255,255,255,.65);
        line-height:1.7;
    }

    .badge-pill{
        padding:6px 14px;
        border-radius:999px;
        font-size:12px;
        font-weight:600;
        background:#e9ecef;
        color:#333;
    }

    .badge-pill.dark{
        background:#111;
        color:#fff;
    }

    /* BUTTON MODAL */
    .btn-close-modern{
        background:
            linear-gradient(
                135deg,
                #111,
                #333
            );

        color:#fff;
        border:none;
        padding:12px;
        border-radius:14px;
        font-weight:600;
        transition:.2s;
    }

    .btn-close-modern:hover{
        transform:translateY(-2px);
    }
</style>
@endsection
