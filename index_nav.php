<?php
require('config.php');
?>
<div class="header-top">
<div class="mobile-header d-flex justify-content-between align-items-center d-xl-none">
     <div class="d-flex align-items-center">
        <a href="index.php" class="logo"><img src="assets/images/LOGO.png" width="70px" alt="logo"></a>
    </div> 


    <!-- search select -->
    <div class="text-center mobile-search">
        <button type="button" data-toggle="modal" data-target="#search-select-id"><i class="fas fa-search"></i></button>
    </div>

    <!-- menubar -->
    <div>
        <button class="menu-bar" type="button" data-toggle="modal" data-target="#menu-id">
            Home<i class="fas fa-caret-down"></i>
        </button>
    </div>

</div>
<div class="d-none d-xl-flex row align-items-center">
    <div class="col-5 col-md-2">
        <a href="index.php" class="logo"><img src="assets/images/LOGO.png" width="70px"  alt="logo"></a>
    </div>
    <div class="col-5 col-md-9 col-lg-5">
       
        <div class="select-search-option d-none d-md-flex">
            <form action="search" method="POST" class="search-form">
                <input type="text" name="search" id="product_Search" placeholder="Where are you visiting?">
                <button type="submit" class="submit-btn" name="searchSubmit"><i class="fas fa-search"></i></button>
            </form>
        </div>
        <div class="col-7 offset-4" style="position: absolute;z-index: 4;">
            <div class="list-group" id="show_list" >
            </div>
        </div>
    </div>
    <div class="col-2 col-md-1 col-lg-5">
        <ul class="site-action d-none d-lg-flex align-items-center justify-content-between  ml-auto">
            <li class="site-phone"><a href="tel:<?php echo $contact_number; ?>"><i class="fas fa-phone"></i> <?php echo $contact_number; ?></a></li>
            <li class="site-help ml-5"><a data-toggle="collapse" href="#" style="font-size:15px">Register</a></li>
            <?php
                       $redirect_page = '';
                       $neutral_link = FALSE;
                     if (strpos($redirect_link, 'cookie-policy.php') == TRUE) {
                       $neutral_link = TRUE;
                     }
                     elseif (strpos($redirect_link, 'site-map.php') == TRUE){
                       $neutral_link = TRUE;
                     }
                     elseif (strpos($redirect_link, 'faq.php') == TRUE){
                       $neutral_link = TRUE;
                     }
                     elseif (strpos($redirect_link, 'contact.php') == TRUE){
                       $neutral_link = TRUE;
                     }
                     elseif (strpos($redirect_link, 'privacy-policy.php') == TRUE){
                       $neutral_link = TRUE;
                     }
                     elseif (strpos($redirect_link, 'login.php') == TRUE){
                       $neutral_link = TRUE;
                     }
                     if(($redirect_link == '') || ($neutral_link == TRUE))
                    {
                        $redirect_page = $redirect_link;
                    }
                    else
                    {
                        $redirect_page = $dashboard_link;
                    }
                    ?>
            <li class="signin-option ml-n5"><a href="<?php echo  $login_url.'?page_url='.$redirect_page; ?>"><i class="fas fa-user mr-2"></i>Sign In</a></li>
        </ul>
    </div>

</div>
</div>


<hr>
        <div class="header-bottom">
            <div class="row m-0 align-items-center">

                <div class="col-md-12">
                    <div class="menu-area d-none d-xl-flex justify-content-between align-items-center">
                        <ul class="menu d-xl-flex flex-wrap list-unstyled">
                            <li class="item-has-children" ><a href="#"> Learn More<i class="fas fa-angle-down"></i></a>
                            <ul class="submenu">
                                    <li><a href="#">How it works</a></li>
                                    <li><a href="contact.php">Contact Us</a></li>
                            </ul>  
                            <li class="nav-item"><a href="faq.php">FAQs</a></li>
                            </li>      
                        </ul>
                    </div>
                </div>
            </div>
        </div>

