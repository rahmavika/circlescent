<header class="pc-header custom-header">
    <div class="header-wrapper">
        <div class="me-auto d-flex align-items-center">
            <button class="mobile-menu-btn d-lg-none"id="mobileSidebarToggle">
                <i class="fas fa-bars"></i>
            </button>
            <ul class="list-unstyled d-none d-lg-flex align-items-center mb-0">
                <li class="pc-h-item pc-sidebar-collapse">
                    <a href="#" class="pc-head-link ms-0 custom-menu-btn" id="sidebar-hide">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
            </ul>
        </div>
        <div class="ms-auto d-flex align-items-center">
            <ul class="navbar-nav d-flex align-items-center mb-0">
                <li class="nav-item px-2 px-md-3">
                    @if (session('name'))
                    <div class="user-info">
                        <span class="profile-icon me-2">
                            <i class="bi bi-person-fill"></i>
                        </span>
                        <span class="user-name">
                            {{ session('name') }}
                        </span>
                    </div>
                    @else
                        <button class="btn-login" onclick="window.location.href='/login';">
                            <i class="bi bi-person-fill me-1"></i>
                            <span class="d-none d-sm-inline">
                                Login
                            </span>
                        </button>
                    @endif
                </li>
            </ul>
        </div>
    </div>
</header>
<style>
    /* ==========================
       PREMIUM MONO HEADER
    ========================== */

    .custom-header{
        position: sticky;
        top: 0;
        z-index: 1040;

        height: 88px;
        padding: 0 28px;

        display:flex;
        align-items:center;

        background:
            linear-gradient(
                180deg,
                rgba(24,24,24,.98) 0%,
                rgba(12,12,12,.98) 100%
            );

        backdrop-filter: blur(20px);

        border-bottom:
            1px solid rgba(255,255,255,.05);

        box-shadow:
            0 10px 35px rgba(0,0,0,.45);
    }

    .header-wrapper{
        width:100%;
        display:flex;
        align-items:center;
        justify-content:space-between;
    }

    /* ==========================
       BUTTON MENU
    ========================== */
    .mobile-menu-btn,
    .custom-menu-btn{
        width:48px;
        height:48px;
        border-radius:16px;
        border:none;

        background:
            linear-gradient(
                145deg,
                rgba(255,255,255,.07),
                rgba(255,255,255,.02)
            );

        border:
            1px solid rgba(255,255,255,.08);

        color:#f3f3f3;

        display:flex;
        align-items:center;
        justify-content:center;

        transition:.35s ease;

        box-shadow:
            inset 0 1px 0 rgba(255,255,255,.04);
    }

    .mobile-menu-btn:hover,
    .custom-menu-btn:hover{
        transform:translateY(-2px);

        background:
            linear-gradient(
                145deg,
                rgba(255,255,255,.14),
                rgba(255,255,255,.05)
            );

        border-color:
            rgba(255,255,255,.16);

        box-shadow:
            0 8px 25px rgba(255,255,255,.06);
    }

    /* ==========================
       USER PROFILE
    ========================== */
    .user-info{
        display:flex;
        align-items:center;
        gap:12px;

        padding:7px 10px 7px 7px;
        border-radius:999px;

        background:
            rgba(255,255,255,.04);

        border:
            1px solid rgba(255,255,255,.06);

        backdrop-filter:blur(12px);

        transition:.3s ease;
    }

    .user-info:hover{
        background:
            rgba(255,255,255,.06);

        border-color:
            rgba(255,255,255,.10);
    }

    /* PROFILE ICON */
    .profile-icon{
        width:42px;
        height:42px;
        border-radius:50%;

        background:
            linear-gradient(
                145deg,
                #ffffff,
                #d9d9d9,
                #bfbfbf
            );

        color:#111;

        display:flex;
        align-items:center;
        justify-content:center;

        box-shadow:
            inset 0 2px 8px rgba(255,255,255,.4),
            0 6px 18px rgba(255,255,255,.08);
    }

    .user-name{
        color:#f5f5f5;
        font-size:14px;
        font-weight:500;
        letter-spacing:.4px;
    }

    /* ==========================
       LOGIN BUTTON
    ========================== */
    .btn-login{
        border:none;

        background:
            linear-gradient(
                145deg,
                #ffffff,
                #d9d9d9,
                #bdbdbd
            );

        color:#111;

        padding:12px 24px;
        border-radius:999px;

        font-weight:700;
        font-size:14px;
        letter-spacing:.3px;

        transition:.35s ease;

        box-shadow:
            inset 0 2px 8px rgba(255,255,255,.3),
            0 10px 25px rgba(255,255,255,.08);
    }

    .btn-login:hover{
        transform:translateY(-2px);

        background:
            linear-gradient(
                145deg,
                #ffffff,
                #ececec
            );

        box-shadow:
            0 14px 28px rgba(255,255,255,.12);
    }

    /* ==========================
       RESPONSIVE
    ========================== */
    @media(max-width:991px){

        .custom-header{
            height:80px;
            padding:0 18px;
        }

        .mobile-menu-btn,
        .custom-menu-btn{
            width:44px;
            height:44px;
        }

        .profile-icon{
            width:38px;
            height:38px;
        }

        .user-name{
            max-width:100px;
            overflow:hidden;
            text-overflow:ellipsis;
            white-space:nowrap;
        }
    }
</style>