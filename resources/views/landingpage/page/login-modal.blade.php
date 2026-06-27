<div class="modal fade" id="loginModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered login-dialog">
        <div class="modal-content perfume-login border-0">

            <button type="button"
                class="btn-close custom-close"
                data-bs-dismiss="modal">
            </button>

            <div class="row g-0">

                {{-- IMAGE --}}
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="login-banner">
                        <div class="banner-overlay">
                            <span class="small-text">
                                LUXURY PERFUME
                            </span>

                            <h2>
                                Circle Scent
                            </h2>

                            <p>
                                Temukan aroma yang mencerminkan karakter eleganmu.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- FORM --}}
                <div class="col-lg-6">
                    <div class="login-content">

                        <h3 class="login-heading">
                            Welcome Back
                        </h3>

                        <p class="login-desc">
                            Masuk ke akun Circle Scent
                        </p>

                        <form method="POST" action="/login">
                            @csrf

                            {{-- EMAIL --}}
                            <div class="mb-3">
                                <label class="form-label luxury-label">
                                    Email
                                </label>

                                <input type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    class="form-control luxury-input {{ $errors->has('email') ? 'input-error' : '' }}"
                                    placeholder="Masukkan email"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label luxury-label">
                                    Password
                                </label>
                                <div class="password-wrapper">
                                    <input type="password"
                                        name="password"
                                        id="loginPass"
                                        class="form-control luxury-input pe-5 {{ $errors->has('email') ? 'input-error' : '' }}"
                                        placeholder="Masukkan password"
                                        required>

                                    <i class="bi bi-eye password-toggle"
                                        onclick="togglePassword('loginPass', this)">
                                    </i>
                                </div>

                                @error('email')
                                    <div class="login-error">
                                        <i class="bi bi-exclamation-circle-fill"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>


                            <div class="text-end mb-4">
                                <a href="#"
                                    class="forgot-password">
                                    Lupa Password?
                                </a>
                            </div>

                            {{-- BUTTON --}}
                            <button class="btn luxury-btn w-100">
                                Masuk
                            </button>

                            {{-- Divider --}}
                            <div class="or-divider">
                                <span>atau</span>
                            </div>

                            {{-- GOOGLE --}}
                            <a href="{{ url('/auth/google') }}"
                                class="google-login">

                                <img src="https://cdn-icons-png.flaticon.com/512/300/300221.png"
                                    width="20">

                                <span>
                                    Lanjutkan dengan Google
                                </span>
                            </a>

                            {{-- REGISTER --}}
                            <p class="register-text">
                                Belum punya akun?

                                <a href="#"
                                    onclick="switchToRegister()">
                                    Daftar
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
    function switchToLogin(){

        const registerEl =
            document.getElementById('registerModal');

        const loginEl =
            document.getElementById('loginModal');

        const registerModal =
            bootstrap.Modal.getInstance(registerEl);

        registerModal.hide();

        registerEl.addEventListener(
            'hidden.bs.modal',
            function(){

                // bersihin backdrop sisa
                document
                    .querySelectorAll('.modal-backdrop')
                    .forEach(el => el.remove());

                document.body.classList.remove('modal-open');
                document.body.style = '';

                const loginModal =
                    new bootstrap.Modal(loginEl);

                loginModal.show();
            },
            { once: true }
        );
    }

</script>
@if(session('login_modal'))
<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = new bootstrap.Modal(document.getElementById('loginModal'));
    modal.show();
});
</script>
@endif

