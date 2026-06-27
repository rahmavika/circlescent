<div class="modal fade" id="registerModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered register-dialog">
        <div class="modal-content perfume-register border-0">

            {{-- CLOSE --}}
            <button type="button"
                class="btn-close register-close"
                data-bs-dismiss="modal">
            </button>

            <div class="row g-0">

                {{-- LEFT IMAGE --}}
                <div class="col-lg-5 d-none d-lg-block">
                    <div class="register-banner">
                        <div class="register-overlay">

                            <span class="register-small">
                                JOIN CIRCLE SCENT
                            </span>

                            <h2>
                                Circle Scent
                            </h2>

                            <p>
                                Daftar dan temukan aroma terbaik
                                untuk menemani setiap momenmu.
                            </p>

                        </div>
                    </div>
                </div>

                {{-- FORM --}}
                <div class="col-lg-7">
                    <div class="register-content">

                        <h3 class="register-title">
                            Create Account
                        </h3>

                        <p class="register-desc">
                            Daftar akun Circle Scent sekarang
                        </p>

                        <form method="POST" action="/register">
                            @csrf

                            <div class="row">

                                {{-- NAMA --}}
                                <div class="col-md-6 mb-3">
                                    <label class="register-label">
                                        Nama Lengkap
                                    </label>

                                    <input type="text"
                                        name="name"
                                        class="form-control register-input"
                                        placeholder="Nama lengkap"
                                        required>
                                </div>

                                {{-- EMAIL --}}
                                <div class="col-md-6 mb-3">
                                    <label class="register-label">
                                        Email
                                    </label>

                                    <input type="email"
                                        name="email"
                                        class="form-control register-input"
                                        placeholder="Email"
                                        required>
                                </div>

                                {{-- NO HP --}}
                                <div class="col-md-6 mb-3">
                                    <label class="register-label">
                                        No Handphone
                                    </label>

                                    <input type="text"
                                        name="phone"
                                        class="form-control register-input"
                                        placeholder="08xxxxxxxxxx"
                                        required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="register-label">
                                        Password
                                    </label>

                                    <div class="password-wrapper">
                                        <input type="password"
                                            name="password"
                                            id="regPass"
                                            class="form-control register-input pe-5"
                                            placeholder="Password"
                                            required>

                                        <i class="bi bi-eye register-eye"
                                            onclick="togglePassword('regPass', this)">
                                        </i>
                                    </div>
                                </div>

                                {{-- CONFIRM PASSWORD --}}
                                <div class="col-12 mb-3">
                                    <label class="register-label">
                                        Konfirmasi Password
                                    </label>

                                    <div class="password-wrapper">
                                        <input type="password"
                                            name="password_confirmation"
                                            id="regPass2"
                                            class="form-control register-input pe-5"
                                            placeholder="Ulangi password"
                                            required>

                                        <i class="bi bi-eye register-eye"
                                            onclick="togglePassword('regPass2', this)">
                                        </i>
                                    </div>
                                </div>

                            </div>

                            {{-- BUTTON --}}
                            <button class="btn register-btn w-100">
                                Daftar Sekarang
                            </button>

                            {{-- Divider --}}
                            <div class="register-divider">
                                <span>atau</span>
                            </div>

                            {{-- GOOGLE --}}
                            <a href="{{ url('/auth/google') }}"
                                class="register-google">

                                <img src="https://cdn-icons-png.flaticon.com/512/300/300221.png"
                                    width="18">

                                <span>
                                    Daftar dengan Google
                                </span>
                            </a>

                            {{-- LOGIN --}}
                            <p class="register-footer">
                                Sudah punya akun?

                                <a href="#"
                                    onclick="switchToLogin()">
                                    Masuk
                                </a>
                            </p>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    function switchToRegister(){

        const loginEl = document.getElementById('loginModal');
        const registerEl = document.getElementById('registerModal');

        const loginModal =
            bootstrap.Modal.getInstance(loginEl);

        loginModal.hide();

        loginEl.addEventListener(
            'hidden.bs.modal',
            function(){

                // bersihin backdrop sisa
                document
                    .querySelectorAll('.modal-backdrop')
                    .forEach(el => el.remove());

                document.body.classList.remove('modal-open');
                document.body.style = '';

                const registerModal =
                    new bootstrap.Modal(registerEl);

                registerModal.show();
            },
            { once: true }
        );
    }
