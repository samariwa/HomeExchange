<?php
require('config.php');
?>
<div class="header-top">
<div class="mobile-header d-flex justify-content-between align-items-center d-xl-none">
     <div class="d-flex align-items-center">
        <a href="dashboard.php" class="logo"><img src="assets/images/LOGO.png" width="70px" alt="logo"></a>
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
        <a href="dashboard.php" class="logo"><img src="assets/images/LOGO.png" width="70px"  alt="logo"></a>
    </div>
    <div class="col-5 col-md-9 col-lg-5">
       
        <div class="select-search-option d-none d-md-flex">
            <form action="search" method="POST" class="search-form">
                <input type="text" name="search" id="location_Search" placeholder="Where are you visiting?">
                <button type="submit" class="submit-btn" id= "searchLocationSubmit" name="searchLocationSubmit"><i class="fas fa-search"></i></button>
            </form>
        </div>
        <div class="col-7" style="position: absolute;z-index: 4;">
            <div class="list-group" id="show_list" >
            </div>
        </div>
    </div>
    <div class="col-2 col-md-1 col-lg-5">
        <ul class="site-action d-none d-lg-flex align-items-center justify-content-between  ml-auto">
            <li class="site-phone"><a href="tel:<?php echo $contact_number; ?>"><i class="fas fa-phone"></i> <?php echo $contact_number; ?></a></li>
            <li class="wish-list"><a 
            <?php
            $wishlist_count=0;
            if (isset($_SESSION['logged_in'])) {
                if ($_SESSION['logged_in'] == TRUE) {
                  $wishlist_checker = mysqli_query($connection,"SELECT * FROM `wishlist` WHERE wishlist.customer_id='$customer_id';");
                  $wishlist_count = mysqli_num_rows($wishlist_checker);
                }
                else{
                    if(isset($_COOKIE['homes_wishlist'])){
                        $wishlist_data = stripslashes($_COOKIE['homes_wishlist']);
                        $wishlist_data = json_decode($wishlist_data, true); 
                        foreach($wishlist_data as $cart){
                            $wishlist_count++;
                        }
                    }
                }
            }
            else{
                if(isset($_COOKIE['homes_wishlist'])){
                    $wishlist_data = stripslashes($_COOKIE['homes_wishlist']);
                    $wishlist_data = json_decode($wishlist_data, true); 
                    foreach($wishlist_data as $cart){
                        $wishlist_count++;
                    }
                }
            }
            ?>    
            href="wishlist.php#dashboard-nav"><i class="fas fa-heart"></i> <span class="count"><?php echo $wishlist_count; ?></span></a></li>
            <li class="my-account"><a class="dropdown-toggle" href="#" role="button" id="myaccount" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user mr-1"></i> <?php echo $logged_in_user; ?></a>
                <ul class="submenu dropdown-menu" aria-labelledby="myaccount">
                    <li><a href="profile.php#dashboard-nav">Profile</a></li>
                    <li><a href="my-exchanges.php#dashboard-nav">My Exchanges</a></li>
                    <li><a href="my-homes.php#dashboard-nav">My Homes</a></li>
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
                        $redirect_page = $home_link;
                    }
                    ?>
                    <li><a href="<?php echo $logout_url.'?page_url='.$redirect_page; ?>">Sign Out</a></li>
                </ul>
            </li>

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
                        <li class="item-has-children" ><a href="#"><i class="fas fa-question-circle"></i> Help & More<i class="fas fa-angle-down"></i></a>
                        <ul class="submenu">
                                <li><a href="#">How it works</a></li>
                                <li><a href="contact.php">Contact Us</a></li>
                                <li><a href="faq.php">FAQs</a></li>
                        </ul>  
                        </li>      
                    </ul>
                    <ul class="menu-action d-none d-lg-block">
                    <div class="row" style="align-items:center">
                       <li class="menu mr-5"><a href="#" id="exchange-points-value"><b><?php echo "$exchangePoints"; ?> EPs</b></a></li>
                            <input type="hidden" id="navbar_cart_hidden" value="0" >
                            <li class="cart-option"><a onclick="cartopen()" href="#"><span class="cart-icon" id="notifications_icon"><i class="fa fa-bell"></i><span class="count" ><?php echo $notifications_count; ?></span></span></a>
                    </div>    
                   
                    </ul>
                </div>
            </div>
        </div>
    </div>


