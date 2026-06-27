<header class="header-modern shadow-sm">
    <div class="main-header-modern">
        <div class="container d-flex justify-content-between align-items-center">
            <a href="/" class="brand-modern text-decoration-none">
                <img src="/storage/logo1.png"
                     alt="CircleScent"
                     class="brand-logo">
            </a>
            <nav class="nav-modern d-none d-md-block">
                <ul>
                    <li>
                        <a href="/" class="{{ Request::is('/') ? 'active' : '' }}">
                            Home
                        </a>
                    </li>
                    <li class="nav-dropdown">
                        <a href="{{ url('/semuaproduk') }}"
                           class="{{ Request::is('semuaproduk') || Request::is('semuaproduk/*') ? 'active' : '' }}">
                            Products <i class="bi bi-chevron-down dropdown-arrow"></i>
                        </a>

                        <ul class="dropdown-menu-custom">
                            <li>
                                <a href="{{ url('/semuaproduk') }}">All Products</a>
                            </li>

                            @foreach($genders as $gender)
                                <li>
                                    <a href="{{ url('/semuaproduk?gender=' . urlencode($gender)) }}">
                                        {{ ucfirst($gender) }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li>
                        <a href="/tentang"
                           class="{{ Request::is('tentang') ? 'active' : '' }}">
                            About
                        </a>
                    </li>
                    <li>
                        <a href="/contactus"
                           class="{{ Request::is('contactus') ? 'active' : '' }}">
                            Contact
                        </a>
                    </li>
                    <li>
                        <a href="/cabang"
                           class="{{ Request::is('cabang') ? 'active' : '' }}">
                            Store
                        </a>
                    </li>
                </ul>
            </nav>

            <div class="icons-modern">
                <button class="btn hamburger-btn d-md-none"data-bs-toggle="offcanvas"data-bs-target="#mobileMenu">
                    <i class="bi bi-list"></i>
                </button>
                @if(session('name'))
                    <a href="{{ url('/keranjang') }}"class="icon-btn">
                        <i class="bi bi-cart-fill"></i>
                    </a>
                    <a href="{{ url('/riwayat-belanja') }}"class="icon-btn {{ Request::is('riwayat-belanja') ? 'active' : '' }}">
                        <i class="bi bi-clock-history"></i>
                    </a>
                    <a href="#"class="user-name d-none d-md-flex"data-bs-toggle="modal"data-bs-target="#detailPelangganModal">
                        <i class="bi bi-person-circle"></i>
                        <span>{{ session('name') }}</span>
                    </a>
                    {{-- <form action="/logout"method="POST"class="d-none d-md-flex m-0">
                        @csrf
                        <button type="submit" class="logout-circle">
                            <i class="bi bi-box-arrow-right"></i>
                        </button>
                    </form> --}}
                @else
                    <a href="#"class="icon-btn"data-bs-toggle="modal"data-bs-target="#loginModal">
                        <i class="bi bi-cart-fill"></i>
                    </a>
                    <button class="btn-login d-none d-md-flex"
                        data-bs-toggle="modal"
                        data-bs-target="#loginModal">
                        <i class="bi bi-person-fill"></i>
                        Login
                </button>
                @endif
            </div>
        </div>
    </div>

    <div class="offcanvas offcanvas-start mobile-menu-modern"tabindex="-1"id="mobileMenu">
        <div class="offcanvas-header border-bottom">
            <h6 class="fw-semibold m-0">Menu</h6>
            <button type="button"class="btn-close"data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <div class="user-card">
                @if(session('name'))
                    <div class="d-flex align-items-center gap-3"data-bs-toggle="modal"data-bs-target="#detailPelangganModal">
                        <div class="avatar">
                            <i class="bi bi-person-fill"></i>
                        </div>
                        <div>
                            <div class="fw-semibold small">
                                {{ session('name') }}
                            </div>
                            <small class="text-muted">
                                Akun aktif
                            </small>
                        </div>
                    </div>
                    <div class="mobile-action-buttons">
                        <button class="mobile-btn primary-btn"data-bs-toggle="modal"data-bs-target="#detailPelangganModal">
                            Profil
                        </button>
                        <form action="/logout" method="POST" class="m-0">
                            @csrf
                            <button type="submit" class="mobile-btn danger-btn">
                                Logout
                            </button>
                        </form>
                    </div>
                @else
                    <button class="btn btn-primary w-100"data-bs-toggle="modal"data-bs-target="#loginModal">
                        Login / Daftar
                    </button>
                @endif
            </div>

            <ul class="menu-list">
                <li>
                    <a href="/">
                        <i class="bi bi-house"></i>
                        Home
                    </a>
                </li>
                <li class="mobile-dropdown">
                    <button class="mobile-dropdown-toggle" type="button">
                        <span class="d-flex align-items-center gap-2">
                            <i class="bi bi-box"></i>
                            Products
                        </span>
                        <i class="bi bi-chevron-down"></i>
                    </button>

                    <ul class="mobile-submenu">
                        <li>
                            <a href="{{ url('/semuaproduk') }}">All Products</a>
                        </li>

                        @foreach($genders as $gender)
                            <li>
                                <a href="{{ url('/semuaproduk?gender=' . urlencode($gender)) }}">
                                    {{ ucfirst($gender) }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li>
                    <a href="/tentang">
                        <i class="bi bi-info-circle"></i>
                        About
                    </a>
                </li>
                <li>
                    <a href="/contactus">
                        <i class="bi bi-envelope"></i>
                        Contact
                    </a>
                </li>
                <li>
                    <a href="/cabang">
                        <i class="bi bi-envelope"></i>
                        Store
                    </a>
                </li>
            </ul>
        </div>
    </div>


    @if (Request::is('/') || Request::is('tentang') || Request::is('contactus'))

    <div id="heroCarousel"
         class="carousel slide"
         data-bs-ride="carousel"
         data-bs-interval="3000">

        <div class="carousel-inner">

            <div class="carousel-item active">
                <section class="hero-section">
                    <img src="/storage/baner5.png"
                         class="hero-banner"
                         alt="Banner 1">
                </section>
            </div>

            <div class="carousel-item">
                <section class="hero-section">
                    <img src="/storage/baner1.png"
                         class="hero-banner"
                         alt="Banner 2">
                </section>
            </div>

        </div>

        {{-- indikator --}}
        <div class="carousel-indicators">
            <button type="button"
                    data-bs-target="#heroCarousel"
                    data-bs-slide-to="0"
                    class="active"
                    aria-current="true">
            </button>

            <button type="button"
                    data-bs-target="#heroCarousel"
                    data-bs-slide-to="1">
            </button>
        </div>

    </div>

    @endif

</header>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const mobileDropdown = document.querySelector('.mobile-dropdown');
        const toggleBtn = document.querySelector('.mobile-dropdown-toggle');

        if (mobileDropdown && toggleBtn) {
            toggleBtn.addEventListener('click', function () {
                mobileDropdown.classList.toggle('active');

                const submenu = mobileDropdown.querySelector('.mobile-submenu');
                if (submenu.style.display === 'block') {
                    submenu.style.display = 'none';
                } else {
                    submenu.style.display = 'block';
                }
            });
        }
    });
    </script>