</script>
<style>
    /* =========================================
    LOGIN & REGISTER MODAL - CIRCLESCENT
    COMPACT PREMIUM VERSION
    ========================================= */

    /* BACKDROP */
    .modal-backdrop.show{
        opacity: .75;
        backdrop-filter: blur(6px);
    }

    /* =========================================
    DIALOG SIZE
    ========================================= */
    .login-dialog,
    .register-dialog{
        max-width: 820px;
        width: 88%;
    }

    /* BIAR GA KETUTUP HEADER */
    #loginModal .modal-dialog,
    #registerModal .modal-dialog{
        margin-top: 28px;
    }

    .modal-dialog-centered{
        min-height: calc(100% - 1rem);
    }

    /* =========================================
    BATAS TINGGI MODAL
    ========================================= */
    #loginModal .modal-content,
    #registerModal .modal-content{
        max-height: 88vh;
        overflow-y: auto;
        scrollbar-width: thin;
    }

    /* =========================================
    MODAL BOX
    ========================================= */
    .perfume-login,
    .perfume-register{
        border-radius: 24px;
        overflow: hidden;
        background: #fdfbf8;
        box-shadow: 0 20px 55px rgba(0,0,0,.22);
        position: relative;
    }

    /* =========================================
    CLOSE BUTTON
    ========================================= */
    .custom-close,
    .register-close{
        position: absolute;
        top: 16px;
        right: 16px;
        z-index: 999;
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background-color: rgba(255,255,255,.96);
        box-shadow: 0 5px 15px rgba(0,0,0,.12);
        opacity: 1 !important;
        transition: .3s;
        filter: brightness(0);
    }

    .custom-close:hover,
    .register-close:hover{
        transform: rotate(90deg);
    }

    /* =========================================
    LEFT BANNER
    ========================================= */
    .login-banner,
    .register-banner{
        height: 100%;
        min-height: 470px;
        background:
            linear-gradient(
                rgba(0,0,0,.28),
                rgba(0,0,0,.58)
            ),
            url('/storage/cs11.png');
        background-size: cover;
        background-position: center;
        position: relative;
    }

    /* OVERLAY */
    .banner-overlay,
    .register-overlay{
        position: absolute;
        left: 32px;
        bottom: 32px;
        color: white;
        max-width: 240px;
    }

    /* SMALL TEXT */
    .small-text,
    .register-small{
        font-size: 10px;
        letter-spacing: 4px;
        text-transform: uppercase;
        opacity: .85;
    }

    /* TITLE */
    .banner-overlay h2,
    .register-overlay h2{
        font-size: 36px;
        font-family: 'Playfair Display', serif;
        margin: 8px 0;
        font-weight: 700;
    }

    .banner-overlay p,
    .register-overlay p{
        font-size: 13px;
        line-height: 1.7;
        opacity: .95;
    }

    /* =========================================
    CONTENT
    ========================================= */
    .login-content,
    .register-content{
        padding: 28px 32px;
    }

    /* TITLE */
    .login-heading,
    .register-title{
        font-size: 30px;
        font-family: 'Playfair Display', serif;
        color: #111;
        margin-bottom: 4px;
        line-height: 1.2;
    }

    .login-desc,
    .register-desc{
        color: #777;
        margin-bottom: 16px;
        font-size: 13px;
    }

    /* =========================================
    LABEL
    ========================================= */
    .luxury-label,
    .register-label{
        display: block;
        font-size: 12px;
        font-weight: 600;
        color: #222;
        margin-bottom: 5px;
    }

    /* =========================================
    INPUT
    ========================================= */
    .luxury-input,
    .register-input{
        height: 44px;
        border-radius: 12px;
        border: 1px solid #ddd;
        background: #fff;
        padding: 0 14px;
        font-size: 13px;
        transition: .3s;
    }

    .luxury-input:focus,
    .register-input:focus{
        border-color: #b89045;
        box-shadow: 0 0 0 4px rgba(184,144,69,.12);
    }

    .luxury-input::placeholder,
    .register-input::placeholder{
        color: #aaa;
    }

    /* =========================================
    PASSWORD ICON
    ========================================= */
    /* FIX POSISI ICON EYE */
    .register-eye,
    .password-toggle{
        position: absolute;
        right: 16px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #888;
        font-size: 18px;
        z-index: 10;
        transition: .2s;
    }

    .register-eye:hover,
    .password-toggle:hover{
        color: #111;
    }

    /* WRAPPER PASSWORD */
    .password-wrapper{
        position: relative;
    }

    /* BIAR ICON GA NUTUP TEXT */
    .register-input.pe-5,
    .luxury-input.pe-5{
        padding-right: 48px !important;
    }

    /* =========================================
    FORGOT PASSWORD
    ========================================= */
    .forgot-password{
        text-decoration: none;
        color: #a07d45;
        font-size: 12px;
    }

    .forgot-password:hover{
        color: #111;
    }

    /* =========================================
    BUTTON
    ========================================= */
    .luxury-btn,
    .register-btn{
        height: 46px;
        border-radius: 999px;
        border: none;
        background: linear-gradient(
            135deg,
            #111,
            #2d2d2d
        );
        color: white;
        font-size: 13px;
        font-weight: 600;
        transition: .3s;
    }

    .luxury-btn:hover,
    .register-btn:hover{
        transform: translateY(-2px);
        box-shadow: 0 10px 18px rgba(0,0,0,.15);
    }

    /* =========================================
    DIVIDER
    ========================================= */
    .or-divider,
    .register-divider{
        position: relative;
        text-align: center;
        margin: 14px 0;
    }

    .or-divider::before,
    .register-divider::before{
        content: "";
        position: absolute;
        width: 100%;
        height: 1px;
        background: #ddd;
        top: 50%;
        left: 0;
    }

    .or-divider span,
    .register-divider span{
        position: relative;
        background: #fdfbf8;
        padding: 0 14px;
        color: #999;
        font-size: 12px;
    }

    /* =========================================
    GOOGLE BUTTON
    ========================================= */
    .google-login,
    .register-google{
        height: 44px;
        border: 1px solid #ddd;
        border-radius: 12px;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        color: #111;
        font-size: 13px;
        transition: .3s;
    }

    .google-login:hover,
    .register-google:hover{
        background: #f5f5f5;
        border-color: #ccc;
    }

    /* =========================================
    FOOTER
    ========================================= */
    .register-text,
    .register-footer{
        text-align: center;
        margin-top: 14px;
        color: #666;
        font-size: 12px;
    }

    .register-text a,
    .register-footer a,
    .register-link{
        color: #b89045;
        text-decoration: none;
        font-weight: 700;
    }

    .register-text a:hover,
    .register-footer a:hover,
    .register-link:hover{
        color: #111;
    }

    /* =========================================
    MOBILE
    ========================================= */
    @media(max-width:991px){

        .login-dialog,
        .register-dialog{
            width: 94%;
            max-width: 100%;
        }

        .login-content,
        .register-content{
            padding: 24px 20px;
        }

        .login-heading,
        .register-title{
            font-size: 26px;
        }

        .perfume-login,
        .perfume-register{
            border-radius: 20px;
        }

        .luxury-input,
        .register-input,
        .luxury-btn,
        .register-btn,
        .google-login,
        .register-google{
            height: 44px;
        }

        .login-banner,
        .register-banner{
            min-height: 220px;
        }

        #loginModal .modal-dialog,
        #registerModal .modal-dialog{
            margin-top: 12px;
        }
    }
</style>