@extends('admin.layouts.main')
@section('title', 'Tambah Pengguna')

@section('content')

<div class="container-fluid mt-4">

    {{-- HEADER --}}
    <div class="card border-0 shadow-sm mb-4 top-card">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <h3 class="fw-bold mb-1">
                    Tambah Pengguna
                </h3>

                <small>
                    Form penambahan data pengguna sistem
                </small>
            </div>

            <div>
                <i class="bi bi-person-plus-fill header-icon"></i>
            </div>
        </div>
    </div>

    {{-- FORM --}}
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-11">

            <div class="card border-0 shadow-sm form-card">
                <div class="card-body p-4 p-lg-5">

                    <form action="/dashboard-pengguna" method="POST">
                        @csrf

                        {{-- Nama --}}
                        <div class="mb-4">
                            <label class="form-label">
                                Nama Lengkap
                            </label>

                            <input type="text"
                                class="form-control form-modern @error('name') is-invalid @enderror"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="Masukkan nama lengkap">

                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="mb-4">
                            <label class="form-label">
                                Email
                            </label>

                            <input type="email"
                                class="form-control form-modern @error('email') is-invalid @enderror"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="Masukkan email">

                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Phone --}}
                        <div class="mb-4">
                            <label class="form-label">
                                No Handphone
                            </label>

                            <input type="text"
                                class="form-control form-modern @error('phone') is-invalid @enderror"
                                name="phone"
                                value="{{ old('phone') }}"
                                placeholder="08xxxxxxxxxx">

                            @error('phone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Role --}}
                        <div class="mb-4">
                            <label class="form-label">
                                Role
                            </label>

                            <select
                                class="form-select form-modern @error('role') is-invalid @enderror"
                                name="role">

                                <option value="">
                                    -- Pilih Role --
                                </option>

                                <option value="admin"
                                    {{ old('role') == 'admin' ? 'selected' : '' }}>
                                    Admin
                                </option>

                                <option value="pelanggan"
                                    {{ old('role') == 'pelanggan' ? 'selected' : '' }}>
                                    Pelanggan
                                </option>

                            </select>

                            @error('role')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="mb-4">
                            <label class="form-label">
                                Kata Sandi
                            </label>

                            <div class="input-group">
                                <input type="password"
                                    class="form-control form-modern @error('password') is-invalid @enderror"
                                    name="password"
                                    id="password"
                                    placeholder="Masukkan kata sandi">

                                <span class="input-group-text password-toggle">
                                    <i class="bi bi-eye-slash toggle-password"
                                        toggle="#password"
                                        style="cursor:pointer;"></i>
                                </span>
                            </div>

                            @error('password')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Konfirmasi Password --}}
                        <div class="mb-4">
                            <label class="form-label">
                                Konfirmasi Kata Sandi
                            </label>

                            <div class="input-group">
                                <input type="password"
                                    class="form-control form-modern @error('password_confirmation') is-invalid @enderror"
                                    name="password_confirmation"
                                    id="password_confirmation"
                                    placeholder="Konfirmasi kata sandi">

                                <span class="input-group-text password-toggle">
                                    <i class="bi bi-eye-slash toggle-password"
                                        toggle="#password_confirmation"
                                        style="cursor:pointer;"></i>
                                </span>
                            </div>

                            @error('password_confirmation')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- BUTTON --}}
                        <div class="d-flex gap-3 mt-4">

                            <button type="submit" class="btn btn-save">
                                <i class="bi bi-check-circle me-1"></i>
                                Simpan
                            </button>

                            <a href="/dashboard-pengguna"
                                class="btn btn-back">
                                Kembali
                            </a>

                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<style>

/* =========================
   TOP HEADER
========================= */
.top-card{
    background:
        linear-gradient(
            135deg,
            #0e0e0e,
            #171717,
            #111111
        ) !important;

    border-radius:34px !important;
    overflow:hidden;
    border:1px solid rgba(255,255,255,.04);
}

.top-card h3{
    color:#fff;
    font-size:42px;
}

.top-card small{
    color:rgba(255,255,255,.58);
}

.header-icon{
    font-size:42px;
    color:#d4af37;
}

/* =========================
   FORM CARD
========================= */
.form-card{
    background:
        linear-gradient(
            145deg,
            rgba(15,15,15,.98),
            rgba(22,22,22,.96)
        ) !important;

    border-radius:36px !important;
    border:1px solid rgba(255,255,255,.04);
    box-shadow:
        0 10px 40px rgba(0,0,0,.25);
}

/* =========================
   LABEL
========================= */
.form-label{
    color:#fff;
    font-weight:600;
    margin-bottom:10px;
}

/* =========================
   INPUT
========================= */
.form-modern{
    height:58px;
    border-radius:20px !important;
    background:#1a1a1a !important;
    border:1px solid rgba(255,255,255,.06)!important;
    color:#fff !important;
    padding:14px 22px;
}

.form-modern::placeholder{
    color:#8d8d8d;
}

.form-modern:focus{
    border-color:#d4af37 !important;
    box-shadow:
        0 0 0 4px rgba(212,175,55,.10)!important;
}

/* SELECT */
select.form-modern{
    color:#fff !important;
}

/* PASSWORD ICON */
.password-toggle{
    background:#1a1a1a !important;
    border:1px solid rgba(255,255,255,.06)!important;
    border-left:none !important;
    border-radius:0 20px 20px 0 !important;
    color:#d4af37;
}

/* =========================
   BUTTON
========================= */
.btn-save{
    background:
        linear-gradient(
            135deg,
            #ba9a57,
            #d4af37
        );

    border:none;
    border-radius:18px;
    padding:14px 28px;
    color:#111;
    font-weight:700;
}

.btn-back{
    background:#252525;
    border:none;
    border-radius:18px;
    padding:14px 28px;
    color:#fff;
}

.btn-save:hover,
.btn-back:hover{
    transform:translateY(-2px);
}

@media(max-width:768px){

    .top-card h3{
        font-size:30px;
    }

    .form-card{
        border-radius:26px !important;
    }

    .btn-save,
    .btn-back{
        width:100%;
    }

    .d-flex.gap-3{
        flex-direction:column;
    }
}
/* =========================
   FIX BACKGROUND PUTIH
========================= */
body,
.content-wrapper,
.main-content,
.page-wrapper,
.container-fluid{
    background:
        linear-gradient(
            180deg,
            #111111 0%,
            #171717 100%
        ) !important;
}

/* area content dashboard */
.content-page{
    background: transparent !important;
}

/* biar full area tidak putih */
main{
    background:
        linear-gradient(
            180deg,
            #111111 0%,
            #171717 100%
        ) !important;
    min-height:100vh;
}
</style>

@endsection

@push('scripts')
<script>
    document.querySelectorAll('.toggle-password')
    .forEach(function (icon) {

        icon.addEventListener('click', function () {

            const input = document.querySelector(
                icon.getAttribute('toggle')
            );

            input.type =
                input.type === 'password'
                ? 'text'
                : 'password';

            icon.classList.toggle('bi-eye');
            icon.classList.toggle('bi-eye-slash');
        });

    });
</script>
@endpush