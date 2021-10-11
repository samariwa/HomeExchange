<?php
 session_start();
 require('config.php');
 require('functions.php');
 if (isset($_SESSION['logged_in'])) {
    if ($_SESSION['logged_in'] == TRUE) {
         //valid user has logged-in to the website
 //Check for unauthorized use of user sessions
     $signaturerecreate = $_SESSION['signature'];
 
     //Extract original salt from authorized signature
         $saltrecreate = substr($signaturerecreate, 0, $length_salt);
     
     //Extract original hash from authorized signature
         $originalhash = substr($signaturerecreate, $length_salt, 40);
     
     //Re-create the hash based on the user IP and user agent
     //then check if it is authorized or not
         $hashrecreate = sha1($saltrecreate . $iptocheck . $useragent);
         if ($hashrecreate == $originalhash) {
     
     //Signature submitted by the user does not matched with the
     //authorized signature
     //This is unauthorized access
     //Block it
        header("Location: $dashboard_url");
        exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $organization ?> - Explore the world!</title>
    <link rel="shortcut icon" type="image/png" sizes="196x196" href="assets/images/home_swap_logo.png" />
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/swiper.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/slick.css">
    <link rel="stylesheet" type="text/css" href="assets/css/slick-theme.css">
    <link rel="stylesheet" href="assets/css/custom-select.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://www.google.com/recaptcha/api.js?render=<?php echo $public_key; ?>"></script>
</head>
<style type="text/css">
      .error-page {
  padding-top: calc(60px + 5.20vw);
  padding-bottom: calc(60px + 5.20vw);
}
.error-page h1 {
  font-size: calc(100px + 5.20vw);
  color: #59b828;
  line-height: calc(90px + 5.20vw);
}
.error-page h3 {
  font-size: calc(22px + 0.52vw);
  color: #222533;
}
.error-page p {
  font-size: calc(15px + 0.20vw);
  color: #222533;
  margin-bottom: 30px;
}
.error-page .backhome {
  font-size: 14px;
  width: 180px;
  height: 48px;
  line-height: 48px;
  font-size: 16px;
  font-weight: 600;
  background-color: #59b828;
  color: white;
  display: inline-block;
  border-radius: 4px;
  text-align: center;
  transition: all 0.3s ease;
}
@media only screen and (min-width: 1200px) {
  .error-page .backhome {
    font-size: 16px;
    width: 240px;
    height: 60px;
    line-height: 60px;
  }
}
.error-page .backhome:hover {
  background-color: #222533;
}
    </style>
<body id="top-page">
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label"><?php echo $organization ?></p>
        </div>
    </div>
    <a class="position-absolute" href="javascript:void(0)" onclick="cartopen()">
    <!-- you can add class 'sitebar-drawar' in the div below-->
        <div id="sitebar-drawar" >
           <!-- <div class="cart-count d-flex align-items-center">
                <i class="fas fa-shopping-basket"></i>
                <span>3 Items</span>
            </div>
            <div class="total-price">Ksh 3415.00</div>-->
        </div> 
    </a> 
     <div class="modal fade" id="useradmin1" tabindex="-1" aria-labelledby="useradmin1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="header-top-action-dropdown">
                        <ul>
                        <?php
                             if (isset($_SESSION['logged_in'])) {
                                if ($_SESSION['logged_in'] == TRUE) {
                            ?> 
                             <li><a href="<?php echo $logout_url.'?page_url='.$home_link; ?>"><i class="fas fa-sign-out-alt mr-2"></i> Sign Out</a></li>
                             <li><a href="profile.php#dashboard-nav"><i class="fas fa-user mr-2"></i> Profile</a></li>
                            <?php
                                }
                                else{
                                ?>
                              <li class="signin-option"><a href="<?php echo  $login_url.'?page_url='.$dashboard_link; ?>"><i class="fas fa-key mr-2"></i>Sign In</a></li>
                                <?php
                                }
                            }
                            else{
                                ?>
                                <li class="signin-option"><a href="<?php echo  $login_url.'?page_url='.$dashboard_link; ?>"><i class="fas fa-key mr-2"></i>Sign In</a></li>
                                <?php
                            }
                            ?>
                            <li><a
                            <?php if (isset($_SESSION['logged_in'])) {
                                 if ($_SESSION['logged_in'] == TRUE) {
                                ?>    
                                href="wishlist.php#dashboard-nav"
                                <?php
                                    }
                                else{
                                ?>
                                href="auth/login.php?page_url=<?php echo $protocol.$_SERVER['HTTP_HOST'].'/SymphaFresh/wishlist.php#dashboard-nav' ?>"
                                <?php    
                                }   
                            } 
                            else{
                            ?>
                                href="auth/login.php?page_url=<?php echo $protocol.$_SERVER['HTTP_HOST'].'/SymphaFresh/wishlist.php#dashboard-nav' ?>"
                            <?php
                            }
                                ?>
                            ><i class="fas fa-heart mr-2"></i> Wishlist</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div> 

     
     <div class="modal fade" id="siteinfo1" tabindex="-1" aria-labelledby="siteinfo1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="header-top-action-dropdown">
                        <ul>
                            <li class="site-phone"><a href="tel:<?php echo $contact_number; ?>"><i class="fas fa-phone"></i> <?php echo $contact_number; ?></a></li>
                            <li class="site-help"><a href="#"><i class="fas fa-question-circle"></i> Help & More</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
     
     <div class="modal fade" id="search-select-id" tabindex="-1" aria-labelledby="search-select-id" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="select-search-option">

                        <form action="search" method="POST" class="search-form">
                            <input type="text" name="search" id="Product_Search" placeholder="Where are you visiting?">
                            <button type="submit" class="submit-btn" name="searchSubmit"><i class="fas fa-search"></i></button>
                        </form>
                        <div class="col-12" style="position: relative;z-index: 4;">
                            <div class="list-group" id="Show_List" >
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div> 


     
     <div class="modal fade" id="menu-id" tabindex="-1" aria-labelledby="menu-id" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <ul class="menu d-xl-flex flex-wrap pl-0 list-unstyled">
                        <li class="item-has-children"><a data-toggle="collapse" href="#mainmenuid2" role="button" aria-expanded="false" aria-controls="mainmenuid2"><span>Help</span> <i class="fas fa-angle-down"></i></a>
                         <ul class="submenu collapse" id="mainmenuid2">
                                    <li><a href="about.php#who_we_are">How it works</a></li>
                                    <li><a href="about.php#mission&vision">Contact Us</a></li>
                                    <li><a href="faq.php">FAQs</a></li>
                        </ul>            
                    </ul>
                </div>
            </div>
        </div>
    </div> 



    <!-- header section start -->
    <header class="header">
    <?php
        include('index_nav.php');
     ?>

    </header>
    <!-- header section end -->


    <div class="page-layout">   
        <div class="main-content-area">
             <!-- banner-section start -->
             <section class="slider-banner" style="animation: 20s slider infinite">
                <div class="banner-slider-container" >
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="banner-content-area" >
                                <div class="slider-image slider-image2" style="background-image:url('assets/images/banner/banner-bg1.jpeg');background-repeat: no-repeat;background-size: 130%;"></div>
                                <div class="container">
                                    <div class="banner-content text-center text-lg-left">
                                        <h6 style="color: rgb(77, 72, 72);">Lorem Ipsum</h6>
                                        <h3 style="color: black;">Get your next magical experience<br>anywhere, anytime, at a low cost.</h3>
                                        <a href="auth/registration.php" class="banner-btn">Sign up for free</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="banner-content-area" >
                                <div class="slider-image slider-image1" style="background-image:url('assets/images/banner/bog10.jpeg');background-size: 160%;"></div>
                                <div class="container">
                                    <div class="banner-content text-center">
                                        <h6 style="color: rgb(77, 72, 72);">Lorem Ipsum</h6>
                                        <h3 style="color: black;">Get your next magical experience<br>anywhere, anytime, at a low cost.</h3>
                                        <a href="auth/registration.php" class="banner-btn">Sign up for free</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="banner-content-area">
                                <div class="slider-image slider-image3" style="background-image:url('assets/images/banner/bog4.jpeg');background-size: 130%;"></div>
                                <div class="container">
                                    <div class="banner-content text-center text-lg-left">
                                        <h6 style="color: rgb(77, 72, 72);">Lorem Ipsum</h6>
                                        <h3 style="color: black;">Get your next magical experience<br>anywhere, anytime, at a low cost.</h3>
                                        <a href="auth/registration.php" class="banner-btn">Sign up for free</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </section>
            <!-- banner-section end -->

            <section class="catagory-section homepage-stats">
                <div class="container col-md-12 p-lg-0 row">
                   <div class="col-md-4 text-center">
                        <i class="fas fa-home fa-3x" style="color: #BDBBBB;"></i>
                        <h6>2,694 Homes</h6>
                   </div>
                   <div class="col-md-4 text-center">
                       <i class="fas fa-exchange-alt fa-3x" style="color: #BDBBBB;"></i>
                        <h6>1,074 Swaps</h6>
                   </div>
                   <div class="col-md-4 text-center">
                        <i class="fa fa-user-friends fa-3x" style="color: #BDBBBB;"></i>
                        <h6>3,000 Customers</h6>
                   </div>
                </div>
            </section>

             <!-- category section start -->
            <section class="catagory-section">
                <div class="container p-lg-0">
                    <div class="section-heading">
                        <h4 class="heading-title"><span class="heading-circle"></span> How it works</h4>
                    </div>

                    <div class="section-wrapper">
                       <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. consequuntur quibusdam enim expedita sed nesciunt incidunt accusamus adipisci officia libero laboriosam! Proin gravida nibh vel velit auctor aliquet. nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vultate cursus a sit amet mauris. Duis sed odio sit amet nibh vultate cursus a sit amet mauris.</p>
                    </div>
                </div>
            </section>
            <!-- category section end -->

            <!-- info-box-section start -->
            <section class="info-box-section">
                <div class="container">
                    <div class="info-box-container">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="info-box-item d-sm-flex text-center text-sm-left">
                                    <div class="info-icon">
                                       <i class="fas fa-piggy-bank fa-2x"></i>
                                    </div>
                                    <div class="info-content">
                                        <h6>Cost Effective</h6>
                                        <p>Lorem ipsum dolor sit amet, conse ctetur adipisicing elit, sed do.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div class="info-box-item d-sm-flex text-center text-sm-left">
                                    <div class="info-icon">
                                     <i class="fas fa-crosshairs fa-2x"></i>
                                    </div>
                                    <div class="info-content">
                                        <h6>Centered on you</h6>
                                        <p>Lorem ipsum dolor sit amet, conse ctetur adipisicing elit, sed do.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div class="info-box-item d-sm-flex text-center text-sm-left">
                                    <div class="info-icon">
                                     <i class="fas fa-headset fa-2x"></i>
                                    </div>
                                    <div class="info-content">
                                        <h6>24/7 Support</h6>
                                        <p>Lorem ipsum dolor sit amet, conse ctetur adipisicing elit, sed do.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- info-box-section end -->




            <!-- category section start -->
            <section class="catagory-section">
                <div class="container p-lg-0">
                    <div class="section-heading">
                        <h4 class="heading-title"><span class="heading-circle green"></span> Exchange Points System</h4>
                    </div>

                    <div class="section-wrapper">
                       <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. consequuntur quibusdam enim expedita sed nesciunt incidunt accusamus adipisci officia libero laboriosam! Proin gravida nibh vel velit auctor aliquet. nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vultate cursus a sit amet mauris. Duis sed odio sit amet nibh vultate cursus a sit amet mauris.</p>
                    </div>
                </div>
            </section>
            <!-- category section end -->



            <!-- testimonial-section start -->
            <section class="testimonial-section">
                <div class="container">
                    <div class="section-heading">
                        <h4 class="heading-title"><span class="heading-circle"></span> Testimonial</h4>
                    </div>

                    <div class="section-wrapper">
                        <div class="testimonial-container">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="testimonial-body">
                                        <div class="testi-author-pic"><img src="assets/images/testimonial/author.jpg" alt="author"></div>
                                        <p class="desc">What a load of rubbish bits and bobs pear shaped owt to do with me good tinkety tonk old fruit, car boot my good sir buggered plastered cheeky David, haggle young delinquent say so I said bite your arm off</p>
                                        <div class="author-info">
                                            <h6 class="name">Jhon Doe</h6>
                                            <div class="rating">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Add Arrows -->
                        <div class="testimonial-slider-btn-group">
                            <div class="testimonial-slider-prev">
                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512.008 512.008" style="enable-background:new 0 0 512.008 512.008;" xml:space="preserve"><path style="fill:#2196F3;" d="M501.342,245.185H36.424L210.227,71.404c4.093-4.237,3.975-10.99-0.262-15.083 c-4.134-3.992-10.687-3.992-14.82,0l-192,192c-4.171,4.16-4.179,10.914-0.019,15.085c0.006,0.006,0.013,0.013,0.019,0.019l192,192 c4.093,4.237,10.845,4.354,15.083,0.262c4.237-4.093,4.354-10.845,0.262-15.083c-0.086-0.089-0.173-0.176-0.262-0.262 L36.424,266.519h464.917c5.891,0,10.667-4.776,10.667-10.667S507.233,245.185,501.342,245.185z"/><path d="M202.675,458.519c-2.831,0.005-5.548-1.115-7.552-3.115l-192-192c-4.164-4.165-4.164-10.917,0-15.083l192-192 c4.237-4.093,10.99-3.975,15.083,0.262c3.992,4.134,3.992,10.687,0,14.82L25.758,255.852L210.206,440.3 c4.171,4.16,4.179,10.914,0.019,15.085C208.224,457.39,205.508,458.518,202.675,458.519z"/><path d="M501.342,266.519H10.675c-5.891,0-10.667-4.776-10.667-10.667s4.776-10.667,10.667-10.667h490.667 c5.891,0,10.667,4.776,10.667,10.667S507.233,266.519,501.342,266.519z"/></svg>
                            </div>
                            <div class="testimonial-slider-next">
                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><path style="fill:#2196F3;" d="M511.189,259.954c1.649-3.989,0.731-8.579-2.325-11.627l-192-192 c-4.237-4.093-10.99-3.975-15.083,0.262c-3.992,4.134-3.992,10.687,0,14.82l173.803,173.803H10.667 C4.776,245.213,0,249.989,0,255.88c0,5.891,4.776,10.667,10.667,10.667h464.917L301.803,440.328 c-4.237,4.093-4.355,10.845-0.262,15.083c4.093,4.237,10.845,4.354,15.083,0.262c0.089-0.086,0.176-0.173,0.262-0.262l192-192 C509.872,262.42,510.655,261.246,511.189,259.954z"/><path d="M309.333,458.546c-5.891,0.011-10.675-4.757-10.686-10.648c-0.005-2.84,1.123-5.565,3.134-7.571L486.251,255.88 L301.781,71.432c-4.093-4.237-3.975-10.99,0.262-15.083c4.134-3.992,10.687-3.992,14.82,0l192,192 c4.164,4.165,4.164,10.917,0,15.083l-192,192C314.865,457.426,312.157,458.546,309.333,458.546z"/><path d="M501.333,266.546H10.667C4.776,266.546,0,261.771,0,255.88c0-5.891,4.776-10.667,10.667-10.667h490.667 c5.891,0,10.667,4.776,10.667,10.667C512,261.771,507.224,266.546,501.333,266.546z"/></svg>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- testimonial-section end -->
<?php
include('footer.php');
?>


