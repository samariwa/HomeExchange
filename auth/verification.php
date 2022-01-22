<?php
require('../config.php');
require('../functions.php');
$where = $_POST['where'];
$query = new Database();
if($where == 'email' )
{
    $email = sanitize($_POST['email']);
   $result = mysqli_fetch_array(mysqli_query($connection,$query->get("users","*", array('email_address','=',$email))));
   if ( $result == TRUE) {
    echo "exists";
   }
   else{
       if($email != '')
       {
         echo "missing";
       }
   }
}
elseif($where == 'mobile' )
{
    $mobile = sanitize($_POST['mobile']);
   $result = mysqli_fetch_array(mysqli_query($connection,$query->get("users","phone_number", array('phone_number','=',$mobile))));
   if ( $result == TRUE) {
    echo "exists";
   }
} 
elseif($where == 'password' )
{
    $email = sanitize($_POST['email']);
    $password = sanitize($_POST['password']);
    $row = mysqli_fetch_array(mysqli_query($connection,$query->get("users","password", array('email_address','=',$email))));
    if ( $row == TRUE) {
        $correctpassword = $row['password'];
        if($password != '')
        {
        if(!password_verify($password, $correctpassword))
            {
                echo "invalid";
            }
        }    
    }
}
?>