<?php
require 'config.php';
$refresh_page = '';
$homes_page = 'homes-list.php';
$dashboard_page = 'HomeExchange/dashboard.php';
$home_dashboard_page = 'home-dashboard.php';
$wishlist_page = 'wishlist.php'; 
$message = '';
if (strpos($redirect_link, $dashboard_page) == TRUE) {
    $refresh_page = $protocol.$_SERVER['HTTP_HOST'].'/HomeExchange/dashboard.php';
}
elseif (strpos($redirect_link, $homes_page) == TRUE){
    $refresh_page = $protocol.$_SERVER['HTTP_HOST'].'/HomeExchange/homes-list.php';
} 
elseif (strpos($redirect_link, $home_dashboard_page) == TRUE){
    $refresh_page = $protocol.$_SERVER['HTTP_HOST'].'/HomeExchange/home-dashboard.php?id='.$_GET['id'].'&';
} 
elseif (strpos($redirect_link, $wishlist_page) == TRUE){
    $refresh_page = $protocol.$_SERVER['HTTP_HOST'].'/HomeExchange/wishlist.php';
} 
$customer = mysqli_query($connection,"SELECT id FROM users WHERE email_address='".$_SESSION['email']."'");
$customer_row = mysqli_fetch_array($customer);
if(isset($_GET['action']))
{
    if($_GET['action'] == 'add_wishlist')
    {
        $product = mysqli_query($connection,"SELECT id from homes WHERE id = '".$_GET['id']."';")or die($connection->error);
        $row = mysqli_fetch_array($product);
                $wishlist_duplicate = mysqli_query($connection,"SELECT * FROM `wishlist` WHERE customer_id ='".$customer_row['id']."' AND home_id = '".$_GET['id']."'");
                $wishlist_duplicate_result = mysqli_fetch_array($wishlist_duplicate);
                if ( $wishlist_duplicate_result == FALSE) {
                    mysqli_query($connection,"INSERT INTO `wishlist` (`customer_id`,`home_id`) VALUES ('".$customer_row['id']."','".$_GET['id']."')");
                    if (strpos($redirect_link, $home_dashboard_page) == TRUE){
                        header('location:'.$refresh_page.'wishlist-success=1');
                    } 
                    else{
                        header('location:'.$refresh_page.'?wishlist-success=1');
                    }
                } 
                else{
                    mysqli_query($connection,"DELETE FROM `wishlist` WHERE `customer_id` = '".$customer_row['id']."' AND `home_id` = '".$_GET['id']."'");
                    if (strpos($redirect_link, $home_dashboard_page) == TRUE){
                        header('location:'.$refresh_page.'wishlist-remove=1');
                    }
                    else{
                        header('location:'.$refresh_page.'?wishlist-remove=1');
                    }
                }       
    }

    if($_GET['action'] == 'wishlist_delete')
    { 
                mysqli_query($connection,"DELETE FROM `wishlist` WHERE customer_id ='".$customer_row['id']."' AND home_id ='".$_GET['id']."'");
                header('location:'.$refresh_page.'?remove=1');
    }
    if($_GET['action'] == 'wishlist-clear')
    {
                mysqli_query($connection,"DELETE FROM `wishlist` WHERE customer_id ='".$customer_row['id']."'");
                header('location:'.$refresh_page.'?wishlist-clear=1');
}
}
if(isset($_GET["wishlist-success"])){
    $message = '
    <div class="alert alert-dismissible" style="background-color: #FD5555; color:white;">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        Home Added into Wishlist
    </div>    
    ';
}
if(isset($_GET["wishlist-remove"])){
    $message = '
    <div class="alert alert-dismissible" style="background-color: #FD5555; color:white;">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        Home Removed from Wishlist
    </div>    
    ';
}
if(isset($_GET["wishlist-clear"])){
    $message = '
    <div class="alert alert-dismissible" style="background-color: #FD5555; color:white;">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
       Your Wishlist was Successfully Cleared
    </div>    
    ';
}
?>