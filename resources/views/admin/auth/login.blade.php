<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Admin Login | Circle Scent</title>
    <link rel="icon" type="image/png" href="{{ asset('storage/web.webp') }}">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    {{-- Bootstrap Icon --}}
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    {{-- Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=Poppins:wght@300;400;500;600&display=swap"
        rel="stylesheet">

        <style>
            *{
                margin:0;
                padding:0;
                box-sizing:border-box;
            }

            body{
                min-height:100vh;
                font-family:'Poppins',sans-serif;
                background:
                linear-gradient(
                    rgba(0,0,0,.70),
                    rgba(0,0,0,.82)
                ),
                url('/storage/cs11.png');
                background-size:cover;
                background-position:center;
                display:flex;
                justify-content:center;
                align-items:center;
                padding:30px;
            }

            /* =========================
               CARD
            ========================= */
            .login-card{
                width:100%;
                max-width:1180px;
                min-height:720px;
                border-radius:38px;
                overflow:hidden;
                display:flex;
                background:rgba(255,255,255,.08);
                backdrop-filter:blur(18px);
                box-shadow:0 30px 80px rgba(0,0,0,.45);
            }
            /* =========================
               LEFT SIDE
            ========================= */
            .login-left{
                width:48%;
                position:relative;
                background:
                    linear-gradient(
                        rgba(0,0,0,.45),
                        rgba(0,0,0,.75)
                    ),
                    url('/storage/cs11.png');

                background-size:cover;
                background-position:center;

                display:flex;
                align-items:flex-end;
                padding:65px;
            }

            .left-content{
                max-width:500px;
                color:#fff;
            }

            .small-title{
                display:block;
                color:#d4af37;
                letter-spacing:5px;
                font-size:13px;
                text-transform:uppercase;
                margin-bottom:20px;
            }

            .brand-title{
                font-size: 58px;
                font-family: serif;
                font-weight: 700;
                line-height: 1.1;
                margin: 0 0 24px;
            }

            .brand-desc{
                max-width: 500px;
                font-size: 18px;
                line-height: 1.8;
            }

            /* =========================
               RIGHT SIDE
            ========================= */
            .login-right{
                width:52%;
                background:#fdfdfd;
                padding:80px 70px;
                display:flex;
                justify-content:center;
                align-items:center;
            }

            .form-wrapper{
                width:100%;
                max-width:420px;
            }

            .login-title{
                font-size:64px;
                font-family:serif;
                color:#111;
                margin-bottom:10px;
                line-height:1.1;
            }

            .login-subtitle{
                color:#777;
                margin-bottom:35px;
                font-size:16px;
            }

            /* =========================
               LABEL
            ========================= */
            .form-label{
                font-size:15px;
                font-weight:600;
                color:#111;
                margin-bottom:8px;
            }

            /* =========================
               INPUT
            ========================= */
            .admin-input{
                height:60px;
                border-radius:18px;
                border:1px solid #ddd;
                padding:0 22px;
                font-size:15px;
                transition:.3s;
            }

            .admin-input:focus{
                border-color:#b89045;
                box-shadow:
                0 0 0 4px rgba(184,144,69,.14);
            }

            /* PASSWORD */
            .password-wrapper{
                position:relative;
            }

            .password-toggle{
                position:absolute;
                right:22px;
                top:50%;
                transform:translateY(-50%);
                cursor:pointer;
                color:#777;
                font-size:20px;
            }

            /* =========================
               REMEMBER
            ========================= */
            .remember-wrap{
                display:flex;
                align-items:center;
                gap:10px;
                margin-top:8px;
                margin-bottom:25px;
                color:#666;
            }

            /* =========================
               BUTTON
            ========================= */
            .admin-btn{
                width:100%;
                height:60px;
                border:none;
                border-radius:999px;
                background:
                linear-gradient(
                    135deg,
                    #111,
                    #2d2d2d
                );
                color:#fff;
                font-size:17px;
                font-weight:600;
                transition:.3s;
            }

            .admin-btn:hover{
                transform:translateY(-3px);
                box-shadow:0 15px 25px rgba(0,0,0,.18);
            }

            /* =========================
               BACK LINK
            ========================= */
            .back-link{
                display:block;
                text-align:center;
                margin-top:24px;
                text-decoration:none;
                color:#b89045;
                font-size:15px;
                font-weight:500;
            }

            .back-link:hover{
                color:#111;
            }

            /* =========================
               MOBILE
            ========================= */
            @media(max-width:991px){

                .login-card{
                    flex-direction:column;
                    min-height:auto;
                    border-radius:30px;
                }

                .login-left{
                    width:100%;
                    min-height:320px;
                    padding:40px 30px;
                }

                .login-right{
                    width:100%;
                    padding:45px 30px;
                }

                .brand-title{
                    font-size:58px;
                }

                .login-title{
                    font-size:48px;
                }
            }
            </style>
</head>
<body>

    <div class="login-card">

        <div class="login-left">
            <div class="left-content">
                <span class="small-title">
                    ADMIN PANEL
                </span>

                <h1 class="brand-title">
                    Circle Scent
                </h1>

                <p class="brand-desc">
                    Kelola produk parfum, pesanan, customer,
                    dan seluruh sistem website Circle Scent
                    dengan mudah.
                </p>
            </div>
        </div>

        <div class="login-right">

            <div class="form-wrapper">

                <h2 class="login-title">
                    Welcome Admin
                </h2>

                <p class="login-subtitle">
                    Login untuk mengelola website Circle Scent
                </p>

                <form method="POST" action="{{ route('admin.login.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">
                            Email
                        </label>

                        <input type="email"
                            name="email"
                            class="form-control admin-input"
                            placeholder="Masukkan email"
                            value="{{ old('email') }}"
                            required>

                        @error('email')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Password
                        </label>

                        <div class="password-wrapper">
                            <input type="password"
                                name="password"
                                id="adminPass"
                                class="form-control admin-input pe-5"
                                placeholder="Masukkan password"
                                required>

                            <i class="bi bi-eye password-toggle"
                                onclick="togglePassword('adminPass', this)">
                            </i>
                        </div>

                        @error('password')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    <div class="remember-wrap">
                        <input type="checkbox" name="remember">
                        <span>Remember me</span>
                    </div>

                    <button type="submit" class="admin-btn">
                        Login Admin
                    </button>

                    <a href="/" class="back-link">
                        ← Kembali ke Website
                    </a>
                </form>

            </div>

        </div>
    </div>

<script>
function togglePassword(id, icon){

    let input =
        document.getElementById(id);

    if(input.type === "password"){
        input.type = "text";
        icon.classList.replace(
            "bi-eye",
            "bi-eye-slash"
        );
    }else{
        input.type = "password";
        icon.classList.replace(
            "bi-eye-slash",
            "bi-eye"
        );
    }
}
</script>

</body>
</html>