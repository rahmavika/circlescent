@extends('admin.layouts.main')

@section('title', 'Tambah Varian')
@section('navVarian', 'active')

@section('content')

<div class="container py-4">

    <!-- HEADER -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body d-flex justify-content-between align-items-center">

            <div>
                <h3 class="fw-bold mb-1">
                    Tambah Varian
                </h3>

                <small class="text-muted">
                    Tambahkan varian parfum baru
                </small>
            </div>

            <div class="header-icon">
                <i class="bi bi-layers"></i>
            </div>

        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-10">

            <div class="varian-card">

                <form action="{{ route('dashboard-varian.store') }}" method="POST">
                    @csrf

                    <div class="row g-4">

                        <!-- PRODUK -->
                        <div class="col-12">
                            <label class="form-label">
                                Produk
                            </label>

                            <select
                                name="produk_id"
                                class="form-select @error('produk_id') is-invalid @enderror">

                                <option value="">
                                    -- Pilih Produk --
                                </option>

                                @foreach($produks as $produk)
                                    <option
                                        value="{{ $produk->id }}"
                                        {{ old('produk_id') == $produk->id ? 'selected' : '' }}>
                                        {{ $produk->nama_produk }}
                                    </option>
                                @endforeach

                            </select>

                            @error('produk_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- LEVEL -->
                        <div class="col-md-6">
                            <label class="form-label">
                                Level
                            </label>

                            <select
                                name="level"
                                class="form-select @error('level') is-invalid @enderror">

                                <option value="">
                                    -- Pilih Level --
                                </option>

                                <option value="Exclusive"
                                    {{ old('level') == 'Exclusive' ? 'selected' : '' }}>
                                    Exclusive
                                </option>

                                <option value="Premium"
                                    {{ old('level') == 'Premium' ? 'selected' : '' }}>
                                    Premium
                                </option>

                                <option value="VIP"
                                    {{ old('level') == 'VIP' ? 'selected' : '' }}>
                                    VIP
                                </option>

                                <option value="VVIP"
                                    {{ old('level') == 'VVIP' ? 'selected' : '' }}>
                                    VVIP
                                </option>

                            </select>

                            @error('level')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- ML -->
                        <div class="col-md-6">
                            <label class="form-label">
                                Ukuran
                            </label>

                            <select
                                name="ukuran"
                                class="form-select @error('ukuran') is-invalid @enderror">

                                <option value="">
                                    -- Pilih Ukuran --
                                </option>

                                <option value="30ml"
                                    {{ old('ukuran') == '30ml' ? 'selected' : '' }}>
                                    30ml
                                </option>

                                <option value="50ml"
                                    {{ old('ukuran') == '50ml' ? 'selected' : '' }}>
                                    50ml
                                </option>

                                <option value="100ml"
                                    {{ old('ukuran') == '100ml' ? 'selected' : '' }}>
                                    100ml
                                </option>

                            </select>

                            @error('ukuran')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- HARGA -->
                        <div class="col-md-6">
                            <label class="form-label">
                                Harga
                            </label>

                            <div class="input-group luxury-input">
                                <span class="input-group-text">
                                    Rp
                                </span>

                                <input type="number"
                                    name="harga"
                                    class="form-control @error('harga') is-invalid @enderror"
                                    placeholder="Masukkan harga"
                                    value="{{ old('harga') }}">
                            </div>

                            @error('harga')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- STOK -->
                        <div class="col-md-6">
                            <label class="form-label">
                                Stok Awal
                            </label>

                            <input type="number"
                                name="stok"
                                class="form-control @error('stok') is-invalid @enderror"
                                placeholder="0"
                                value="{{ old('stok', 0) }}">

                            @error('stok')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                    </div>

                    <!-- BUTTON -->
                    <div class="d-flex justify-content-end gap-3 mt-5 flex-wrap">

                        <a href="{{ route('dashboard-varian.index') }}"
                            class="btn btn-cancel px-4">
                            Kembali
                        </a>

                        <button type="submit"
                            class="btn btn-save px-4">

                            <i class="bi bi-save me-2"></i>
                            Simpan Varian

                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>

</div>

<style>
.input-group-text{
    background:#232323 !important;
    border:1px solid rgba(255,255,255,.08)!important;
    color:#d4af37 !important;
    border-radius:18px 0 0 18px !important;
    padding:0 18px;
    font-weight:600;
}

.input-group .form-control{
    border-radius:0 18px 18px 0 !important;
}
/* HEADER CARD */
.card{
    border:none !important;
    border-radius:34px;
    overflow:hidden;
    background:
        linear-gradient(135deg,#0d0d0d,#171717,#111111)!important;
    box-shadow:0 10px 40px rgba(0,0,0,.22);
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

.header-icon{
    width:70px;
    height:70px;
    border-radius:22px;
    background:rgba(212,175,55,.12);
    display:flex;
    align-items:center;
    justify-content:center;
}

.header-icon i{
    color:#d4af37;
    font-size:32px;
}

/* FORM CARD */
.varian-card{
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
    height:56px;
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
        0 0 0 3px rgba(212,175,55,.10)!important;
}

.form-control::placeholder{
    color:#8b8b8b;
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

.invalid-feedback{
    color:#ff7c7c;
}

@media(max-width:768px){

    .varian-card{
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
</style>

@endsection