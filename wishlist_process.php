<?php
require 'config.php';
$refresh_page = '';
$products_page = 'homes-list.php';
$wishlist_page = 'wishlist.php'; 
$message = '';
if (strpos($redirect_link, $home_url) == TRUE) {
    $refresh_page = $protocol.$_SERVER['HTTP_HOST'].'/HomeExchange/dashboard.php';
}
elseif (strpos($redirect_link, $products_page) == TRUE){
    $refresh_page = $protocol.$_SERVER['HTTP_HOST'].'/HomeExchange/homes-list.php';
} 
elseif (strpos($redirect_link, $wishlist_page) == TRUE){
    $refresh_page = $protocol.$_SERVER['HTTP_HOST'].'/HomeExchange/wishlist.php';
} 
if(isset($_GET['action']))
{
    if($_GET['action'] == 'add_wishlist')
    {
        $product = mysqli_query($connection,"SELECT id from homes WHERE id = '".$_GET['id']."';")or die($connection->error);
        $row = mysqli_fetch_array($product);
        if (isset($_SESSION['logged_in'])) {
            if ($_SESSION['logged_in'] == TRUE) {
                $customer = mysqli_query($connection,"SELECT id FROM users WHERE email_address='".$_SESSION['email']."'");
                $customer_row = mysqli_fetch_array($customer);
                $wishlist_duplicate = mysqli_query($connection,"SELECT * FROM `wishlist` WHERE customer_id ='".$customer_row['id']."' AND product_id = '".$_GET['id']."'");
                $wishlist_duplicate_result = mysqli_fetch_array($wishlist_duplicate);
                if ( $wishlist_duplicate_result == FALSE) {
                    mysqli_query($connection,"INSERT INTO `wishlist` (`customer_id`,`home_id`) VALUES ('".$customer_row['id']."','".$_GET['id']."')");
                    header('location:'.$refresh_page.'?wishlist-success=1');
                } 
                else{
                    mysqli_query($connection,"DELETE FROM `wishlist` WHERE `customer_id` = '".$customer_row['id']."' AND `home_id` = '".$_GET['id']."'");
                    header('location:'.$refresh_page.'?wishlist-remove=1');
                }
               
            }
            else{
                if(isset($_COOKIE["homes_wishlist"]))
                {
                    $cookie_data = stripslashes($_COOKIE['homes_wishlist']);
                    $wishlist_data = json_decode($cookie_data, true);
                }
                else{
                    $wishlist_data = array();
                }
            $item_id_list = array_column($wishlist_data, 'home_id');
            if(in_array($_GET['id'], $item_id_list))
            {
                foreach($wishlist_data as $keys => $values)
                {
                    if($wishlist_data[$keys]["home_id"] == $_GET['id'] )
                    {
                        unset($wishlist_data[$keys]);
                        $item_data = json_encode($wishlist_data);
                        setcookie('homes_wishlist', $item_data, $favourite_expiry);
                        header('location:'.$refresh_page.'?wishlist-remove=1');
                    }
                }
            }
            else{
                $item_array = array(
                    'home_id' => $_GET['id']
                );
                $wishlist_data[] = $item_array;
                $item_data = json_encode($wishlist_data);
                setcookie('homes_wishlist', $item_data, $favourite_expiry);
                header('location:'.$refresh_page.'?wishlist-success=1');
            }
            } 
        } 
        else{
            if(isset($_COOKIE["homes_wishlist"]))
            {
                $cookie_data = stripslashes($_COOKIE['homes_wishlist']);
                $wishlist_data = json_decode($cookie_data, true);
            }
            else{
                $wishlist_data = array();
            }
        $item_id_list = array_column($wishlist_data, 'home_id');
        if(in_array($_GET['id'], $item_id_list))
        {
            foreach($wishlist_data as $keys => $values)
            {
                if($wishlist_data[$keys]["home_id"] == $_GET['id'] )
                {
                    unset($wishlist_data[$keys]);
                    $item_data = json_encode($wishlist_data);
                    setcookie('homes_wishlist', $item_data, $favourite_expiry);
                    header('location:'.$refresh_page.'?wishlist-remove=1');
                }
            }
        }
        else{
            $item_array = array(
                'home_id' => $_GET['id']
            );
            $wishlist_data[] = $item_array;
            $item_data = json_encode($wishlist_data);
            setcookie('homes_wishlist', $item_data, $favourite_expiry);
            header('location:'.$refresh_page.'?wishlist-success=1');
        }
        }    
           
    }

    if($_GET['action'] == 'wishlist_delete')
    { 
        if (isset($_SESSION['logged_in'])) {
            if ($_SESSION['logged_in'] == TRUE) {
                mysqli_query($connection,"DELETE FROM `wishlist` WHERE customer_id ='".$customer_row['id']."' AND home_id ='".$_GET['id']."'");
                header('location:'.$refresh_page.'?remove=1');
            }
            else{
                $wishlist_data = stripslashes($_COOKIE['homes_wishlist']);
                $wishlist_data = json_decode($wishlist_data, true);
                foreach($wishlist_data as $keys => $values)
                {
                    if($wishlist_data[$keys]['item_id'] == $_GET['id'])
                    {
                        unset($wishlist_data[$keys]);
                        $item_data = json_encode($wishlist_data);
                        setcookie('homes_wishlist', $item_data, $favourite_expiry);
                        header('location:'.$refresh_page.'?wishlist-remove=1');
                    }
                }
            }
        }
        else{
            $wishlist_data = stripslashes($_COOKIE['homes_wishlist']);
            $wishlist_data = json_decode($wishlist_data, true);
            foreach($wishlist_data as $keys => $values)
            {
                if($wishlist_data[$keys]['item_id'] == $_GET['id'])
                {
                    unset($wishlist_data[$keys]);
                    $item_data = json_encode($wishlist_data);
                    setcookie('homes_wishlist', $item_data, $favourite_expiry);
                    header('location:'.$refresh_page.'?wishlist-remove=1');
                }
            }
        }
    }
    if($_GET['action'] == 'wishlist-clear')
    {
        if (isset($_SESSION['logged_in'])) {
            if ($_SESSION['logged_in'] == TRUE) { 
                mysqli_query($connection,"DELETE FROM `wishlist` WHERE customer_id ='".$customer_row['id']."'");
                header('location:'.$refresh_page.'?wishlist-clear=1');
            }
            else{
                setcookie('homes_wishlist', '', $favourite_expiry);
                header('location:'.$refresh_page.'?wishlist-clear=1');
            }
        }
        else{
            setcookie('homes_wishlist', '', $favourite_expiry);
            header('location:'.$refresh_page.'?wishlist-clear=1');
        }
    }
}
if(isset($_GET["wishlist-success"])){
    $message = '
    <div class="alert alert-dismissible" style="background-color: #59b828; color:white;">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        Home Added into Wishlist
    </div>    
    ';
}
if(isset($_GET["wishlist-remove"])){
    $message = '
    <div class="alert alert-dismissible" style="background-color: #59b828; color:white;">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        Home Removed from Wishlist
    </div>    
    ';
}
if(isset($_GET["wishlist-clear"])){
    $message = '
    <div class="alert alert-dismissible" style="background-color: #59b828; color:white;">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
       Your Wishlist was Successfully Cleared
    </div>    
    ';
}
?>