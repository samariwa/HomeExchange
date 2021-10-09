<?php
session_start();
require('../config.php');
$query = new Database();
$session = new SessionManager();
function sanitize($data) {
    $data = trim($data);
    $data = htmlspecialchars($data);
    return $data;
}
if ($session->exists('logged_in')) {
	$email = $session->get('email');
    $row = mysqli_fetch_array(mysqli_query($connection,$query->get("users","*", array('email_address','=',$email))));
    $access = $row['role_id'];
    $user_id = $row['id'];
    mysqli_query($connection,$query->update("users", "email_address", $email, array('online' => '0', 'lastActivity' => 'NOW()', 'ipaddress' => '0')));
   mysqli_query($connection,"DELETE FROM `logged_devices` WHERE `user` = '$user_id' AND ip_address = '$iptocheck'");
    $session->put('logged_in', FALSE);
    session_destroy();
    session_unset();
    if($access == '2'){
        $redirect_page = $_REQUEST['page_url'];
        $profile_link = FALSE;
        if (strpos($redirect_link, 'profile.php') == TRUE) {
          $profile_link = TRUE;
      }
      elseif (strpos($redirect_link, 'checkout.php') == TRUE){
        $profile_link = TRUE;
      }
      elseif (strpos($redirect_link, 'order-details.php') == TRUE){
        $profile_link = TRUE;
      }
      elseif (strpos($redirect_link, 'track-order-single.php') == TRUE){
        $profile_link = TRUE;
      }
      elseif (strpos($redirect_link, 'track-order.php') == TRUE){
        $profile_link = TRUE;
      }
      elseif (strpos($redirect_link, 'user-dashboard.php') == TRUE){
        $profile_link = TRUE;
      }
      elseif (strpos($redirect_link, 'wishlist.php') == TRUE){
        $profile_link = TRUE;
      }
      elseif (strpos($redirect_link, 'login.php') == TRUE){
        $profile_link = TRUE;
      }
        if(($redirect_link == '') || ($profile_link == TRUE))
        {
          Redirect::to("../$home_url");
        }
        else
        {
          Redirect::to($redirect_page);
        }
      }else{
        Redirect::to("../$home_url");
      }
}
    ?>