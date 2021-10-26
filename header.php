<?php
 session_start();
 require('config.php');
 require('functions.php');
 require('queries.php');
 include('wishlist_process.php');
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
     if (!($hashrecreate == $originalhash)) {
 
 //Signature submitted by the user does not matched with the
 //authorized signature
 //This is unauthorized access
 //Block it
         header('Location: '.$logout_url.'?page_url='.$home_link);
         exit;
     }
     $logged_in_user = $_SESSION['user'];
     $logged_in_email = $_SESSION['email'];
        $result1 = mysqli_query($connection,"SELECT `user_status` FROM `users` WHERE `email_address`='$logged_in_email'");
         $row = mysqli_fetch_array($result1);
         $active = $row['user_status'];

        $customer = mysqli_query($connection,"SELECT id, last_name  FROM `users`  WHERE `email_address`='$logged_in_email'");
        $customer_row = mysqli_fetch_array($customer);
        $customer_id = $customer_row['id']; 
        $last_name = $customer_row['last_name'];  
        //transfer wishlist cookie to database
        if(isset($_COOKIE["homes_wishlist"]))
        {
            $wishlist_data = stripslashes($_COOKIE['homes_wishlist']);
            $wishlist_data = json_decode($wishlist_data, true);
            foreach($wishlist_data as $keys => $values)
            {
                $home_id = $values["home_id"];
                $wishlist_duplicate = mysqli_query($connection,"SELECT * FROM `wishlist` WHERE customer_id ='$customer_id' AND home_id = '$home_id'");
                $wishlist_duplicate_result = mysqli_fetch_array($wishlist_duplicate);
                if ( $wishlist_duplicate_result == FALSE) {
                    mysqli_query($connection,"INSERT INTO `wishlist` (`customer_id`,`home_id`) VALUES ('$customer_id','$home_id')");
                }
            }
            setcookie('homes_wishlist', '', $favourite_expiry);
        }
        $exchangePoints = 0;
        $customer = new Customer();
        $exchangePointsResult = mysqli_query($connection,$customer->GetExchangePoints($customer_id))or die($connection->error);
        if(mysqli_num_rows($exchangePointsResult) > 0)
        {
            $row = mysqli_fetch_array($exchangePointsResult);
            $exchangePoints = $row['exchange_points'];
        }
 //Session Lifetime control for inactivity
     if ((isset($_SESSION['LAST_ACTIVITY'])) && (time() - $_SESSION['LAST_ACTIVITY'] > $sessiontimeout) || (isset($_SESSION['LAST_ACTIVITY'])) && ($active == 2)) {
 //redirect the user back to login page for re-authentication
          header('Location: '.$logout_url.'?page_url='.$home_link );
         exit;
     }
     $_SESSION['LAST_ACTIVITY'] = time();
 }
 else{
    header('Location: '.$login_url.'?page_url='.$dashboard_link );
    exit;
 }
}
else{
    header('Location: '.$login_url.'?page_url='.$dashboard_link );
    exit;
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
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
                                href="auth/login.php?page_url=<?php echo $protocol.$_SERVER['HTTP_HOST'].'/HomeExchange/wishlist.php#dashboard-nav' ?>"
                                <?php    
                                }   
                            } 
                            else{
                            ?>
                                href="auth/login.php?page_url=<?php echo $protocol.$_SERVER['HTTP_HOST'].'/HomeExchange/wishlist.php#dashboard-nav' ?>"
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
                            <input type="text" name="search" id="Location_Search" placeholder="Where are you visiting?">
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



    <?php
      //  if (isset($_SESSION['logged_in'])) {
       // if ($_SESSION['logged_in'] == TRUE) {
    ?>
    <!-- sidebar-cart -->
    <div id="sitebar-cart" class="sitebar-cart">
        <div class="sc-head d-flex justify-content-between align-items-center">
            <div class="cart-count"><i class="fa fa-bell"></i>
                   <?php
                        $cart_count=0;
                        //$cart_checker = mysqli_query($connection,"SELECT s.id AS id,s.Name as Name,cart.quantity as cartQty,image,i_u.Name as unit_name,s.Discount as Discount,sf.Selling_price as Price,c.Category_Name as Category_Name,s.Restock_Level as Restock_Level,s.Quantity as Quantity FROM `cart` inner join stock s on cart.product_id = s.id INNER JOIN stock_flow sf ON s.id = sf.Stock_id JOIN inventory_units i_u ON s.Unit_id = i_u.id JOIN category c ON s.Category_id=c.id INNER JOIN (SELECT s.id AS max_id, MAX(sf.Created_at) AS max_created_at FROM stock s INNER JOIN stock_flow sf ON s.id = sf.Stock_id GROUP BY s.id) subQuery ON subQuery.max_id = s.id AND subQuery.max_created_at = sf.Created_at WHERE cart.customer_id='$customer_id';");
                        //$cart_count = mysqli_num_rows($cart_checker);
                        
                    ?>
                   <span><?php echo $cart_count; ?> Notifications</span>
                </div>
                <span onclick="cartclose()" class="close-icon"><i class="fas fa-times"></i></span>
        </div>
    <div class="cart-product-container">
        <?php
        $total = 0;
              //$notifications_checker = mysqli_query($connection,"SELECT s.id AS id,s.Name as Name,cart.quantity as cartQty,image,i_u.Name as unit_name,s.Discount as Discount,sf.Selling_price as Price,c.Category_Name as Category_Name,s.Restock_Level as Restock_Level,s.Quantity as Quantity FROM `cart` inner join stock s on cart.product_id = s.id INNER JOIN stock_flow sf ON s.id = sf.Stock_id JOIN inventory_units i_u ON s.Unit_id = i_u.id JOIN category c ON s.Category_id=c.id INNER JOIN (SELECT s.id AS max_id, MAX(sf.Created_at) AS max_created_at FROM stock s INNER JOIN stock_flow sf ON s.id = sf.Stock_id GROUP BY s.id) subQuery ON subQuery.max_id = s.id AND subQuery.max_created_at = sf.Created_at WHERE cart.customer_id='$customer_id';");
             // $notifications_count = mysqli_num_rows($cart_checker);
              $notifications_count = 0;
              if($notifications_count > 0){
              foreach($notification_checker as $row)
             {
                 ?>
                    <div class="cart-product-item">
                <div class="row align-items-center">
                    <div class="col-6 p-0">
                        <div class="thumb">
                            <a href="#"><img src="assets/images/products/<?php echo $row["image"]; ?>" alt="products"></a>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="product-content">
                            <a href="#" class="product-title"><?php echo $row["Name"]; ?></a>
                            <div class="product-cart-info">
                            <?php if($row['Discount'] > 0){ ?> <del>Ksh<?php echo number_format($row["Price"],2); ?> /unit</del> <br><?php }?>
                            Ksh<?php echo number_format($row["Price"] - $row["Discount"],2); ?> /unit
                            <br>
                            x<span id="cart_unit_qty<?php echo $row['id']; ?>"><?php echo $row["cartQty"]; ?></span> <?php echo $row["unit_name"]; ?>
                            </div>
                        </div>
                    </div>
                </div>
  
                <div class="row align-items-center mt-1">
                    <div class="col-6">
                        <div class="price-increase-decrese-group d-flex">
                        
                            <span class="decrease-btn">
                                <button type="button"
                                    class="btn quantity-left-minus cart_decrease" id="<?php echo $row['id']; ?>" data-type="minus" data-field="">-
                                </button> 
                            </span>
                            <input type="text" name="quantity" disabled class="form-controls input-number" id="cart_qty<?php echo $row["id"]; ?>" value="<?php echo $row["cartQty"]; ?>">
                            
                            <span class="increase">
                                <button type="button"
                                    class="btn quantity-right-plus cart_increase" id="<?php echo $row['id']; ?>" data-type="plus" data-field="" >+
                                </button>
                            </span>
                          
                        </div>
                    </div>
                    <div class="col-6">
                        <div >
                            <span class="ml-2">Ksh<span id="cart_subtotal<?php echo $row['id']; ?>"><?php echo number_format($row["cartQty"] * ($row["Price"] - $row["Discount"]),2); ?></span></span>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center mt-1">
                <div class="col-6">

                </div>
                  <div class="col-6">
                    <a href="<?php echo $protocol.$_SERVER['HTTP_HOST'].'/SymphaFresh/product-list.php?action=delete&id='.$row["id"] ?>" class="ml-5 text-danger"><i class="fas fa-times"></i> Remove</a>
                  </div>
                </div>
            </div>   
        <?php 
          $total = $total + ($row["cartQty"] * ($row["Price"] - $row["Discount"])); 
             }
            }
            else{
                echo'
            <h4 style="text-align:center;" class="mt-5">No Notification</h4>
            ';
            }
        
        ?>
        <br><br><br>
        </div> 
        <div class="cart-footer">
           <!-- <div class="product-other-charge">
                <p class="d-flex justify-content-between">
                    <span>Delivery charge</span> 
                    <span>Ksh8.00</span> 
                </p>
                  <a href="#">Do you have a voucher?</a> 
            </div> -->
    
            <div class="cart-total">
                <a <?php if($cart_count == 0){?> href="#" <?php } else{ ?>href="<?php echo $protocol.$_SERVER['HTTP_HOST'].'/SymphaFresh/product-list.php?action=clear' ?>" <?php } ?> class="clear-cart" style=" background-color: #df4759;color: white;display: block;text-align: center;padding: 10px 30px;border-radius: 5px;margin-top: 10px;">Clear</a>
            </div>
        </div>
    </div>
    <!--end of side cart-->
    <?php
      //  }
    //}
    ?>

    <!-- header section start -->
    <header class="header">
    <?php
        if (isset($_SESSION['logged_in'])) {
        if ($_SESSION['logged_in'] == TRUE) {
            include('dashboard_nav.php');
        }
        else{
            include('index_nav.php');
        }
        }
        else
        {
            include('index_nav.php');
        }
        ?>

    </header>
    <!-- header section end -->


    <div class="page-layout">   
        <div class="main-content-area">