<style>
    /* =========================
   DROPDOWN PRODUCTS DESKTOP
========================= */
.nav-modern ul li{
    position:relative;
}

.nav-dropdown{
    position:relative;
}

.nav-dropdown > a{
    display:flex;
    align-items:center;
    gap:8px;
}

.dropdown-arrow{
    font-size:12px;
    transition:.3s ease;
}

.nav-dropdown:hover .dropdown-arrow{
    transform:rotate(180deg);
}

.dropdown-menu-custom{
    position:absolute;
    top:120%;
    left:0;
    min-width:220px;
    background:rgba(15,15,15,.98);
    backdrop-filter:blur(14px);
    border:1px solid rgba(255,255,255,.08);
    border-radius:16px;
    padding:10px;
    box-shadow:0 18px 40px rgba(0,0,0,.35);

    opacity:0;
    visibility:hidden;
    transform:translateY(10px);
    transition:.3s ease;
    z-index:9999;
}

.nav-dropdown:hover .dropdown-menu-custom{
    opacity:1;
    visibility:visible;
    transform:translateY(0);
}

.dropdown-menu-custom li{
    margin:0;
}

.dropdown-menu-custom li a{
    display:block;
    color:#d6d6d6;
    padding:10px 14px;
    border-radius:12px;
    font-size:14px;
    transition:.3s ease;
    white-space:nowrap;
}

