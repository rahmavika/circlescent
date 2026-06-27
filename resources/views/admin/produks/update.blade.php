@extends('admin.layouts.main')

@section('title', 'Edit Produk')
@section('navProduk', 'active')

@section('content')

<div class="container py-4">

    <!-- HEADER -->
    <div class="card border-0 shadow-sm mb-4 product-header">
        <div class="card-body d-flex justify-content-between align-items-center">

            <div>
                <h3 class="fw-bold mb-1">
                    Edit Produk
                </h3>

                <small class="text-muted">
                    Perbarui informasi produk CircleScent
                </small>
            </div>

            <div class="header-icon">
                <i class="bi bi-pencil-square"></i>
            </div>

        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-xl-9 col-lg-10">

            <div class="product-card">

                <form action="/dashboard-produk/{{ $produk->id }}"
                    method="POST"
                    enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <div class="row g-4">

                        <!-- LEFT -->
                        <div class="col-lg-6">

                            <div>
                                <label class="form-label">
                                    Nama Produk
                                </label>

                                <input type="text"
                                    class="form-control @error('nama_produk') is-invalid @enderror"
                                    name="nama_produk"
                                    value="{{ old('nama_produk', $produk->nama_produk) }}"
                                    placeholder="Masukkan nama parfum">

                                @error('nama_produk')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div>
                                <label class="form-label mt-3">
                                    Gender
                                </label>

                                <select class="form-select @error('gender') is-invalid @enderror"
                                    name="gender">

                                    <option value="">
                                        -- Pilih Gender --
                                    </option>

                                    <option value="Male"
                                        {{ old('gender', $produk->gender) == 'Male' ? 'selected' : '' }}>
                                        Male
                                    </option>

                                    <option value="Female"
                                        {{ old('gender', $produk->gender) == 'Female' ? 'selected' : '' }}>
                                        Female
                                    </option>

                                    <option value="Unisex"
                                        {{ old('gender', $produk->gender) == 'Unisex' ? 'selected' : '' }}>
                                        Unisex
                                    </option>

                                </select>

                                @error('gender')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
<!-- GAMBAR LAMA -->
<div class="mt-4">

    <label class="form-label">
        Gambar Produk Saat Ini
    </label>

    <div class="row">

        @forelse($produk->gambarProduk as $gambar)

            <div class="col-md-4 mb-3">

                <div class="image-card position-relative">

                    <img
                        src="{{ asset('storage/'.$gambar->gambar) }}"
                        class="product-image">

                        <button
                        type="button"
                        class="btn btn-danger btn-sm delete-btn"
                        onclick="hapusGambar({{ $gambar->id }}, this)">

                        <i class="bi bi-x-lg"></i>
                    </button>

                </div>

            </div>

        @empty

            <p class="text-muted">
                Belum ada gambar produk
            </p>

        @endforelse

    </div>

</div>

<!-- TAMBAH GAMBAR BARU -->
<div class="mt-4">

    <label class="form-label">
        Tambah Gambar Baru
    </label>

    <input
        type="file"
        name="gambar[]"
        id="gambar"
        multiple
        class="form-control
        @error('gambar.*') is-invalid @enderror">

    <small class="upload-info">
        Bisa pilih lebih dari 1 gambar
    </small>

    @error('gambar.*')
        <div class="invalid-feedback d-block">
            {{ $message }}
        </div>
    @enderror

    <!-- PREVIEW -->
    <div class="row mt-3"
        id="preview-container">
    </div>