<style>

    .input-error{
        border:1px solid #dc3545 !important;
        box-shadow:none !important;
    }

    .input-error:focus{
        border-color:#dc3545 !important;
        box-shadow:0 0 0 4px rgba(220,53,69,.15) !important;
    }

    .login-error{
        margin-top:8px;
        color:#dc3545;
        font-size:14px;
        font-weight:500;
        display:flex;
        align-items:center;
        gap:6px;
    }

    /* ==========================
       MODAL SIZE
    ========================== */
    .login-dialog{
        max-width: 820px;
        width: 88%;
    }

    #loginModal .modal-dialog{
        margin-top: 60px;
    }

    .modal-dialog-centered{
        min-height: calc(100% - 3rem);
    }

    /* ==========================
       MAIN MODAL
    ========================== */
    .perfume-login{
        border-radius: 30px;
        overflow: hidden;
        background: #fdfbf7;
        box-shadow: 0 25px 65px rgba(0,0,0,.25);
        position: relative;
    }

    /* ==========================
       CLOSE BUTTON
    ========================== */
    .custom-close{
        position: absolute;
        right: 22px;
        top: 22px;
        z-index: 10;
        background-size: 12px;
    }

    /* ==========================
       LEFT SIDE BANNER
    ========================== */
    .login-banner{
        height: 100%;
        min-height: 560px;
        background:
            linear-gradient(
                rgba(0,0,0,.35),
                rgba(0,0,0,.55)
            ),
            url('/storage/cs11.png');
        background-size: cover;
        background-position: center;
        position: relative;
    }

    .banner-overlay{
        position: absolute;
        bottom: 50px;
        left: 40px;
        color: white;
        max-width: 280px;
    }

    .small-text{
        letter-spacing: 4px;
        font-size: 11px;
        opacity: .85;
    }

    .banner-overlay h2{
        font-size: 42px;
        font-family: serif;
        font-weight: bold;
        margin: 10px 0;
    }

    .banner-overlay p{
        font-size: 14px;
        opacity: .9;
        line-height: 1.7;
    }

    /* ==========================
       RIGHT SIDE FORM
    ========================== */
    .login-content{
        padding: 55px 45px;
    }

    .login-heading{
        font-size: 36px;
        font-family: serif;
        color: #111;
        margin-bottom: 8px;
    }

    .login-desc{
        color: #777;
        margin-bottom: 28px;
        font-size: 14px;
    }

    /* ==========================
       LABEL
    ========================== */
    .luxury-label{
        font-weight: 600;
        margin-bottom: 8px;
        color: #222;
        font-size: 14px;
    }

    /* ==========================
       INPUT
    ========================== */
    .luxury-input{
        height: 54px;
        border-radius: 16px;
        border: 1px solid #ddd;
        background: #fff;
        padding: 0 20px;
        font-size: 14px;
        transition: .3s;
    }

    .luxury-input:focus{
        border-color: #b89045;
        box-shadow: 0 0 0 4px rgba(184,144,69,.15);
    }

    /* ==========================
    PASSWORD ICON FIX
    ========================== */
    .password-wrapper{
        position: relative;
    }

    .password-toggle,
    .register-eye{
        position: absolute;
        right: 16px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #777;
        font-size: 18px;
        z-index: 5;
        transition: .2s;
    }

    .password-toggle:hover,
    .register-eye:hover{
        color: #111;
    }

    /* BIAR TEXT INPUT GA KETIMPA ICON */
    .luxury-input.pe-5,
    .register-input.pe-5{
        padding-right: 48px !important;
    }

        /* ==========================
        FORGOT PASSWORD
        ========================== */
        .forgot-password{
            text-decoration: none;
            color: #9a7b42;
            font-size: 14px;
        }

        .forgot-password:hover{
            color: #b89045;
        }

        /* ==========================
        BUTTON LOGIN
        ========================== */
        .luxury-btn{
            height: 54px;
            border-radius: 50px;
            border: none;
            background:
                linear-gradient(
                    135deg,
                    #111,
                    #2b2b2b
                );
            color: white;
            font-weight: 600;
            font-size: 15px;
            transition: .3s;
        }

        .luxury-btn:hover{
            transform: translateY(-2px);
        }

        /* ==========================
        DIVIDER
        ========================== */
        .or-divider{
            text-align: center;
            margin: 26px 0;
            position: relative;
        }

        .or-divider::before{
            content: "";
            position: absolute;
            width: 100%;
            height: 1px;
            background: #ddd;
            left: 0;
            top: 50%;
        }

        .or-divider span{
            background: #fdfbf7;
            position: relative;
            padding: 0 18px;
            color: #888;
            font-size: 14px;
        }

        /* ==========================
        GOOGLE BUTTON
        ========================== */
        .google-login{
            height: 54px;
            border: 1px solid #ddd;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            text-decoration: none;
            color: #111;
            transition: .3s;
            font-size: 14px;
        }

        .google-login:hover{
            background: #f6f6f6;
        }

        /* ==========================
        REGISTER TEXT
        ========================== */
        .register-text{
            text-align: center;
            margin-top: 24px;
            color: #666;
            font-size: 14px;
        }

        .register-text a{
            color: #b89045;
            text-decoration: none;
            font-weight: 700;
        }

        .register-text a:hover{
            color: #9a7b42;
        }

        /* ==========================
        MOBILE
        ========================== */
        @media(max-width:991px){

            .login-dialog{
                width: 94%;
                max-width: 100%;
            }

            .login-content{
                padding: 38px 24px;
            }

            .login-heading{
                font-size: 30px;
            }

            .perfume-login{
                border-radius: 24px;
            }

            .luxury-input,
            .luxury-btn,
            .google-login{
                height: 52px;
            }
        }
        #loginModal .modal-content,
        #registerModal .modal-content{
            max-height: 88vh;
            overflow-y: auto;
    }
</style>