.dropdown-menu-custom li a:hover{
    background:rgba(255,255,255,.08);
    color:#fff;
}

/* =========================
   MOBILE DROPDOWN PRODUCTS
========================= */
.mobile-dropdown{
    margin-bottom:8px;
}

.mobile-dropdown-toggle{
    width:100%;
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:12px;

    color:#d6d6d6;
    background:transparent;
    border:none;
    padding:14px 16px;
    border-radius:14px;
    transition:.3s ease;
    text-align:left;
}

.mobile-dropdown-toggle:hover{
    background:rgba(255,255,255,.08);
    color:#fff;
}

.mobile-dropdown-toggle i.bi-chevron-down{
    transition:.3s ease;
}

.mobile-dropdown.active .mobile-dropdown-toggle i.bi-chevron-down{
    transform:rotate(180deg);
}

.mobile-submenu{
    display:none;
    margin-top:6px;
    padding-left:12px;
}

.mobile-submenu li a{
    display:block;
    color:#cfcfcf;
    padding:10px 14px;
    border-radius:12px;
    font-size:13px;
    transition:.3s ease;
}

.mobile-submenu li a:hover{
    background:rgba(255,255,255,.06);
    color:#fff;
}
.brand-modern{
    display:flex;
    align-items:center;
}

.brand-logo{
    height:55px;
    width:auto;
    object-fit:contain;
    transition:.3s ease;
}

