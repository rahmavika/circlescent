<div class="mobile-overlay" id="mobileOverlay"></div>
<nav class="pc-sidebar" id="mobileSidebar">
    <div class="sidebar-mobile-top d-lg-none">
        <button class="close-sidebar-btn" id="closeSidebar">
            <i class="bi bi-x-lg"></i>
        </button>
    </div>
    <div class="sidebar-brand">
        <img src="{{ asset('storage/logo1.png') }}"
             alt="CircleScent"
             class="sidebar-logo-img">
    </div>
    <div class="navbar-content">
        <ul class="pc-navbar">
            <li class="pc-item">
                <a href="/dashboard" class="pc-link">
                    <span class="pc-micon"><i class="bi bi-graph-up"></i></span>
                    <span class="pc-mtext">Dashboard</span>
                </a>
            </li>

            <li class="pc-item pc-caption">
                <label>Products & Inventory</label>
            </li>

            <li class="pc-item">
                <a href="/dashboard-produk" class="pc-link">
                    <span class="pc-micon"><i class="bi bi-box"></i></span>
                    <span class="pc-mtext">Products</span>
                </a>
            </li>

            <li class="pc-item">
                <a href="/dashboard-varian" class="pc-link">
                    <span class="pc-micon"><i class="bi bi-layers"></i></span>
                    <span class="pc-mtext">Varian</span>
                </a>
            </li>

            <li class="pc-item">
                <a href="/dashboard-log" class="pc-link">
                    <span class="pc-micon"><i class="bi bi-box-seam"></i></span>
                    <span class="pc-mtext">Stock Log</span>
                </a>
            </li>

            <li class="pc-item">
                <a href="/dashboard-mutasi" class="pc-link">
                    <span class="pc-micon"><i class="bi bi-arrow-left-right"></i></span>
                    <span class="pc-mtext">Stock Transfer</span>
                </a>
            </li>

            <li class="pc-item pc-caption">
                <label>Sales</label>
            </li>

            <li class="pc-item">
                <a href="/dashboard-pesanan" class="pc-link">
                    <span class="pc-micon"><i class="bi bi-clipboard-data"></i></span>
                    <span class="pc-mtext">Orders</span>
                </a>
            </li>

            <li class="pc-item">
                <a href="/dashboard-penjualan" class="pc-link">
                    <span class="pc-micon"><i class="bi bi-cash-stack"></i></span>
                    <span class="pc-mtext">Sales</span>
                </a>
            </li>

            <li class="pc-item pc-caption">
                <label>Others</label>
            </li>

            <li class="pc-item">
                <a href="/dashboard-pengguna" class="pc-link">
                    <span class="pc-micon"><i class="bi bi-people"></i></span>
                    <span class="pc-mtext">User Management</span>
                </a>
            </li>

            <li class="pc-item">
                <a href="/contact-us" class="pc-link">
                    <span class="pc-micon"><i class="bi bi-envelope"></i></span>
                    <span class="pc-mtext">Contact Us</span>
                </a>
            </li>

            <li class="pc-item">
                <a href="#" class="pc-link" data-bs-toggle="modal" data-bs-target="#logoutModal">
                    <span class="pc-micon">
                        <i class="bi bi-box-arrow-right"></i>
                    </span>
                    <span class="pc-mtext">
                        Log Out
                    </span>
                </a>
            </li>
        </ul>
    </div>
</nav>

