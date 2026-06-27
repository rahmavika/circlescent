@extends('admin.layouts.main')

@section('title', 'Tambah Produk')
@section('navProduk', 'active')

@section('content')

<div class="container py-4">

    <!-- HEADER -->
    <div class="card border-0 shadow-sm mb-4 product-header">
        <div class="card-body d-flex justify-content-between align-items-center">

            <div>
                <h3 class="fw-bold mb-1">
                    Tambah Produk
                </h3>

                <small class="text-muted">
                    Tambahkan produk parfum baru ke CircleScent
                </small>
            </div>

            <div class="header-icon">
                <i class="bi bi-box-seam"></i>
            </div>

        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-xl-9 col-lg-10">

            <div class="product-card">

                <form action="/dashboard-produk"
                    method="post"
                    enctype="multipart/form-data">

                    @csrf

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
                                    value="{{ old('nama_produk') }}"
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

                                <select
                                    class="form-select @error('gender') is-invalid @enderror"
                                    name="gender">

                                    <option value="">
                                        -- Pilih Gender --
                                    </option>

                                    <option value="Male"
                                        {{ old('gender') == 'Male' ? 'selected' : '' }}>
                                        Male
                                    </option>

                                    <option value="Female"
                                        {{ old('gender') == 'Female' ? 'selected' : '' }}>
                                        Female
                                    </option>

                                    <option value="Unisex"
                                        {{ old('gender') == 'Unisex' ? 'selected' : '' }}>
                                        Unisex
                                    </option>
                                </select>

                                @error('gender')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <!-- GAMBAR PRODUK -->
                            <div class="mt-4">

                                <label class="form-label">
                                    Gambar Produk
                                </label>

                                <input
                                    type="file"
                                    name="gambar[]"
                                    id="gambar"
                                    multiple
                                    accept="image/*"
                                    class="form-control
                                    @error('gambar') is-invalid @enderror
                                    @error('gambar.*') is-invalid @enderror">

                                <small class="text-muted d-block mt-2">
                                    Bisa upload lebih dari 1 gambar
                                    (jpg, png, jpeg, webp • max 5MB)
                                </small>

                                {{-- Error --}}
                                @error('gambar')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror

                                @error('gambar.*')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <!-- PREVIEW -->
                                <div
                                    id="preview-container"
                                    class="row g-3 mt-2">
                                </div>

                            </div>

                        </div>

                        <!-- RIGHT -->
                        <div class="col-lg-6">

                            <div>
                                <label class="form-label">
                                    Usage
                                </label>

                                <select
                                    class="form-select @error('usage') is-invalid @enderror"
                                    name="usage">

                                    <option value="">
                                        -- Pilih Usage --
                                    </option>

                                    <option value="Indoor"
                                        {{ old('usage') == 'Indoor' ? 'selected' : '' }}>
                                        Indoor
                                    </option>

                                    <option value="Outdoor"
                                        {{ old('usage') == 'Outdoor' ? 'selected' : '' }}>
                                        Outdoor
                                    </option>
                                    <option value="Inoutdoor"
                                        {{ old('usage') == 'Inoutdoor' ? 'selected' : '' }}>
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
                                    placeholder="Deskripsi produk parfum">{{ old('deskripsi') }}</textarea>

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

                            <i class="bi bi-save me-2"></i>
                            Simpan Produk

                        </button>

                    </div>

                </form>
            </div>

        </div>
    </div>

</div>

<style>
    /* HEADER */
