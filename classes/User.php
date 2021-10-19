<?php
class User{
    
    public function create($connection, $fields = array())
    {  
        $db = new Database();
        mysqli_query($connection,$db->insert("users", $fields)) or die(mysqli_error($connection));
    }

    public function login($connection, $remember, $random, $user_id, $email, $pass, $remember_me_expiry, $length_salt, $iptocheck, $useragent)
    {
        $db = new Database();
        $session = new SessionManager();
        $cookie = new CookieManager();
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

      if(isset($remember)){
        $cookie->put('email',$email, $remember_me_expiry);
        $cookie->put('pass',$pass, $remember_me_expiry);
        }
        else{
        	if($cookie->exists('email'))
        	{
                $cookie->empty('email');
        	}
        	if($cookie->exists('pass'))
        	{
        		$cookie->empty('pass');
        	}
        }

        mysqli_query($connection,$db->update("users", "email_address", $email, array('loginattempt' => $loginattempts_email, 'online' => '1'))) or die(mysqli_error($connection));

       
//Finally store user unique signature in the session
//and set logged_in to TRUE as well as start activity time
         $session->put('signature', $signature);
         $session->put('logged_in', TRUE);
         $session->put('LAST_ACTIVITY', time());

        if ($session->exists('logged_in'))
        {
            mysqli_query($connection,$db->insert("logged_devices", array('user_id' => $user_id, 'ip_address' => $iptocheck, 'browser/device' => $useragent))) or die(mysqli_error($connection));
        }
    }

    public function GetUserRole($user_email)
    {
        $query = new Database();
        return $query->get("users","role_id", array('email_address','=',$user_email));
    }

    public function UpdateUserDetails($user_id, $first_name, $other_name, $last_name, $email, $mobile, $location)
    {
        $query = new Database();
        return $query->update("users", "id", $user_id, array('first_name' => $first_name, 'other_name' => $other_name, 'last_name' => $last_name, 'email_address' => $email, 'phone_number' => $mobile, 'physical_address' => $location));
    }

    public function DeactivateUser($user_id)
    {
        $query = new Database();
       return $query->update("users", "id", $user_id, array('user_status' => '0'));
    }

    public function ReactivateUser($user_id)
    {
        $query = new Database();
        return $query->update("users", "id", $user_id, array('user_status' => '1'));
    }

    public function DeleteUser($user_id)
    {
        $db = new Database();
       return $db->delete("users", $user_id);
    }
}