</div>
                        </div>

                        <!-- RIGHT -->
                        <div class="col-lg-6">

                            <div>
                                <label class="form-label">
                                    Usage
                                </label>

                                <select class="form-select @error('usage') is-invalid @enderror"
                                    name="usage">

                                    <option value="">
                                        -- Pilih Usage --
                                    </option>

                                    <option value="Indoor"
                                        {{ old('usage', $produk->usage) == 'Indoor' ? 'selected' : '' }}>
                                        Indoor
                                    </option>

                                    <option value="Outdoor"
                                        {{ old('usage', $produk->usage) == 'Outdoor' ? 'selected' : '' }}>
                                        Outdoor
                                    </option>
                                    <option value="Inoutdoor"
                                        {{ old('usage', $produk->usage) == 'Inoutdoor' ? 'selected' : '' }}>
                                        Indoor & Outdoor
                                    </option>

                                </select>

                                @error('usage')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div>
                                <label class="form-label mt-3">
                                    Deskripsi
                                </label>

                                <textarea
                                    class="form-control @error('deskripsi') is-invalid @enderror"
                                    name="deskripsi"
                                    rows="6"
                                    placeholder="Deskripsi produk parfum">{{ old('deskripsi', $produk->deskripsi) }}</textarea>

                                @error('deskripsi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>


                        </div>

                    </div>

                    <!-- BUTTON -->
                    <div class="d-flex justify-content-end gap-3 mt-4 flex-wrap">

                        <a href="/dashboard-produk"
                            class="btn btn-cancel px-4">
                            Kembali
                        </a>

                        <button type="submit"
                            class="btn btn-save px-4">

                            <i class="bi bi-check-circle me-2"></i>
                            Update Produk

                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>

</div>

<style>
/* IMAGE CARD */
.image-card{
    position:relative;
    background:#1b1b1b;
    border-radius:22px;
    overflow:hidden;
    border:1px solid rgba(255,255,255,.06);
}

.product-image{
    width:100%;
    height:180px;
    object-fit:cover;
}

/* DELETE BUTTON */
.delete-btn{
    position:absolute;
    top:10px;
    right:10px;
}

.delete-btn button{
    width:36px;
    height:36px;
    border-radius:50%;
    padding:0;
}

/* PREVIEW */
.preview-card{
    background:#1a1a1a;
    border-radius:20px;
    padding:10px;
}

.preview-image{
    width:100%;
    height:150px;
    object-fit:cover;
    border-radius:16px;
}

.file-name{
    color:#aaa;
    font-size:12px;
    margin-top:8px;
    display:block;
    word-break:break-word;
}

/* HEADER */
.product-header{
    border-radius:28px;
    overflow:hidden;
    background:linear-gradient(135deg,#101010,#181818);
}

.product-header .card-body{
    padding:28px 34px;
}

.product-header h3{
    font-size:32px;
    color:#fff;
}

.product-header small{
    color:rgba(255,255,255,.65)!important;
}

.header-icon{
    width:70px;
    height:70px;
    border-radius:22px;
    display:flex;
    align-items:center;
    justify-content:center;
    background:rgba(212,175,55,.12);
}

.header-icon i{
    font-size:32px;
    color:#d4af37;
}

/* FORM */
.product-card{
    background:#161616;
    border-radius:30px;
    padding:35px;
    box-shadow:
        0 10px 40px rgba(0,0,0,.18);
}

.form-label{
    color:#d4af37;
    font-weight:600;
    margin-bottom:10px;
}

.form-control,
.form-select{
    height:56px;
    background:#1e1e1e !important;
    border:1px solid rgba(255,255,255,.08)!important;
    border-radius:18px !important;
    color:#fff !important;
}

textarea.form-control{
    min-height:170px;
    resize:none;
    padding-top:16px !important;
}

.form-control:focus,
.form-select:focus{
    border-color:#d4af37 !important;
    box-shadow:
        0 0 0 4px rgba(212,175,55,.08);
}

.form-control::placeholder{
    color:#8a8a8a;
}

.form-select option{
    background:#1a1a1a;
    color:#fff;
}

/* FILE INFO */
.upload-info{
    display:block;
    margin-top:10px;
    color:#9a9a9a;
    font-size:14px;
}

/* PREVIEW IMAGE */
.preview-wrapper{
    display:flex;
    align-items:center;
    gap:15px;
}

.preview-image{
    width:120px;
    height:120px;
    border-radius:22px;
    overflow:hidden;
    border:2px solid rgba(212,175,55,.18);
    background:#1d1d1d;
}

.preview-image img{
    width:100%;
    height:100%;
    object-fit:cover;
}

/* BUTTON */
.btn-save{
    background:linear-gradient(
        135deg,
        #b8924f,
        #d4af37
    ) !important;

    border:none;
    color:#111 !important;
    border-radius:16px;
    height:54px;
    font-weight:700;
}

.btn-cancel{
    background:#262626 !important;
    color:#fff !important;
    border:none;
    border-radius:16px;
    height:54px;
}

/* ERROR */
.invalid-feedback{
    color:#ff7c7c;
}

/* MOBILE */
@media(max-width:768px){

    .product-card{
        padding:24px;
    }

    .product-header .card-body{
        padding:24px;
    }

    .header-icon{
        width:55px;
        height:55px;
    }

    .d-flex.justify-content-end{
        flex-direction:column;
    }

    .btn-save,
    .btn-cancel{
        width:100%;
    }
}
.remove-image{
    position:absolute;
    top:10px;
    right:10px;
    width:30px;
    height:30px;
    border:none;
    border-radius:50%;
    background:#dc3545;
    color:#fff;
    font-size:18px;
    cursor:pointer;
}
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const input =
            document.getElementById('gambar');

        const previewContainer =
            document.getElementById(
                'preview-container'
            );

        let selectedFiles = [];

        // saat pilih gambar
        input.addEventListener(
            'change',
            function(e){

            const newFiles =
                Array.from(
                    e.target.files
                );

            // gabungkan gambar lama + baru
            selectedFiles = [
                ...selectedFiles,
                ...newFiles
            ];

            renderPreview();
            updateInputFiles();
        });

        // render preview
        function renderPreview(){

            previewContainer.innerHTML = '';

            selectedFiles.forEach(
                (file, index) => {

                if(
                    !file.type.startsWith(
                        'image/'
                    )
                ) return;

                const reader =
                    new FileReader();

                reader.onload =
                function(e){

                    const div =
                        document.createElement(
                            'div'
                        );

                    div.className =
                        'col-md-4 col-6 mb-3';

                    div.innerHTML = `
                        <div class="preview-card position-relative">

                            <img
                                src="${e.target.result}"
                                class="preview-image">

                            <button
                                type="button"
                                class="remove-image"
                                data-index="${index}">

                                ×

                            </button>

                            <small class="file-name">
                                ${file.name}
                            </small>

                        </div>
                    `;

                    previewContainer
                        .appendChild(div);
                }

                reader.readAsDataURL(
                    file
                );
            });
        }

        // update file input
        function updateInputFiles(){

            const dataTransfer =
                new DataTransfer();

            selectedFiles.forEach(
                file =>
                dataTransfer.items
                .add(file)
            );

            input.files =
                dataTransfer.files;
        }

        // hapus preview gambar
        previewContainer
        .addEventListener(
            'click',
            function(e){

            if(
                e.target.classList
                .contains(
                    'remove-image'
                )
            ){

                const index =
                    parseInt(
                        e.target.dataset
                        .index
                    );

                selectedFiles.splice(
                    index,
                    1
                );

                renderPreview();
                updateInputFiles();
            }
        });
    });
</script>
<script>
    function hapusGambar(id, button)
    {
        if (!confirm('Hapus gambar ini?'))
            return;

        fetch(`/produk-gambar/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN':
                    '{{ csrf_token() }}',
                'Accept':
                    'application/json'
            }
        })
        .then(response => {

            if(response.ok){

                // hapus card gambar langsung
                button
                    .closest('.col-md-4')
                    .remove();
            }
        })
        .catch(error => {
            console.log(error);
        });
    }
    </script>
@endsection