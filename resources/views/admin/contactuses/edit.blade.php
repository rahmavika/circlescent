@extends('admin.layouts.main')
@section('title', 'Edit Jawaban Pertanyaan')
@section('navContactUs', 'active')

@section('content')

<div class="container-fluid mt-4">

    {{-- HEADER --}}
    <div class="card border-0 shadow-sm mb-4 top-card">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <h3 class="fw-bold mb-1">
                    Edit Pertanyaan
                </h3>

                <small>
                    Kelola jawaban pertanyaan pelanggan
                </small>
            </div>

            <div>
                <i class="bi bi-chat-left-text-fill header-icon"></i>
            </div>
        </div>
    </div>

    {{-- FORM --}}
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-11">

            <div class="card border-0 shadow-sm form-card">
                <div class="card-body p-4 p-lg-5">

                    <form action="{{ route('contactuses.update', $question->id) }}"
                        method="POST">

                        @csrf
                        @method('PUT')

                        {{-- Nama --}}
                        <div class="mb-4">
                            <label class="form-label">
                                Nama
                            </label>

                            <input type="text"
                                class="form-control form-modern readonly-input"
                                value="{{ $question->nama }}"
                                readonly>
                        </div>

                        {{-- Email --}}
                        <div class="mb-4">
                            <label class="form-label">
                                Email
                            </label>

                            <input type="email"
                                class="form-control form-modern readonly-input"
                                value="{{ $question->email }}"
                                readonly>
                        </div>

                        {{-- Pertanyaan --}}
                        <div class="mb-4">
                            <label class="form-label">
                                Pertanyaan
                            </label>

                            <textarea
                                class="form-control form-modern readonly-input"
                                rows="5"
                                readonly>{{ $question->pertanyaan }}</textarea>
                        </div>

                        {{-- Jawaban --}}
                        <div class="mb-4">
                            <label class="form-label">
                                Jawaban
                            </label>

                            <textarea
                                name="jawaban"
                                class="form-control form-modern @error('jawaban') is-invalid @enderror"
                                rows="5"
                                placeholder="Masukkan jawaban untuk pelanggan">{{ old('jawaban', $question->jawaban) }}</textarea>

                            @error('jawaban')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        {{-- FAQ Publish --}}
                        <div class="faq-box mb-4">

                            <div class="d-flex align-items-center justify-content-between">

                                <div>
                                    <div class="faq-title">
                                        Tampilkan ke FAQ Publik
                                    </div>

                                    <small class="faq-desc">
                                        Pertanyaan ini akan muncul pada halaman FAQ website
                                    </small>
                                </div>

                                <div class="form-check form-switch m-0">
                                    <input
                                        class="form-check-input custom-switch"
                                        type="checkbox"
                                        id="is_published"
                                        name="is_published"
                                        value="1"
                                        {{ $question->is_published ? 'checked' : '' }}>
                                </div>

                            </div>
                        </div>

                        {{-- BUTTON --}}
                        <div class="d-flex gap-3 mt-4">

                            <a href="{{ route('contactuses.index') }}"
                                class="btn btn-back">
                                <i class="bi bi-arrow-left me-1"></i>
                                Kembali
                            </a>

                            <button type="submit"
                                class="btn btn-save">
                                <i class="bi bi-check-circle me-1"></i>
                                Simpan Jawaban
                            </button>

                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
/* =========================
   HEADER
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
    border-radius:20px !important;
    background:#1a1a1a !important;
    border:1px solid rgba(255,255,255,.06)!important;
    color:#fff !important;
    padding:16px 22px;
}

.form-modern::placeholder{
    color:#8d8d8d;
}

.form-modern:focus{
    border-color:#d4af37 !important;
    box-shadow:
        0 0 0 4px rgba(212,175,55,.10)!important;
}

/* readonly */
.readonly-input{
    background:#141414 !important;
    color:rgba(255,255,255,.75)!important;
}

/* =========================
   FAQ BOX
========================= */
.faq-box{
    background:#181818;
    border:1px solid rgba(255,255,255,.05);
    border-radius:22px;
    padding:22px;
}

.faq-title{
    color:#fff;
    font-weight:600;
}

.faq-desc{
    color:rgba(255,255,255,.55);
}

/* SWITCH */
.custom-switch{
    width:58px !important;
    height:30px !important;
    cursor:pointer;
}

.custom-switch:checked{
    background-color:#d4af37 !important;
    border-color:#d4af37 !important;
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