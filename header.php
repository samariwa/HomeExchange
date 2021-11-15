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
                            <button type="submit" class="submit-btn" id="search-Location-Submit" name="search-Location-Submit"><i class="fas fa-search"></i></button>
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

    <!-- sidebar-cart -->
    <div id="sitebar-cart" class="sitebar-cart">
        <div class="sc-head d-flex justify-content-between align-items-center">
            <div class="cart-count"><i class="fa fa-bell"></i>
                   <?php
                        $notifications_count=0;
                        $request = new HomeExchangeRequest();
                        $notification_checker = mysqli_query($connection,$request->GetPendingExchangeRequests($customer_id));
                        $response_checker = mysqli_query($connection,$request->GetPendingExchangeResponses($customer_id));
                        $notifications_count = mysqli_num_rows($notification_checker) + mysqli_num_rows($response_checker);
                    ?>
                   <span id="notifications_number"><?php echo $notifications_count; ?> Notification<?php if($notifications_count > 1 || $notifications_count == 0 ){ ?>s<?php } ?></span>
                </div>
                <span onclick="cartclose()" class="close-icon"><i class="fas fa-times"></i></span>
        </div>
    <div class="cart-product-container">
        <?php
              if($notifications_count > 0){
                  if(mysqli_num_rows($notification_checker) > 0)
                  {
                  ?>
                <p style="text-align:center;margin-top:10px;"><b>You have <?php echo mysqli_num_rows($notification_checker); ?> new home exchange request<?php if(mysqli_num_rows($notification_checker) > 1){ ?>s<?php } ?>.</b></p>
                <?php
                  }
                  elseif (mysqli_num_rows($response_checker) > 0){
                ?>
                 <p style="text-align:center;margin-top:10px;"><b>You have <?php echo mysqli_num_rows($response_checker); ?> new exchange request response<?php if(mysqli_num_rows($response_checker) > 1 ){ ?>s<?php } ?>.</b></p>
                <?php
                  }
              foreach($notification_checker as $row)
             {     
                $requester_details = mysqli_query($connection,$request->GetPendingRequesterDetails($row["requester_home_id"]));
                $row2 = mysqli_fetch_array($requester_details);
                 ?>
                    <div class="cart-product-item">
                <div class="row align-items-center">
                    <div class="col-6 p-0">
                        <div class="thumb">
                            <a href="#"><img src="assets/images/homes/<?php echo $row2["image"]; ?>" alt="home"></a>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="product-content">
                            <a href="#" class="product-title"><?php echo $row2["name"]; ?></a>
                            <div class="product-cart-info">
                            <?php echo $row2["county"].', '.$row2["subcounty"]; ?></span>
                            <br>
                             Tier <?php echo $row2["tier"]; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <a href="home-dashboard.php?id=<?php echo $row['requester_home_id'] ?>" class="btn btn-outline-danger mt-n3" style="border-color: #FD5555">
                    <span ><i class="fas fa-eye"></i> View Home</span>
                </a>
                <div class="align-items-center mt-1">
                    <b>Requester Details:</b>
                    <br>
                    <span style="color:#FD5555">Name:</span> <i><?php echo $row2["first_name"].' '.$row2["last_name"]; ?></i>
                    <br>
                    <span style="color:#FD5555">Contact:</span> <i><?php echo $row2["phone_number"]; ?></i>
                    <br>
                    <b>Request Details:</b>
                    <br>
                    <input type="hidden" name="availability-id" id="availability-id" value="<?php echo $row2["availability_id"]; ?>">
                    <input type="hidden" name="requester-tier" id="requester-tier" value="<?php echo $row2["tier"]; ?>">
                    <input type="hidden" name="my-tier" id="my-tier" value="<?php echo $row["tier"]; ?>">
                    <input type="hidden" name="requester-id" id="requester-id" value="<?php echo $row2["requester_id"]; ?>">
                    <input type="hidden" name="my-id" id="my-id" value="<?php echo $row["my_id"]; ?>">
                    <span style="color:#FD5555">Requested Home:</span> <i><?php echo $row["name"]; ?></i>
                     <br>
                     <span style="color:#FD5555">Start Date:</span> <i><?php echo date('d F Y', strtotime($row["exchange_start_date"])); ?></i>
                     <br>
                     <span style="color:#FD5555">End Date:</span> <i><?php echo date('d F Y', strtotime($row["exchange_end_date"])); ?></i>
                     <br>
                     <span style="color:#FD5555">No. of people:</span> <i><?php echo $row["number_of_occupants"]; ?></i>
                    <br>
                    <span style="color:#FD5555">Extra Details:</span> <i><?php echo $row["exchange_extra_details"]; ?></i>
                    <?php
                     if(ExchangePoints($row2["tier"], $unit_of_exchange, $row["tier"]) > 0)
                      {
                          ?>
                         <p>If you accept this request, <?php echo ExchangePoints($row2["tier"], $unit_of_exchange, $row["tier"]); ?> exchange points will be debited to your account</p>
                          <?php
                      }
                      elseif(ExchangePoints($row2["tier"], $unit_of_exchange, $row["tier"]) < 0)
                      {
                        ?>
                          <p>If you accept this request, <?php echo ExchangePoints($row2["tier"], $unit_of_exchange, $row["tier"]); ?> exchange points will be credited from your account</p>
                        <?php
                      }
                    ?>
                </div>
                <div class="row align-items-center mt-1">
                    <div class="col-6">
                    <button class="btn btn-outline-success accept-request rounded-pill" id="<?php echo $row["request_id"]; ?>">Accept</button>
                    </div>
                    <div class="col-6">
                    <button class="btn btn-outline-danger decline-request rounded-pill" id="<?php echo $row["request_id"]; ?>">Decline</button>
                    </div>
                </div>
                <br>
            </div>   
        <?php 
             }
             foreach($response_checker as $row)
             {
                 $responder_details = mysqli_query($connection,$request->GetPendingResponderDetails($row['availability_id'], $row['request_id']));
                $row2 = mysqli_fetch_array($responder_details);
                 ?>
                    <div class="cart-product-item">
                <div class="row align-items-center">
                    <div class="col-6 p-0">
                        <div class="thumb">
                            <a href="#"><img src="assets/images/homes/<?php echo $row2["image"]; ?>" alt="home"></a>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="product-content">
                            <a href="#" class="product-title"><?php echo $row2["name"]; ?></a>
                            <div class="product-cart-info">
                            <?php echo $row2["county"].', '.$row2["subcounty"]; ?></span>
                            <br>
                             Tier <?php echo $row2["tier"]; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="mt-2">Exchange with <i><b><?php echo $row["name"]; ?></b></i></p>
                <div class="align-items-center mt-n3">
                    <b>Owner Details:</b>
                    <br>
                    <span style="color:#FD5555">Name:</span> <i><?php echo $row2["first_name"].' '.$row2["last_name"]; ?></i>
                    <br>
                    <span style="color:#FD5555">Contact:</span> <i><?php echo $row2["phone_number"]; ?></i>
                    <br>
                    <b>Request Status:</b>
                    <br>
                    <input type="hidden" name="availability-id" id="availability-id" value="<?php echo $row2["availability_id"]; ?>"> 
                    <input type="hidden" name="requester-id" id="requester-id" value="<?php echo $row["requester_id"]; ?>">    
                </div>
                <div class="row align-items-center mt-1">
                    <div class="col-6">
                    <?php
                     if($row2['request_response'] == 1)
                      {
                          ?>
                         <span class="badge badge-pill badge-success request-status-badge ml-4 mt-1">Accepted</span>
                          <?php
                      }
                      elseif($row2['request_response'] == 2)
                      {
                        ?>
                          <span class="badge badge-pill badge-danger request-status-badge ml-4 mt-1">Declined</span>
                        <?php
                      }
                    ?>
                    </div>
                    <div class="col-6">
                    <button class="btn btn-outline-danger clear-request rounded-pill ml-4" id="<?php echo $row["request_id"]; ?>">Clear</button>
                    </div>
                </div>
                <br>
            </div>  
            <?php
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
        <div class="cart-total">
           <?php
              if($notifications_count == 0){
            ?>
            
           <p style="text-align: center"><b>You will get notified of any home exchange requests and/or responses in this section.</b></p>
            <?php
              }
              else{
                if(mysqli_num_rows($notification_checker) > 0)
                {
                ?>
              <a href="#" class="decline-all" style=" background-color: #df4759;color: white;display: block;text-align: center;padding: 10px 30px;border-radius: 5px;margin-top: 10px;">Decline All</a>
              <?php
                }
                elseif (mysqli_num_rows($response_checker) > 0){
              ?>
               <a href="#" class="clear-all mt-1" style=" background-color: #df4759;color: white;display: block;text-align: center;padding: 10px 30px;border-radius: 5px;margin-top: 10px;">Clear All</a>
              <?php
                }
                  ?>
                <?php
              }
           ?>
           </div>
        </div>
    </div>
    <!--end of side cart-->

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