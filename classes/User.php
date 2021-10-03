<?php
class User{
    
    public function create($connection, $fields = array())
    {  
        $db = new Database();
        mysqli_query($connection,$db->insert("users", $fields)) or die(mysqli_error($connection));
    }

    public function login($connection, $remember, $random,$user_id,$email,$iptocheck,$useragent)
    {
        $db = new Database();
         //user successfully authenticates with the provided email address and password
        //Reset login attempts for a specific email address to 0 as well as the ip address
      $loginattempts_email = 0;
      $loginattempts_total = 0;
      $loginattempts_email = intval($loginattempts_email);
      $loginattempts_total = intval($loginattempts_total);

      $salt_ip = substr($random, 0, $length_salt);

      //hash the ip address, user-agent and the salt
      $hash_user = sha1($salt_ip . $iptocheck . $useragent);

      //concatenate the salt and the hash to form a signature
      $signature = $salt_ip . $hash_user;

      //Regenerate session id prior to setting any session variable
      //to mitigate session fixation attacks
      session_regenerate_id();

      if(isset($rem)){
        setcookie('email', $email, $remember_me_expiry);
        setcookie('pass', $pass, $remember_me_expiry);
        }
        else{
        	if(isset($_COOKIE['email']))
        	{
        		setcookie('email','');
        	}
        	if(isset($_COOKIE['pass']))
        	{
        		setcookie('pass','');
        	}
        }


        mysqli_query($connection,"UPDATE `users` SET `loginattempt` = '$loginattempts_email' WHERE `email_address` = '$email'");
        //mysqli_query("UPDATE `ipcheck` SET `failedattempts` = '$loginattempts_total' WHERE `loggedip` = '$iptocheck'");


       
//Finally store user unique signature in the session
//and set logged_in to TRUE as well as start activity time
        $_SESSION['signature'] = $signature;
        $_SESSION['logged_in'] = TRUE;
        $_SESSION['LAST_ACTIVITY'] = time();
        if (isset($_SESSION['logged_in'])) {
          mysqli_query($connection,"INSERT INTO `logged_devices` (`user`,`ip_address`,`browser/device`) VALUES ('$user_id','$iptocheck','$useragent')");
        }
    }
}