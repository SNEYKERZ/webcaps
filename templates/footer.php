<style>
    /* STYLES FOOTER */
    #pre-footer figure {
        padding-bottom: 20px;
        margin: 0;
        justify-content: center;
        align-items: center;
    }

    #pre-footer .social-media a {
        display: inline-block;
        text-decoration: none;
        width: 45px;
        height: 45px;
        line-height: 45px;
        color: #fff;
        margin-right: 10px;
        text-align: center;
        transition: all 300ms ease;
    }

    #pre-footer .social-media a:hover {
        transform: scale(1.5);
    }

    @media screen and (max-width:800px) {
        #pre-footer figure {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 100%;
        }

        #pre-footer .about-us {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        #pre-footer .social-media {
            align-items: center;
            justify-content: center;
            display: flex;
            flex-direction: column;
        }
    }

    @media screen and (max-width:500px) {
        .container figure a {
            width: 300px !important;
        }
    }
</style>

<!-- Pre-Footer de Información -->
<section id="pre-footer" class="py-5" style="background-color: #202124;">
    <div class="container-map gap-3" style="padding: 20px 20px 10px 20px;">
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15929.036855565007!2d-76.2980523!3d3.5274827!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e3a057a956758ff%3A0x7ab362da06171ea4!2sCaps%20palmira!5e0!3m2!1ses!2sco!4v1681932814096!5m2!1ses!2sco" width="100%" height="350" style="border-radius: 10px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <div class="container gap-3">
        <div class="row">
            <div class="col-lg-6">
                <figure>
                    <a href="#" style="width: 300px;">
                        <img src="assets/images/caps.png" alt="caps">
                        <img src="assets/images/culture.png" alt="culture">
                    </a>
                </figure>
            </div>
            <div class="col-lg-3">
                <div class="about-us text-light gap-3">
                    <h2 class="text-uppercase fw-bold">Contacto</h2>
                    <p><i class="fa-solid fa-house" style="color: #ffffff;"></i> Palmira, Valle del Cauca, Colombia</p>
                    <p><i class="fa-solid fa-map-pin" style="color: #ffffff;"></i> Cra. 27 #30-63</p>
                    <p><i class="fa-solid fa-envelope" style="color: #ffffff;"></i> capspalmira@gmail.com</p>
                    <p><i class="fas fa-phone" style="color: #ffffff;"></i> +57 315 8726969</p>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="social-media text-light d-sm-flex flex-sm-column align-items-center">
                    <h2 class="text-uppercase fw-bold">Redes sociales</h2>
                    <div class="d-flex justify-content-start gap-3">
                        <a target="_blank" href="https://www.facebook.com/Capscultura"><img src="assets/images/metaforas/social_media-facebook.svg" alt="logo facebook"></a>
                        <a target="_blank" href="https://www.instagram.com/caps_palmira/"><img src="assets/images/metaforas/social_media-instagram.svg" alt="logo instagram"></a>
                        <a target="_blank" href="https://www.tiktok.com/@capsculture"><img src="assets/images/metaforas/social_media-tik-tok.svg" alt="logo tiktok"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<footer style="background-color: #171717;">
    <!-- Footer information -->
    <div class="container text-center py-3">
        <div class="p-6" style="color: #fff">
            © 2023 Copyright - Caps Culture
        </div>
    </div>
</footer>

<script src="assets/js/scripts.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script async defer src="https://tools.luckyorange.com/core/lo.js?site-id=3ea9358f"></script>