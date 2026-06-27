@extends('admin.layouts.main')
@section('title', 'Data Penjualan')
@section('navAdm', 'active')
@section('content')

<div class="page-wrap">

    <div class="page-title text-center mb-3">
        <h5 class="fw-bold mb-0">Laporan Data Penjualan</h5>
    </div>

    <!-- FILTER PDF -->
    <div class="card lux-card mb-3">
        <div class="card-body py-2 px-3">
            <form action="/cetak-pdf/penjualan" method="GET" target="_blank"
                class="d-flex align-items-center flex-wrap gap-2">

                <span class="fw-semibold label-text">
                    Cetak PDF:
                </span>

                <select name="tahun" class="form-select form-select-sm lux-input" required>
                    <option value="" disabled selected>Tahun</option>
                    @foreach(range(date('Y'), date('Y') - 5) as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>

                <select name="bulan" class="form-select form-select-sm lux-input" required>
                    <option value="" disabled selected>Bulan</option>
                    @for($m = 1; $m <= 12; $m++)
                        <option value="{{ sprintf('%02d',$m) }}">
                            {{ date('F', mktime(0,0,0,$m,1)) }}
                        </option>
                    @endfor
                </select>

                <button type="submit" class="btn btn-sm lux-btn">
                    <i class="bi bi-printer"></i>
                </button>

            </form>
        </div>
    </div>

    <!-- TABLE -->
    <div class="card lux-card">
        <div class="card-header lux-header py-2 px-3">
            <span class="fw-semibold">Data Penjualan</span>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-dark table-hover table-sm mb-0 align-middle lux-table">
                    <thead class="text-center">
                        <tr>
                            <th width="5%">No</th>

                            <th width="18%">
                                <form action="{{ route('dashboard-penjualan.index') }}" method="GET">
                                    <div class="d-flex justify-content-center gap-1">

                                        <select name="tahun" class="form-select form-select-sm lux-input"
                                            onchange="this.form.submit();">
                                            <option value="">Thn</option>
                                            @foreach(range(date('Y'), date('Y') - 10) as $year)
                                                <option value="{{ $year }}"
                                                    {{ request('tahun') == $year ? 'selected' : '' }}>
                                                    {{ $year }}
                                                </option>
                                            @endforeach
                                        </select>

                                        <select name="bulan" class="form-select form-select-sm lux-input"
                                            onchange="this.form.submit();">
                                            <option value="">Bln</option>
                                            @for($m = 1; $m <= 12; $m++)
                                                <option value="{{ sprintf('%02d', $m) }}"
                                                    {{ request('bulan') == sprintf('%02d', $m) ? 'selected' : '' }}>
                                                    {{ $m }}
                                                </option>
                                            @endfor
                                        </select>

                                    </div>
                                </form>
                            </th>

                            <th>Nama</th>
                            <th>Total</th>
                            <th>Alamat</th>
                            <th width="8%">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($checkouts as $checkout)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>

                                <td class="text-center">
                                    {{ $checkout->updated_at->format('d-m-Y') }}
                                </td>

                                <td>
                                    {{ $checkout->user->name ?? '-' }}
                                </td>

                                <td class="text-end fw-semibold text-gold">
                                    Rp {{ number_format($checkout->total_harga, 0, ',', '.') }}
                                </td>

                                <td style="white-space: normal;">
                                    {{ $checkout->alamat_pengiriman }}
                                </td>

                                <td class="text-center">
                                    <a href="/dashboard-penjualan/{{ $checkout->id }}"
                                        class="btn btn-sm lux-outline">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-3">
                                    Data tidak tersedia
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $checkouts->links('pagination::bootstrap-5') }}
    </div>

</div>

<style>
/* BACKGROUND DARK LUXURY */
.page-wrap{
    background:#0b0c10;
    min-height:100vh;
    padding:15px;
    color:#e5e7eb;
}

.page-title h5{
    color:#ffffff;
    letter-spacing:.5px;
}

/* CARD STYLE */
.lux-card{
    background: linear-gradient(145deg, #0f1117, #141824);
    border:1px solid rgba(255,255,255,0.06);
    border-radius:10px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.6);
}

/* HEADER TABLE */
.lux-header{
    background:#11131a;
    border-bottom:1px solid rgba(255,255,255,0.08);
    color:#fff;
}

/* INPUT STYLE */
.lux-input{
    background:#0e1118;
    border:1px solid rgba(255,255,255,0.1);
    color:#fff;
    font-size:12px;
}

.lux-input:focus{
    background:#0e1118;
    color:#fff;
    border-color:#3b82f6;
    box-shadow:none;
}

/* BUTTON */
.lux-btn{
    background:#3b82f6;
    color:#fff;
    border:none;
}

.lux-btn:hover{
    background:#2563eb;
}

/* TABLE */
.lux-table{
    color:#e5e7eb;
}

.lux-table thead{
    background:#0f172a;
    color:#fff;
}

.lux-table tbody tr:hover{
    background:rgba(255,255,255,0.04);
}

/* GOLD TOTAL */
.text-gold{
    color:#f5c542;
}

/* OUTLINE BUTTON */
.lux-outline{
    border:1px solid #3b82f6;
    color:#3b82f6;
}

.lux-outline:hover{
    background:#3b82f6;
    color:#fff;
}

/* LABEL */
.label-text{
    color:#cbd5e1;
    font-size:13px;
}
</style>

@endsection