.brand-logo:hover{
    transform:scale(1.03);
}
    :root{
        --black: #0d0d0d;
        --soft-black: #181818;
        --white: #ffffff;
        --silver: #d9d9d9;
        --gray: #bcbcbc;
        --border: rgba(255,255,255,.08);
        --hover: rgba(255,255,255,.10);
    }

    *{
        margin:0;
        padding:0;
        box-sizing:border-box;
    }

    html,
    body{
        overflow-x:hidden;
        scroll-behavior:smooth;
    }

    body{
        font-family:'Poppins', sans-serif;
        background:#f6f6f6;
        padding-top:10px;
    }

    a{
        text-decoration:none;
    }

    ul{
        list-style:none;
        margin:0;
        padding:0;
    }

    /* =========================
        HEADER
    ========================== */
    .main-header-modern{
        position:fixed;
        top:0;
        left:0;
        width:100%;
        z-index:9999;

        background:rgba(10,10,10,.92);
        backdrop-filter:blur(18px);

        border-bottom:1px solid var(--border);

        padding:14px 0;
    }

    /* =========================
        BRAND
    ========================== */
    .brand-modern{
        display:flex;
        align-items:center;
        color:white;
        font-size:24px;
        font-weight:700;
    }

    .logo-icon{
        width:44px;
        height:44px;
        border-radius:50%;

        display:flex;
        align-items:center;
        justify-content:center;

        background:rgba(255,255,255,.08);
        border:1px solid rgba(255,255,255,.12);

        flex-shrink:0;
    }

    .logo-icon i{
        color:white;
        font-size:18px;
    }

    .brand-modern span{
        background:linear-gradient(
            to right,
            #fff,
            #d6d6d6
        );

        -webkit-background-clip:text;
        -webkit-text-fill-color:transparent;
    }

    /* =========================
        NAVBAR
    ========================== */
    .nav-modern ul{
        display:flex;
        align-items:center;
        gap:12px;
    }

    .nav-modern a{
        color:#d6d6d6;
        padding:10px 18px;
        border-radius:999px;
        font-size:14px;
        font-weight:500;
        transition:.3s ease;
    }

    .nav-modern a:hover,
    .nav-modern a.active{
        background:var(--hover);
        color:white;
    }

    /* =========================
        RIGHT ICONS
    ========================== */
    .icons-modern{
        display:flex;
        align-items:center;
        gap:10px;
    }

    .icon-btn{
        width:42px;
        height:42px;
        border-radius:50%;

        display:flex;
        align-items:center;
        justify-content:center;

        background:rgba(255,255,255,.08);
        border:1px solid rgba(255,255,255,.10);

        transition:.3s ease;
    }

    .icon-btn i{
        color:white;
        font-size:17px;
    }

    .icon-btn:hover{
        background:rgba(255,255,255,.15);
        transform:translateY(-2px);
    }

    .hamburger-btn{
        border:none !important;
        box-shadow:none !important;
        padding:0;
    }

    .hamburger-btn i{
        color:white;
        font-size:28px;
    }

    /* =========================
        USER NAME
    ========================== */
    .user-name{
        display:flex;
        align-items:center;
        gap:7px;

        color:white;
        font-size:14px;
        font-weight:500;

        transition:.3s;
    }

    .user-name:hover{
        color:#d4d4d4;
    }

    .btn-login{
        all: unset;

        height:42px !important;
        min-width:max-content;

        display:flex !important;
        align-items:center !important;
        justify-content:center !important;
        gap:8px !important;

        padding:0 20px !important;

        border-radius:999px !important;
        cursor:pointer;

        background:#fff !important;
        color:#000 !important;

        font-weight:600 !important;
        font-family:'Poppins', sans-serif !important;

        transition:.3s ease !important;
    }

    .btn-login i{
        color:#000 !important;
    }

    .btn-login:hover{
        background:#dcdcdc !important;
        transform:translateY(-2px);
    }

    .btn-login:focus,
    .btn-login:active,
    .btn-login:visited{
        background:#fff !important;
        color:#000 !important;
        box-shadow:none !important;
        outline:none !important;
    }

    /* =========================
        LOGOUT BUTTON
    ========================== */
    .logout-circle{
        width:42px;
        height:42px;
        border-radius:50%;

        border:1px solid rgba(255,255,255,.08);
        background:rgba(255,255,255,.08);

        display:flex;
        align-items:center;
        justify-content:center;

        transition:.3s ease;
    }

    .logout-circle i{
        color:white;
    }

    .logout-circle:hover{
        background:white;
    }

    .logout-circle:hover i{
        color:black;
    }

    /* =========================
        HERO CAROUSEL
    ========================== */
    #heroCarousel{
        margin-top:50px;
    }

    .carousel-item{
        overflow:hidden;
    }

    .hero-banner{
        width:100%;
        height:auto;
        display:block;

        object-fit:contain;
        object-position:center;
    }

    .carousel-indicators{
        margin-bottom:20px;
    }

    .carousel-indicators button{
        width:10px !important;
        height:10px !important;
        border-radius:50%;
    }

    /* =========================
        MOBILE MENU
    ========================== */
    .mobile-menu-modern{
        width:300px !important;
        background:#101010;
        color:white;
    }

    .offcanvas-header{
        border-color:rgba(255,255,255,.08) !important;
    }

    .btn-close{
        filter:invert(1);
    }

    .user-card{
        background:rgba(255,255,255,.05);
        border:1px solid rgba(255,255,255,.08);
        border-radius:20px;
        padding:16px;
        margin-bottom:24px;
    }

    .avatar{
        width:50px;
        height:50px;
        border-radius:50%;

        display:flex;
        align-items:center;
        justify-content:center;

        background:rgba(255,255,255,.10);
        color:white;
    }

    .mobile-action-buttons{
        display:flex;
        gap:10px;
        margin-top:15px;
    }

    .mobile-btn{
        flex:1;
        border:none;
        border-radius:999px;
        padding:10px 18px;
        font-size:13px;
        transition:.3s;
    }

    .primary-btn{
        background:white;
        color:black;
    }

    .danger-btn{
        background:transparent;
        border:1px solid white;
        color:white;
    }

    .menu-list li{
        margin-bottom:8px;
    }

    .menu-list a{
        display:flex;
        align-items:center;
        gap:12px;

        color:#d6d6d6;

        padding:14px 16px;
        border-radius:14px;

        transition:.3s ease;
    }

    .menu-list a:hover{
        background:rgba(255,255,255,.08);
        color:white;
    }

    /* =========================
        RESPONSIVE
    ========================== */
    @media(max-width:768px){

        body{
            padding-top:74px;
        }

        .main-header-modern{
            padding:12px 0;
        }

        .brand-modern{
            font-size:18px;
        }

        .logo-icon{
            width:40px;
            height:40px;
        }

        #heroCarousel{
            margin-top:74px;
        }

        .hero-banner{
            width:100%;
            height:auto;
        }

        .carousel-indicators{
            margin-bottom:10px;
        }

        .icon-btn{
            width:40px;
            height:40px;
        }
    }
</style>