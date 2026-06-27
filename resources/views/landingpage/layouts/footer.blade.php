<footer class="luxury-footer">
    <div class="container">

        <div class="row gy-5">

            {{-- BRAND --}}
            <div class="col-lg-4">
                <img src="/storage/logo1.png" alt="CircleScent" class="footer-logo">

                <p class="footer-text">
                    Discover premium fragrances crafted to elevate
                    confidence, elegance, and unforgettable impressions.
                </p>

                <div class="footer-social">
                    <a href="mailto:circlescent@gmail.com">
                        <i class="bi bi-envelope"></i>
                    </a>

                    <a href="https://wa.me/628138251880" target="_blank">
                        <i class="bi bi-whatsapp"></i>
                    </a>

                    <a href="https://www.instagram.com/circlescentid?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank">
                        <i class="bi bi-instagram"></i>
                    </a>

                    <!-- TikTok -->
                    <a href="https://www.tiktok.com/@circlescent.id?is_from_webapp=1&sender_device=pc" target="_blank">
                        <i class="bi bi-tiktok"></i>
                    </a>

                    <!-- Shopee -->
                    <a href="https://shopee.co.id/circlescent" target="_blank">
                        <i class="fa-brands fa-shopify"></i>
                    </a>
                </div>
            </div>

            {{-- NAVIGATION --}}
            <div class="col-lg-2 col-md-6">
                <h5 class="footer-heading">
                    Explore
                </h5>

                <ul class="footer-menu">
                    <li><a href="/">Home</a></li>
                    <li><a href="/semuaproduk">Products</a></li>
                    <li><a href="/tentang">About</a></li>
                    <li><a href="/contactus">Contact</a></li>
                    <li><a href="/tokocabang">Store</a></li>
                </ul>
            </div>

            {{-- CUSTOMER --}}
            <div class="col-lg-2 col-md-6">
                <h5 class="footer-heading">
                    Customer
                </h5>

                <ul class="footer-menu">
                    <li>
                        <a href="{{ url('/faq') }}">
                            FAQ
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('/shipping') }}">
                            Shipping
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('/privacy-policy') }}">
                            Privacy Policy
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('/terms') }}">
                            Terms
                        </a>
                    </li>
                </ul>
            </div>

            {{-- CONTACT --}}
            <div class="col-lg-4">
                <h5 class="footer-heading">
                    Boutique Information
                </h5>

                <div class="footer-contact">

                    <div class="contact-item">
                        <i class="bi bi-geo-alt"></i>
                        <span>

                            Tebet, Jakarta Selatan, Indonesia
                        </span>
                    </div>

                    <div class="contact-item">
                        <i class="bi bi-telephone"></i>
                        <span>
                            08138251880
                        </span>
                    </div>

                    <div class="contact-item">
                        <i class="bi bi-clock"></i>
                        <span>
                            Open Everyday
                            <br>
                            09.00 AM — 10.00 PM
                        </span>
                    </div>
                </div>
            </div>

        </div>

        <div class="footer-bottom">

            <div class="footer-line"></div>

            <div class="footer-copyright">
                © {{ date('Y') }}
                CircleScent —
                Luxury Fragrance.
                All Rights Reserved.
            </div>
        </div>

    </div>
</footer>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<style>
    .footer-logo {
    height: 70px;
    width: auto;
    object-fit: contain;
}
.luxury-footer{
    background:#0b0b0b;
    color:#d7d7d7;
    padding:90px 0 35px;
    position:relative;
    overflow:hidden;
}

/* subtle top border */
.luxury-footer::before{
    content:'';
    position:absolute;
    top:0;
    left:50%;
    transform:translateX(-50%);
    width:92%;
    height:1px;
    background:
    rgba(255,255,255,.08);
}

/* LOGO */
.footer-logo{
    font-size:38px;
    font-weight:300;
    color:#fff;
    letter-spacing:3px;
    margin-bottom:22px;
    text-transform:uppercase;
}

.footer-text{
    color:#9d9d9d;
    line-height:2;
    font-size:14px;
    max-width:330px;
}

/* TITLE */
.footer-heading{
    color:#fff;
    font-size:15px;
    letter-spacing:2px;
    text-transform:uppercase;
    margin-bottom:28px;
    font-weight:500;
}

/* MENU */
.footer-menu{
    list-style:none;
    padding:0;
    margin:0;
}

.footer-menu li{
    margin-bottom:15px;
}

.footer-menu a{
    text-decoration:none;
    color:#a5a5a5;
    transition:.3s;
    font-size:14px;
    letter-spacing:.5px;
}

.footer-menu a:hover{
    color:#fff;
    padding-left:6px;
}

/* CONTACT */
.footer-contact{
    display:flex;
    flex-direction:column;
    gap:20px;
}

.contact-item{
    display:flex;
    align-items:flex-start;
    gap:14px;
}

.contact-item i{
    color:white;
    font-size:17px;
    margin-top:4px;
}

.contact-item span{
    color:#a8a8a8;
    line-height:1.8;
    font-size:14px;
}

/* SOCIAL */
.footer-social{
    display:flex;
    gap:14px;
    margin-top:30px;
}

.footer-social a{
    width:46px;
    height:46px;
    border-radius:50%;
    border:1px solid rgba(255,255,255,.08);

    display:flex;
    align-items:center;
    justify-content:center;

    color:#fff;
    text-decoration:none;

    transition:.4s ease;
}

.footer-social a:hover{
    background:#fff;
    color:#000;
    transform:translateY(-4px);
}

/* BOTTOM */
.footer-bottom{
    margin-top: 18px; /* kecilkan jarak atas */
    padding-top: 10px;
}

.footer-line{
    width:100%;
    height:1px;
    background:
    rgba(255,255,255,.08);
    margin-bottom:12px;
}

.footer-copyright{
    text-align:center;
    margin-top: 0;
    padding-top: 0;
    font-size: 14px;
}

/* MOBILE */
@media(max-width:991px){

    .luxury-footer{
        text-align:center;
        padding:70px 20px 30px;
    }

    .footer-text{
        margin:auto;
    }

    .footer-social{
        justify-content:center;
    }

    .contact-item{
        justify-content:center;
        text-align:left;
    }

    .footer-heading{
        margin-top:20px;
    }

    .footer-logo{
        font-size:30px;
    }
}
</style>