.product-header{
    border-radius:28px;
    overflow:hidden;
    background:
        linear-gradient(135deg,#101010,#181818);
}

.product-header .card-body{
    padding:28px 34px;
}

.product-header h3{
    font-size:32px;
    color:#fff;
}

.product-header small{
    color:rgba(255,255,255,.65) !important;
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
/* CARD HEADER */
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

.bi-box-seam{
    color:#d4af37 !important;
}

/* FORM CARD */
.product-card{
    background:
        linear-gradient(
            145deg,
            rgba(18,18,18,.96),
            rgba(24,24,24,.94)
        );

    border-radius:34px;
    padding:34px;
    border:1px solid rgba(255,255,255,.04);

    box-shadow:
        0 15px 45px rgba(0,0,0,.20);
}

/* LABEL */
.form-label{
    color:#d4af37;
    font-weight:600;
    margin-bottom:10px;
}

/* INPUT */
.form-control,
.form-select{
    background:#1a1a1a !important;
    border:1px solid rgba(255,255,255,.08)!important;
    color:#fff !important;
    border-radius:18px !important;
    padding:14px 18px !important;
}

.form-control:focus,
.form-select:focus{
    border-color:#d4af37 !important;
    box-shadow:
        0 0 0 3px rgba(212,175,55,.10) !important;
}

.form-control::placeholder{
    color:#8b8b8b;
}

/* FILE INPUT */
input[type="file"]{
    padding:12px !important;
}

/* BUTTON */
.btn-save{
    background:
        linear-gradient(
            135deg,
            #b8924f,
            #d4af37
        ) !important;

    color:#111 !important;
    border:none !important;
    border-radius:18px;
    padding:14px 28px;
    font-weight:700;
}

.btn-cancel{
    background:#252525 !important;
    color:#fff !important;
    border:none !important;
    border-radius:18px;
    padding:14px 28px;
}

/* INVALID */
.invalid-feedback{
    color:#ff7c7c;
}

/* MOBILE */
@media(max-width:768px){

    .product-card{
        padding:24px;
    }

    .card h3{
        font-size:28px;
    }

    .btn-save,
    .btn-cancel{
        width:100%;
    }

    .d-flex.justify-content-end{
        flex-direction:column;
    }
}

/* PREVIEW */
.preview-card{
    background:#1a1a1a;
    border-radius:18px;
    padding:10px;
    border:1px solid rgba(255,255,255,.08);
}

.preview-image{
    width:100%;
    height:150px;
    object-fit:cover;
    border-radius:14px;
}

.file-name{
    display:block;
    margin-top:8px;
    color:#aaa;
    font-size:12px;
    word-break:break-word;
}

.remove-image{
    position:absolute;
    top:8px;
    right:8px;
    width:30px;
    height:30px;
    border:none;
    border-radius:50%;
    background:#dc3545;
    color:#fff;
    cursor:pointer;
    font-size:18px;
}
</style>
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const input = document.getElementById('gambar');
        const previewContainer =
            document.getElementById(
                'preview-container'
            );

        let selectedFiles = [];

        input.addEventListener(
            'change',
            function (e) {

                const newFiles =
                    Array.from(e.target.files);

                // tambah file baru
                selectedFiles = [
                    ...selectedFiles,
                    ...newFiles
                ];

                renderPreview();
                updateInput();
            }
        );

        function renderPreview() {

            previewContainer.innerHTML = '';

            selectedFiles.forEach(
                (file, index) => {

                if (
                    !file.type.startsWith(
                        'image/'
                    )
                ) return;

                const reader =
                    new FileReader();

                reader.onload =
                    function (e) {

                    const div =
                        document.createElement(
                            'div'
                        );

                    div.className =
                        'col-md-4 col-6';

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

                        </div>

                        <small class="file-name">
                            ${file.name}
                        </small>
                    `;

                    previewContainer
                        .appendChild(div);
                };

                reader.readAsDataURL(
                    file
                );
            });
        }

        function updateInput() {

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

        previewContainer.addEventListener(
            'click',
            function (e) {

            if (
                e.target.classList.contains(
                    'remove-image'
                )
            ) {

                const index =
                    e.target.dataset.index;

                selectedFiles.splice(
                    index,
                    1
                );

                renderPreview();
                updateInput();
            }
        });
    });
</script>

@endsection