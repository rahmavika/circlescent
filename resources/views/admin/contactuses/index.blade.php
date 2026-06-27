@extends('admin.layouts.main')
@section('title', 'Data Pertanyaan')
@section('navContactUs', 'active')

@section('content')

<div class="card border-0 shadow-sm mb-4">
    <div class="card-body d-flex justify-content-between align-items-center">
        <div>
            <h3 class="fw-bold mb-1">
                Contact Us
            </h3>

            <small class="text-muted">
                Kelola pesan dan pertanyaan dari pelanggan
            </small>
        </div>

        <div>
            <i class="bi bi-chat-dots-fill fs-2 text-warning"></i>
        </div>
    </div>
</div>

<table id="pertanyaanTable" class="table table-dashboard">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Pertanyaan</th>
            <th>Jawaban</th>
            <th width="140">Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($questions as $question)
        <tr>
            <td>{{ $loop->iteration }}</td>

            <td>
                {{ $question->nama }}
            </td>

            <td>
                {{ $question->email }}
            </td>

            <td>
                {{ Str::limit($question->pertanyaan, 50) }}
            </td>

            <td>
                {{ $question->jawaban ? Str::limit($question->jawaban, 50) : '-' }}
            </td>

            <td>
                <div class="d-flex align-items-center gap-2">

                    <a href="{{ route('contactuses.edit', $question->id) }}"
                        class="btn btn-sm btn-primary border-0 d-flex align-items-center justify-content-center"
                        title="Jawab / Edit">
                        <i class="bi bi-pencil-square"></i>
                    </a>

                    <button type="button"
                        class="btn btn-danger btn-sm btn-delete border-0 d-flex align-items-center justify-content-center"
                        data-id="{{ $question->id }}"
                        title="Hapus">
                        <i class="bi bi-trash-fill"></i>
                    </button>

                </div>

                <form id="form-delete-{{ $question->id }}"
                    action="{{ route('contactuses.destroy', $question->id) }}"
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

<style>
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
    }

    .card small{
        color:rgba(255,255,255,.58)!important;
    }

    .bi-chat-dots-fill{
        color:#d4af37 !important;
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

    .table-dashboard td:first-child{
        border-radius:22px 0 0 22px;
    }

    .table-dashboard td:last-child{
        border-radius:0 22px 22px 0;
    }

    /* =========================
    BUTTON AKSI
    ========================= */
    .btn-primary,
    .btn-danger{
        width:46px;
        height:46px;
        border:none !important;
        border-radius:16px !important;
        transition:.25s ease;
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
</style>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.btn-delete')
    .forEach(button => {

        button.addEventListener('click', function () {

            const id = this.dataset.id;

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
                    document
                    .getElementById('form-delete-' + id)
                    .submit();
                }
            });
        });
    });

    @if (session('success'))
    Swal.fire({
        title: 'Berhasil!',
        text: "{{ session('success') }}",
        icon: 'success',
        confirmButtonColor: '#d4af37'
    });
    @endif

    $('#pertanyaanTable').DataTable({
        paging:true,
        searching:true,
        ordering:true,
        lengthChange:true,
        language:{
            sSearch:"Cari:",
            lengthMenu:"Tampilkan _MENU_ data per halaman",
            zeroRecords:"Data tidak ditemukan",
            info:"Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            infoEmpty:"Tidak ada data",
            paginate:{
                first:"Pertama",
                last:"Terakhir",
                next:"Berikutnya",
                previous:"Sebelumnya"
            }
        }
    });
});
</script>
@endpush

@endsection