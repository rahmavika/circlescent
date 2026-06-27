@extends('admin.layouts.main')
@section('title', 'Data Pengguna')
@section('navUser', 'active')
@section('content')

<div class="card border-0 shadow-sm mb-4">
    <div class="card-body d-flex justify-content-between align-items-center">
        <div>
            <h3 class="fw-bold mb-1">Data Pengguna</h3>
            <small class="text-muted">Kelola akun dan hak akses pengguna sistem</small>
        </div>

        <div>
            <i class="bi bi-people-fill fs-2 text-info"></i>
        </div>
    </div>
</div>
<a href="/dashboard-pengguna/create"
   class="btn btn-add-user mb-3">
    <i class="bi bi-person-plus-fill me-2"></i>
    Tambah Pengguna
</a>
<table id=userTable class="table table-dashboard">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Lengkap</th>
            <th>Email</th>
            <th>No HP</th>
            <th>Role</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->phone }}</td>
            <td>{{ $user->role }}</td>
            <td class="text-nowrap d-flex align-items-center gap-2">
                <button type="button"
                    class="btn btn-info btn-sm btn-detail border-0 d-flex align-items-center justify-content-center"
                    data-name="{{ $user->name }}"
                    data-email="{{ $user->email }}"
                    data-phone="{{ $user->phone }}"
                    data-role="{{ $user->role }}"
                    title="Detail">
                    <i class="bi bi-eye"></i>
                </button>

                <a href="/dashboard-pengguna/{{ $user->id }}/edit"
                    class="btn btn-sm btn-primary border-0 d-flex align-items-center justify-content-center"
                    title="Edit">
                    <i class="bi bi-pencil-square"></i>
                </a>

                <button type="button"
                    class="btn btn-danger btn-sm btn-delete border-0 d-flex align-items-center justify-content-center"
                    data-id="{{ $user->id }}"
                    title="Hapus">
                    <i class="bi bi-trash-fill"></i>
                </button>

                <form id="form-delete-{{ $user->id }}"
                    action="/dashboard-pengguna/{{ $user->id }}"
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

<div class="modal fade" id="detailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content dark-modal">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-person-badge-fill me-2"></i>
                    Detail Pengguna
                </h5>
                <button type="button"class="btn-close btn-close-white"data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="detail-box">
                    <div class="detail-label">
                        <i class="bi bi-person-fill"></i>
                        Nama Lengkap
                    </div>
                    <div class="detail-value" id="detailNama"></div>
                </div>
                <div class="detail-box">
                    <div class="detail-label">
                        <i class="bi bi-envelope-fill"></i>
                        Email
                    </div>
                    <div class="detail-value" id="detailEmail"></div>
                </div>
                <div class="detail-box">
                    <div class="detail-label">
                        <i class="bi bi-telephone-fill"></i>
                        No HP
                    </div>
                    <div class="detail-value" id="detailPhone"></div>
                </div>
                <div class="detail-box">
                    <div class="detail-label">
                        <i class="bi bi-shield-lock-fill"></i>
                        Role
                    </div>
                    <div class="detail-value" id="detailRole"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-dark-modern" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-1"></i>
                    Tutup
                </button>
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
                const userId = this.getAttribute('data-id');
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
                        document.getElementById('form-delete-' + userId).submit();
                    }
                });
            });
        });
        document.querySelectorAll('.btn-detail').forEach(button => {
            button.addEventListener('click', function () {
                document.getElementById('detailNama').innerText = this.dataset.name;
                document.getElementById('detailEmail').innerText = this.dataset.email;
                document.getElementById('detailPhone').innerText = this.dataset.phone;
                document.getElementById('detailRole').innerText = this.dataset.role;

                var modal = new bootstrap.Modal(document.getElementById('detailModal'));
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
        $('#userTable').DataTable({
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
    /* =========================
       PAGE CONTENT
    ========================= */
    .content-page,
    .main-content,
    body{
        background:
            linear-gradient(
                180deg,
                #111214 0%,
                #161616 100%
            ) !important;
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
        font-size:42px;
        font-weight:700;
        margin-bottom:6px;
    }

    .card small{
        color:rgba(255,255,255,.55)!important;
        font-size:14px;
    }

    .bi-people-fill{
        color:#d4af37 !important;
        font-size:42px !important;
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
        letter-spacing:.2px;
        transition:.3s ease;
        box-shadow:
            0 10px 30px rgba(212,175,55,.18);
    }

    .btn-add-user:hover{
        transform:translateY(-3px);
        box-shadow:
            0 16px 35px rgba(212,175,55,.28);
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
       FILTER TEXT
    ========================= */
    .dataTables_length label,
    .dataTables_filter label,
    .dataTables_info{
        color:rgba(255,255,255,.72)!important;
        font-weight:500;
    }

    /* =========================
       SEARCH INPUT
    ========================= */
    .dataTables_filter input,
    .dataTables_length select{
        background:#1a1a1a !important;
        border:1px solid rgba(255,255,255,.08)!important;
        color:#fff !important;
        border-radius:18px !important;
        padding:10px 16px !important;
        outline:none !important;
    }

    .dataTables_filter input:focus{
        border-color:#d4af37 !important;
        box-shadow:
            0 0 0 3px rgba(212,175,55,.10) !important;
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

    /* TABLE ROW */
    .table-dashboard tbody tr{
        background:
            linear-gradient(
                145deg,
                rgba(32,32,32,.95),
                rgba(21,21,21,.96)
            );
        transition:.35s ease;
        border-radius:22px;
        overflow:hidden;
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

    /* rounded row */
    .table-dashboard td:first-child{
        border-radius:22px 0 0 22px;
    }

    .table-dashboard td:last-child{
        border-radius:0 22px 22px 0;
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
       PAGINATION
    ========================= */
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
       MODAL
    ========================= */
    .dark-modal{
        border:none;
        border-radius:32px;
        overflow:hidden;
        background:
            linear-gradient(
                145deg,
                #171717,
                #101010
            );
        color:#fff;
    }

    .dark-modal .modal-header{
        border-bottom:
            1px solid rgba(255,255,255,.05);
        background:#111;
    }

    .dark-modal .modal-title{
        color:#d4af37;
    }

    .detail-box{
        background:#1a1a1a;
        border-radius:18px;
        padding:16px;
        margin-bottom:14px;
        border:1px solid rgba(255,255,255,.04);
    }

    .detail-label{
        color:rgba(255,255,255,.55);
        font-size:13px;
    }

    .detail-value{
        color:#fff;
        font-weight:600;
    }

    .dark-modal .modal-footer{
        border-top:
            1px solid rgba(255,255,255,.05);
        background:#101010;
    }

    .btn-dark-modern{
        border:none;
        border-radius:16px;
        background:
            linear-gradient(
                135deg,
                #b8924f,
                #d4af37
            );
        color:#111;
        font-weight:700;
        padding:12px 22px;
    }

    /* =========================
       RESPONSIVE
    ========================= */
    @media(max-width:768px){

        .card h3{
            font-size:30px;
        }

        .btn-add-user{
            width:100%;
        }

        .dataTables_wrapper{
            overflow-x:auto;
        }
    }
    </style>
@endsection
