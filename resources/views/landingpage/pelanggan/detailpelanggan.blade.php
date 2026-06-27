<div class="modal fade" id="detailPelangganModal" tabindex="-1">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content profile-modal border-0">

            <!-- Header -->
            <div class="modal-header profile-header border-0 px-4 pt-4 pb-2">
                <h5 class="modal-title text-white fw-semibold">
                    Profil Saya
                </h5>

                <button type="button"
                        class="btn-close btn-close-white shadow-none"
                        data-bs-dismiss="modal">
                </button>
            </div>

            <!-- Body -->
            <div class="modal-body px-4 pb-4 pt-2 text-center">

                <!-- Profile -->
                <div class="profile-avatar mx-auto mb-3">
                    <i class="bi bi-person-fill"></i>
                </div>

                <h5 class="text-white fw-semibold mb-1">
                    {{ session('name') }}
                </h5>

                <p class="text-secondary small mb-4">
                    Akun Pelanggan
                </p>

                <!-- Info -->
                <div class="profile-card text-start">

                    <div class="profile-item">
                        <small>Username</small>
                        <span>{{ session('name') }}</span>
                    </div>

                    <div class="profile-item">
                        <small>Email</small>
                        <span>{{ session('email') }}</span>
                    </div>

                    <div class="profile-item border-0 pb-0 mb-0">
                        <small>No HP</small>
                        <span>{{ session('phone') }}</span>
                    </div>

                </div>

                <!-- Buttons -->
                <div class="d-grid gap-2 mt-4">

                    <button class="btn edit-btn"
                            data-bs-toggle="modal"
                            data-bs-target="#editProfileModal">

                        <i class="bi bi-pencil-square me-1"></i>
                        Edit Profil
                    </button>

                    <form action="/logout" method="POST">
                        @csrf
                        <button class="btn logout-btn w-100">
                            Logout
                        </button>
                    </form>

                </div>

            </div>
        </div>
    </div>
</div>

<style>
    /* MODAL */
    .profile-modal{
        background:#141414;
        border-radius:24px;
        border:1px solid rgba(255,255,255,.06);
        box-shadow:0 20px 60px rgba(0,0,0,.45);
    }

    /* HEADER */
    .profile-header{
        background:none;
    }

    /* AVATAR */
    .profile-avatar{
        width:75px;
        height:75px;
        border-radius:50%;
        background:
        linear-gradient(135deg,#ffffff,#ffffff);
        display:flex;
        align-items:center;
        justify-content:center;
    }

    .profile-avatar i{
        font-size:34px;
        color:#111;
    }

    /* CARD INFO */
    .profile-card{
        background:#1b1b1b;
        border:1px solid rgba(255,255,255,.05);
        border-radius:18px;
        padding:18px;
    }

    .profile-item{
        display:flex;
        justify-content:space-between;
        align-items:center;
        border-bottom:1px solid rgba(255,255,255,.06);
        padding-bottom:14px;
        margin-bottom:14px;
    }

    .profile-item small{
        color:#8f8f8f;
    }

    .profile-item span{
        color:#fff;
        font-size:14px;
        font-weight:500;
        text-align:right;
        max-width:60%;
        word-break:break-word;
    }

    /* BUTTON */
    .edit-btn{
        background:
        linear-gradient(135deg,#ffffff,#ffffff);
        border:none;
        color:#111;
        font-weight:600;
        border-radius:14px;
        height:48px;
    }

    .edit-btn:hover{
        transform:translateY(-2px);
    }

    .logout-btn{
        background:#202020;
        border:1px solid rgba(255,255,255,.08);
        color:#ffffff;
        border-radius:14px;
        height:48px;
        font-weight:500;
    }

    .logout-btn:hover{
        background:#262626;
        color:#fff;
    }
</style>