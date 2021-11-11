<?php

?>
<!-- footer section -->
<footer class="footer">
                <div class="container">
                    <div class="footer-newsletter">
                            <div class="row align-items-center">
                                <div class="col-md-6 text-center text-md-left mb-3 mb-md-0">
                                    <div class="newsletter-heading">
                                        <h5>Know it all first</h5>
                                    </div>
                                </div>
                                <div class="col-md-6 d-flex justify-content-center justify-content-md-end">
                                <?php
                                    if (isset($_SESSION['logged_in'])) {
                                    if ($_SESSION['logged_in'] == TRUE) {
                                ?>
                                   <input type="hidden" class="newsletter_token" id="token" name="token">
                                   <button class="btn btn-md active userSubscription" value="<?php echo $logged_in_email; ?>" style="background-color: #FD5555; color: white;" role="button" aria-pressed="true" >SUBSCRIBE</button>
                                <?php
                                    }
                                    else{
                                ?>
                                    <div class="newsletter-form">
                                        <input type="email" name="email" id="anonymousEmail" placeholder="E-mail Address">
                                        <input type="hidden" class="newsletter_token" id="token" name="token">
                                        <button class="submit-btn anonymousSubscription">
                                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><path style="fill:#2196F3;" d="M511.189,259.954c1.649-3.989,0.731-8.579-2.325-11.627l-192-192 c-4.237-4.093-10.99-3.975-15.083,0.262c-3.992,4.134-3.992,10.687,0,14.82l173.803,173.803H10.667 C4.776,245.213,0,249.989,0,255.88c0,5.891,4.776,10.667,10.667,10.667h464.917L301.803,440.328 c-4.237,4.093-4.355,10.845-0.262,15.083c4.093,4.237,10.845,4.354,15.083,0.262c0.089-0.086,0.176-0.173,0.262-0.262l192-192 C509.872,262.42,510.655,261.246,511.189,259.954z"/><path d="M309.333,458.546c-5.891,0.011-10.675-4.757-10.686-10.648c-0.005-2.84,1.123-5.565,3.134-7.571L486.251,255.88 L301.781,71.432c-4.093-4.237-3.975-10.99,0.262-15.083c4.134-3.992,10.687-3.992,14.82,0l192,192 c4.164,4.165,4.164,10.917,0,15.083l-192,192C314.865,457.426,312.157,458.546,309.333,458.546z"/><path d="M501.333,266.546H10.667C4.776,266.546,0,261.771,0,255.88c0-5.891,4.776-10.667,10.667-10.667h490.667 c5.891,0,10.667,4.776,10.667,10.667C512,261.771,507.224,266.546,501.333,266.546z"/></svg>
                                        </button>
                                    </div>  
                                    <?php
                                         }
                                    }
                                    else{
                                    ?>
                                        <div class="newsletter-form">
                                            <input type="email" name="email" id="anonymousEmail" placeholder="E-mail Address">
                                            <input type="hidden" class="newsletter_token" id="token" name="token">
                                            <button class="submit-btn anonymousSubscription">
                                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><path style="fill:#2196F3;" d="M511.189,259.954c1.649-3.989,0.731-8.579-2.325-11.627l-192-192 c-4.237-4.093-10.99-3.975-15.083,0.262c-3.992,4.134-3.992,10.687,0,14.82l173.803,173.803H10.667 C4.776,245.213,0,249.989,0,255.88c0,5.891,4.776,10.667,10.667,10.667h464.917L301.803,440.328 c-4.237,4.093-4.355,10.845-0.262,15.083c4.093,4.237,10.845,4.354,15.083,0.262c0.089-0.086,0.176-0.173,0.262-0.262l192-192 C509.872,262.42,510.655,261.246,511.189,259.954z"/><path d="M309.333,458.546c-5.891,0.011-10.675-4.757-10.686-10.648c-0.005-2.84,1.123-5.565,3.134-7.571L486.251,255.88 L301.781,71.432c-4.093-4.237-3.975-10.99,0.262-15.083c4.134-3.992,10.687-3.992,14.82,0l192,192 c4.164,4.165,4.164,10.917,0,15.083l-192,192C314.865,457.426,312.157,458.546,309.333,458.546z"/><path d="M501.333,266.546H10.667C4.776,266.546,0,261.771,0,255.88c0-5.891,4.776-10.667,10.667-10.667h490.667 c5.891,0,10.667,4.776,10.667,10.667C512,261.771,507.224,266.546,501.333,266.546z"/></svg>
                                            </button>
                                         </div>      
                                    <?php
                                        }
                                    ?>
                                </div>
                            </div>
                    </div>

                    <div class="footer-top">
                        <div class="row">
                            <div class="col-md-6 col-lg-3">
                                <div class="footer-widget">
                                    <a href="index.php" class="footer-logo"><img src="assets/images/LOGO.png" height="130px" width="130px" alt="logo"></a>
                                    
                                    <ul class="social-media-list d-flex flex-wrap">
                                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                        <li><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-3">
                                <div class="footer-widget">
                                    <h5 class="footer-title">Get to know more</h5>
                                    <div class="widget-wrapper">
                                        <ul>
                                        <li><a href="about.php#who_we_are">How it works</a></li>
                                        <li><a href="faq.php">FAQs</a></li>
                                        <li><a href="privacy-policy.php">Privacy policy</a></li>
                                        <li><a href="cookie-policy.php">Cookies</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-3">
                                <div class="footer-widget">
                                    <h5 class="footer-title">Useful Links</h5>
                                    <div class="widget-wrapper">
                                        <ul>
                                            <li><a href="homes-list.php">Homes List</a></li>
                                            <!--<li><a href="#">Careers</a></li>-->
                                            <li><a href="contact.php">Contact Us</a></li>
                                            <li><a href="site-map.php">Site Map</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-3">
                                <div class="footer-widget">
                                    <h5 class="footer-title">Download Apps</h5>
                                    <div class="widget-wrapper">
                                        <div class="apps-store">
                                            <a href=""><img src="assets/images/app-store/apple.png" alt="app"></a>
                                            <a href=""><img src="assets/images/app-store/google.png" alt="app"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="footer-bottom">
                        <div class="row">
                            <div class="col-md-5 text-center text-md-left mb-3 mb-md-0">
                            <?php
                            $currentYear = date("Y");
                            ?>
                                <p class="copyright">Copyright &copy; <?php echo $currentYear; ?> <a href=""><?php echo $organization ?></a>&emsp;|&emsp;All Rights Reserved.</p>
                            </div>

                            <div class="col-md-7 d-flex justify-content-center justify-content-md-end">
                            <p>This site is protected by reCAPTCHA and the Google <a href="https://policies.google.com/privacy">Privacy Policy</a> and <a href="https://policies.google.com/terms">Terms of Service</a> apply.</p>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </footer>
            <!-- footer section -->
        </div>
    </div>




    <!-- mobile-footer -->
    <div class="mobile-footer d-flex justify-content-between align-items-center d-xl-none">
        <button class="info" type="button" data-toggle="modal" data-target="#siteinfo1"><i class="fas fa-info-circle"></i></button>

        <div class="footer-cart">
              <a onclick="cartopen()" href="#"><span class="cart-icon"><i class="fa fa-bell"></i></span> <span class="cart-amount"></span></a>
        </div>

        <div class="footer-admin-area">
            <!-- <span class="user-admin">
                <i class="fas fa-user"></i>
            </span> -->
            <button class="user-admin" type="button" data-toggle="modal" data-target="#useradmin1"><i class="fas fa-user"></i></button>
        </div>
    </div>
    <!-- mobile-footer -->



   <!--ad popup--> 
       <div id="popup" class="popup" style="display: none">
        <div class="popup-overlay"></div>
        <div class="popup-wrapper">
            <div class="popupbox">
               <div class="container cookieContainer">
                   <h4>Cookies</h4>
                   <hr>
                   <p>This site uses cookies to give you the best experience on our site and show you personalised ads.
                     By accepting you agree to our <a href="privacy-policy.php" style="color: #FD5555;">privacy</a> and <a href="cookie-policy.php" style="color: #FD5555;">cookie</a> policies.</p>
                     <hr>
                     <div class='row'>  
                    <button class="btn btn-outline-danger cookie-btn offset-1 rounded-pill">Accept</button>
                    <button class="btn btn-outline-danger cookie-exit offset-2 rounded-pill">Decline</button> 
                    </div>
            </div>
                <!--<button class="popup-close"><img src="assets/images/popup-close.png" alt="popup-close"></button>-->
            </div>
        </div>
    </div>

    <a href="#top-page" class="to-top js-scroll-trigger"><span><i class="fas fa-arrow-up"></i></span></a>
    <script src='assets/js/jquery.min.js'></script>
    <script src='assets/js/bootstrap.bundle.min.js'></script>
    <script src='assets/js/swiper.min.js'></script>
    <script src="assets/js/slick.js"></script>
    <script src='assets/js/jquery-easeing.min.js'></script>
    <script src='assets/js/scroll-nav.js'></script>
    <script src="assets/js/jquery.elevatezoom.js"></script>
    <script src='assets/js/price-range.js?293082'></script>
    <script src='assets/js/toggle.js?23924389082'></script>
    <script src='assets/js/custom-select.js'></script>
    <script type="text/javascript" src="assets/js/bootbox/bootbox.min.js"></script>
    <script src='assets/js/fly-cart.js?359597'></script>
    <script src='assets/js/multi-countdown.js'></script>
    <script src='assets/js/theia-sticky-sidebar.js'></script>
    <script src='assets/js/functions.js?3348'></script>
   <!--Start of Tawk.to Script-->
<script type="text/javascript">
$(function() {
    "use strict";
    $(function() {
        $(".preloader").fadeOut(); 
    });
});

var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/6161756886aee40a5735b66c/1fhib58la';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();


grecaptcha.ready(function() {
    // do request for recaptcha token
    // response is promise with passed token
        grecaptcha.execute('<?php echo $public_key; ?>', {action:'validate_captcha'})
                  .then(function(token) {
            // add token value to form
            document.getElementById('token').value = token;
        });
    });

</script>
<!--End of Tawk.to Script-->
</body>
</html>