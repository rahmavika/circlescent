@extends('admin.layouts.main')
@section('title', 'Edit Pengguna')

@section('content')

<div class="container-fluid mt-4">

    {{-- HEADER --}}
    <div class="card border-0 shadow-sm mb-4 top-card">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <h3 class="fw-bold mb-1">
                    Edit Pengguna
                </h3>

                <small>
                    Perbarui informasi pengguna sistem
                </small>
            </div>

            <div>
                <i class="bi bi-pencil-square header-icon"></i>
            </div>
        </div>
    </div>

    {{-- FORM --}}
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-11">

            <div class="card border-0 shadow-sm form-card">
                <div class="card-body p-4 p-lg-5">

                    <form action="/dashboard-pengguna/{{ $user->id }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Nama --}}
                        <div class="mb-4">
                            <label class="form-label">
                                Nama Lengkap
                            </label>

                            <input type="text"
                                class="form-control form-modern @error('name') is-invalid @enderror"
                                name="name"
                                value="{{ old('name', $user->name) }}"
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
                                value="{{ old('email', $user->email) }}"
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
                                value="{{ old('phone', $user->phone) }}"
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
                                    {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>
                                    Admin
                                </option>

                                <option value="pelanggan"
                                    {{ old('role', $user->role) == 'pelanggan' ? 'selected' : '' }}>
                                    Pelanggan
                                </option>

                            </select>

                            @error('role')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="section-divider">
                            Ubah Password
                        </div>

                        {{-- Password Lama --}}
                        <div class="mb-4">
                            <label class="form-label">
                                Password Lama
                            </label>

                            <div class="input-group">
                                <input type="password"
                                    class="form-control form-modern @error('old_password') is-invalid @enderror"
                                    name="old_password"
                                    id="old_password"
                                    placeholder="Masukkan password lama">

                                <span class="input-group-text password-toggle">
                                    <i class="bi bi-eye-slash toggle-password"
                                        toggle="#old_password"
                                        style="cursor:pointer;"></i>
                                </span>
                            </div>

                            @error('old_password')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Password Baru --}}
                        <div class="mb-4">
                            <label class="form-label">
                                Password Baru
                            </label>

                            <div class="input-group">
                                <input type="password"
                                    class="form-control form-modern @error('password') is-invalid @enderror"
                                    name="password"
                                    id="password"
                                    placeholder="Kosongkan jika tidak diubah">

                                <span class="input-group-text password-toggle">
                                    <i class="bi bi-eye-slash toggle-password"
                                        toggle="#password"
                                        style="cursor:pointer;"></i>
                                </span>
                            </div>

                            <small class="text-muted d-block mt-2">
                                Kosongkan jika tidak ingin mengubah password
                            </small>

                            @error('password')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Konfirmasi Password --}}
                        <div class="mb-4">
                            <label class="form-label">
                                Konfirmasi Password
                            </label>

                            <div class="input-group">
                                <input type="password"
                                    class="form-control form-modern @error('password_confirmation') is-invalid @enderror"
                                    name="password_confirmation"
                                    id="password_confirmation"
                                    placeholder="Konfirmasi password">

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
                                Update Data
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
.top-card{
    background: linear-gradient(135deg,#0e0e0e,#171717,#111111)!important;
    border-radius:34px!important;
    border:1px solid rgba(255,255,255,.04);
}

.top-card h3{
    color:#fff;
    font-size:40px;
}

.top-card small{
    color:rgba(255,255,255,.58);
}

.header-icon{
    font-size:40px;
    color:#d4af37;
}

.form-card{
    background:linear-gradient(145deg,#111,#1a1a1a)!important;
    border-radius:36px!important;
    border:1px solid rgba(255,255,255,.04);
}

.form-label{
    color:#fff;
    font-weight:600;
}

.form-modern{
    height:58px;
    border-radius:20px!important;
    background:#1a1a1a!important;
    border:1px solid rgba(255,255,255,.06)!important;
    color:#fff!important;
    padding:14px 22px;
}

.form-modern::placeholder{
    color:#8d8d8d;
}

.form-modern:focus{
    border-color:#d4af37!important;
    box-shadow:0 0 0 4px rgba(212,175,55,.10)!important;
}

.password-toggle{
    background:#1a1a1a!important;
    border:1px solid rgba(255,255,255,.06)!important;
    border-left:none!important;
    border-radius:0 20px 20px 0!important;
    color:#d4af37;
}

.section-divider{
    color:#d4af37;
    font-weight:700;
    margin:35px 0 25px;
    padding-bottom:10px;
    border-bottom:1px solid rgba(255,255,255,.08);
}

.btn-save{
    background:linear-gradient(135deg,#ba9a57,#d4af37);
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

@media(max-width:768px){
    .top-card h3{
        font-size:30px;
    }

    .d-flex.gap-3{
        flex-direction:column;
    }

    .btn-save,
    .btn-back{
        width:100%;
    }
}
</style>

@endsection

@push('scripts')
<script>
document.querySelectorAll('.toggle-password')
.forEach(function(icon){

    icon.addEventListener('click', function(){

        const input =
        document.querySelector(
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