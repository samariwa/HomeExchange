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
    mysqli_query($connection,$query->update("users", "email_address", $email, array('online' => '0', 'lastActivity' => 'NOW()')));
   mysqli_query($connection,"DELETE FROM `logged_devices` WHERE `user_id` = '$user_id' AND ip_address = '$iptocheck'");
   $session->put('logged_in', FALSE);
    session_destroy();
    session_unset();
    if($access == '2'){
      Redirect::to($_REQUEST['page_url']);
    }else{
      Redirect::to("../$home_url");
    }
}
    ?>