<div class="modal fade" id="logoutModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-body text-center px-4 pt-4 pb-2">
                <div class="mb-3">
                    <i class="bi bi-box-arrow-right fs-2 text-danger"></i>
                </div>
                <h6 class="fw-semibold mb-1">Keluar dari akun?</h6>
                <p class="text-muted small mb-0">
                    Anda akan mengakhiri sesi saat ini
                </p>
            </div>
            <div class="modal-footer border-0 pt-2 pb-3 px-3 d-flex">
                <button type="button"class="btn btn-light flex-fill me-2"data-bs-dismiss="modal">
                    Batal
                </button>
                <form action="{{ route('admin.logout') }}" method="POST" class="flex-fill">
                    @csrf
                    <button type="submit" class="btn btn-danger w-100">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<style>
    /* ===================================
       SIDEBAR LUXURY WHITE EDITION
    =================================== */

    :root{
        --bg-dark:#0b0b0b;
        --bg-soft:#151515;
        --soft-white:#e5e5e0;
        --silver:#c8c8c3;
        --muted:#a7a7a2;
        --border:rgba(255,255,255,.06);
    }

    /* ======================
       SIDEBAR
    ====================== */
    .pc-sidebar{
        width:290px;
        height:100vh;
        position:fixed;
        top:0;
        left:0;
        overflow-y:auto;
        z-index:1050;
        transition:.35s ease;

        background:
            linear-gradient(
                180deg,
                #0b0b0b 0%,
                #121212 100%
            );

        border-right:
            1px solid rgba(255,255,255,.05);

        box-shadow:
            12px 0 35px rgba(0,0,0,.45);
    }

    /* scrollbar */
    .pc-sidebar::-webkit-scrollbar{
        width:6px;
    }

    .pc-sidebar::-webkit-scrollbar-track{
        background:transparent;
    }

    .pc-sidebar::-webkit-scrollbar-thumb{
        background:rgba(255,255,255,.15);
        border-radius:20px;
    }

    /* ======================
       OVERLAY
    ====================== */
    .mobile-overlay{
        position:fixed;
        inset:0;
        background:rgba(0,0,0,.75);
        backdrop-filter:blur(6px);
        z-index:1045;

        opacity:0;
        visibility:hidden;
        transition:.3s ease;
    }

    .mobile-overlay.active{
        opacity:1;
        visibility:visible;
    }

    /* ======================
       CLOSE BTN
    ====================== */
    .sidebar-mobile-top{
        display:flex;
        justify-content:flex-end;
        padding:14px 14px 0;
    }

    .close-sidebar-btn{
        width:42px;
        height:42px;
        border:none;
        border-radius:14px;

        background:
            rgba(255,255,255,.05);

        border:
            1px solid rgba(255,255,255,.08);

        color:#d9d9d5;

        transition:.3s ease;
    }

    .close-sidebar-btn:hover{
        background:
            rgba(255,255,255,.08);

        color:#fff;
        transform:rotate(90deg);
    }

    /* ======================
       LOGO
    ====================== */
    .sidebar-brand{
        width:100%;
        display:flex;
        justify-content:center;
        align-items:center;

        padding:10px 18px 6px;
        margin-bottom:4px;
    }

    .sidebar-logo-img{
        width:190px;
        max-width:100%;
        height:auto;

        object-fit:contain;
        display:block;

        opacity:.97;

        filter:
            drop-shadow(
                0 4px 12px rgba(255,255,255,.05)
            );

        transition:.3s ease;
    }

    .sidebar-logo-img:hover{
        transform:scale(1.015);
    }

    /* ======================
       NAVBAR
    ====================== */
    .pc-navbar{
        padding:0 14px 24px;
    }

    .pc-item{
        list-style:none;
        margin-bottom:5px;
    }

    /* menu */
    .pc-link{
        display:flex;
        align-items:center;
        gap:14px;

        padding:14px 16px;
        border-radius:18px;

        text-decoration:none;
        transition:.3s ease;

        border:
            1px solid transparent;
    }

    .pc-link:hover{
        background:
            rgba(255,255,255,.04);

        border:
            1px solid rgba(255,255,255,.06);

        transform:translateX(4px);
    }

    /* icon */
    .pc-micon{
        width:38px;
        height:38px;

        min-width:38px;

        border-radius:12px;

        background:
            rgba(255,255,255,.04);

        display:flex;
        align-items:center;
        justify-content:center;
    }

    .pc-micon i{
        font-size:18px;
        color:#d8d8d3;
    }

    /* text */
    .pc-mtext{
        color:#d8d8d3;
        font-size:14px;
        font-weight:500;
        letter-spacing:.2px;
    }

    /* ======================
    ACTIVE MENU
    ====================== */

    .pc-link{
        position:relative;
    }

    .pc-item.active::before,
    .pc-item.active::after,
    .pc-item.active > .pc-link::after{
        display:none !important;
    }

    .pc-item.active > .pc-link{
        background:
            linear-gradient(
                135deg,
                rgba(255,255,255,.10),
                rgba(255,255,255,.03)
            ) !important;

        border:
            1px solid rgba(255,255,255,.08) !important;

        box-shadow:
            inset 0 1px 0 rgba(255,255,255,.05),
            0 8px 24px rgba(0,0,0,.25) !important;

        transform:none;
    }

    /* icon active */
    .pc-item.active > .pc-link .pc-micon{
        background:
            linear-gradient(
                145deg,
                #ffffff,
                #d6d6d6
            ) !important;

        box-shadow:
            inset 0 1px 4px rgba(255,255,255,.35),
            0 4px 12px rgba(255,255,255,.06);
    }

    .pc-item.active > .pc-link .pc-micon i{
        color:#111 !important;
    }

    /* text active */
    .pc-item.active > .pc-link .pc-mtext{
        color:#ffffff !important;
        font-weight:600;
    }
    /* garis glow putih elegan */
    .pc-item.active > .pc-link::before{
        content:"";
        position:absolute;
        top:12px;
        bottom:12px;
        right:0;

        width:3px;
        border-radius:10px;

        background:
            linear-gradient(
                180deg,
                #ffffff,
                #d8d8d8
            );

        box-shadow:
            0 0 10px rgba(255,255,255,.25);
    }

    /* ======================
       SECTION TITLE
    ====================== */
    .pc-caption{
        margin-top:8px;
        margin-bottom:6px;
        padding:0 18px;
        list-style:none;
    }

    .pc-caption label{
        font-size:11px;
        font-weight:600;
        letter-spacing:3px;
        text-transform:uppercase;

        color:#a8a8a2;
    }

    /* ======================
       RESPONSIVE
    ====================== */
    @media(max-width:991px){

        .pc-sidebar{
            transform:translateX(-100%);
            width:290px;
        }

        .pc-sidebar.mobile-open{
            transform:translateX(0);
        }

        .sidebar-logo-img{
            width:175px;
        }
    }
</style>
<script>
    const sidebar = document.getElementById('mobileSidebar');
    const overlay = document.getElementById('mobileOverlay');
    const openBtn = document.getElementById('mobileSidebarToggle');
    const closeBtn = document.getElementById('closeSidebar');

    openBtn.addEventListener('click', function () {
        sidebar.classList.add('mobile-open');
        overlay.classList.add('active');
    });

    closeBtn.addEventListener('click', function () {
        sidebar.classList.remove('mobile-open');
        overlay.classList.remove('active');
    });

    overlay.addEventListener('click', function () {
        sidebar.classList.remove('mobile-open');
        overlay.classList.remove('active');
    });
</script>