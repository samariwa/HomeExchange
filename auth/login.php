<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
//require user configuration and database connection parameters
//Start PHP session
session_start();
//require user configuration and database connection parameters
require('../config.php');
require_once "../functions.php";
$query = new Database();
$session = new SessionManager();
if ($session->exists('logged_in')) {
	if ($session->get('logged_in') == TRUE) {
//valid user has logged-in to the website
//Check for unauthorized use of user sessions
mysqli_query($connection,$query->update("users", "email_address", $email, array('online' => '1')));
    $signaturerecreate = $session->get('signature');

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
        Redirect::to("../$logout_url?page_url=<?php echo $redirect_link; ?>");
        exit;
    }
    else{
      $logged_in_email = $session->get('email');
        $row = mysqli_fetch_array(mysqli_query($connection,$query->get("users","*", array('email_address','=',$logged_in_email))));
        $access = $row['role_id'];
      if($access == '2'){
        Redirect::to("../$dashboard_url");
      }else{
        Redirect::to("../$admin_url");
      }
    }

//Session Lifetime control for inactivity

    if (( $session->exists('LAST_ACTIVITY')) && (time() - $session->get('LAST_ACTIVITY') > $sessiontimeout)) {
//redirect the user back to login page for re-authentication
      Redirect::to("../$logout_url?page_url=<?php echo $home_link; ?>");
    }
    $session->put('LAST_ACTIVITY', time());
}
}
//Pre-define validation
$validationresults = TRUE;
$registered = TRUE;
$botDetect = FALSE;
$internet_connection = TRUE;
//Check if a user has logged-in
if (!$session->exists('logged_in')) {
    $session->put('logged_in', FALSE);
}
if(isset($_REQUEST['login-button'])){
  $url = $token_verification_site;
	$data = [
		'secret' => $private_key,
		'response' => $_POST['token'],
    'remoteip' => $iptocheck
	];
  $options = array(
		'http' => array(
		 'header' => "Content-type: application/x-www-form-urlencoded\r\n",
		     'method' => 'POST',
        // 'ignore_errors' => true,
		     'content' => http_build_query($data)
         
		 )
	);
  $context = stream_context_create($options);
  try
  {
	$response = file_get_contents($url, false, $context);
  if(empty($response)){
    $internet_connection = FALSE;
 }
  }
  catch (Exception $e) {
    echo $e;
}
	$res = json_decode($response, true);
	if ($res['success'] == true && $res['score'] >= 0.5) {
//Check if the form is submitted
if ((isset($_POST["pass"])) && (isset($_POST["email"])) && (!$session->get('logged_in'))) {
//Email and password has been submitted by the user
//Receive and sanitize the submitted information


    $email = sanitize($_POST["email"]);
    $pass = sanitize($_POST["pass"]);
    
        $row = mysqli_fetch_array(mysqli_query($connection,$query->get("users","*", array('email_address','=',$email))));
        $identity = $row['first_name'];
        $user_id = $row['id'];
        $user_email = $row['email_address'];
        $access = $row['role_id'];
        $roleSession = mysqli_query($connection,"SELECT roles.role_name as Name FROM `roles` inner join users on users.role_id = roles.id WHERE users.email_address='$user_email'");
        $row5 = mysqli_fetch_array($roleSession);
        $role = $row5['Name'];      
     $_SESSION['role'] = $role;
    $_SESSION['user'] = $identity;
    $_SESSION['email'] = $user_email;
//validate email
    if (!($fetch = mysqli_fetch_array(mysqli_query($connection,$query->get("users","email_address", array('email_address','=',$email)))))) {
//no records of email in database
//user is not yet registered
        $registered = FALSE;
    }
   
//u is registered in database, now get the hashed password    
        $row = mysqli_fetch_array(mysqli_query($connection,$query->get("users","password", array('email_address','=',$email))));
        $correctpassword = $row['password'];
    if (!password_verify($pass, $correctpassword) || ($registered == FALSE)) {
           $validationresults = FALSE;

              $row = mysqli_fetch_array(mysqli_query($connection,$query->get("users","loginattempt", array('email_address','=',$email))));
              $loginattempts_email = $row['loginattempt'];
            $loginattempts_email = $loginattempts_email + 1;
            $loginattempts_email = intval($loginattempts_email);
//update login attempt records
mysqli_query($connection,$query->update("users", "email_address", $email, array('loginattempt' => $loginattempts_email)));
    } 
    else {
    	//remember me functionality
      $rem = sanitize($_POST['remember']);

      //Generate unique signature of the user based on IP address
      //and the browser then append it to session
      //This will be used to authenticate the user session
      //To make sure it belongs to an authorized user and not to anyone else.
      //generate random hash
      $random = genRandomSaltString();

      $user = new User();
 	    $user->login($connection, $rem, $random, $user_id, $email,$pass, $remember_me_expiry, $length_salt, $iptocheck, $useragent);  
    }
}
}
else{
  $botDetect = TRUE;
}
}
if (!$session->get('logged_in')):
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
  <link rel="shortcut icon" type="image/png" sizes="196x196" href="../assets/images/home_swap_logo.png" />
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="../assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="../assets/css/util.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="../assets/css/main.css">
<!--===============================================================================================-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans'>
    <!--===============================================================================================-->
    <link href='https://unpkg.com/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
    <!--===============================================================================================-->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!--===============================================================================================-->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <!--===============================================================================================-->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="https://www.google.com/recaptcha/api.js?render=<?php echo $public_key; ?>"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

</head>
  <div class="limiter">
    <div class="container-login100" style="background-image:url('../assets/images/login_bg<?php echo shuffleImage(1,7) ?>.jpeg');background-repeat: no-repeat;background-size: 1300px 800px;">
      <div class="wrap-login100" >
        <div class="login100-form-title" style="background-image:url('../assets/images/login_auth_bg.jpg')">
          <span class="login100-form-title-1">
            Sign In
          </span>
        </div>

        <form class="login100-form" method="POST" id="login-form">

          <div class="wrap-input100 m-b-20">
						<span style="color: red;" id="email-error"></span>
            <span class="label-input100">Email Address</span>
            <input class="input100" value="<?php if(isset($_COOKIE['email'])){echo $_COOKIE['email'];}?>"  type="email" name="email" id="email" required placeholder="Enter email address">
            <span class="focus-input100"></span>
          </div>

          <div class="wrap-input100 m-b-20">
						<span style="color: red;" id="password-error"></span>
            <span class="label-input100">Password</span>
            <input class="input100" value="<?php if(isset($_COOKIE['pass'])){echo $_COOKIE['pass'];}?>" type="password" name="pass" id="pass" required placeholder="Enter password">
            <span class="focus-input100"></span>
          </div>
           <div class="flex-sb-m w-full m-b-30">
            <div class="contact100-form-checkbox">
              <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember" <?php if(isset($_COOKIE['email'])){ ?> checked <?php }?>>
              <label class="label-checkbox100" for="ckb1">
                Remember Me
              </label>
            </div>
            <div>
              <a href="forgot.php" class="txt1" style="text-decoration: none;">
                Forgot Password?
              </a>
            </div>
          </div>
          <div class="container-login100-form-btn">
            <button class="login100-form-btn" name="login-button">
              Sign In
            </button>
          </div>
          <div>
            <br>
             <p>Don't have an account?&ensp;<a href="registration.php" style="color: inherit;text-decoration: underline;">Sign Up</a></p>
          </div>
          <?php 
          if (($validationresults == FALSE) || ($registered == FALSE) || ($botDetect == TRUE) || ($internet_connection == FALSE)){
          ?>
          <div style="margin-top: 20px">
          <!-- Display validation errors -->
                     <?php if ($botDetect == TRUE && $internet_connection  == TRUE)
		                        echo '<font color="red"><i class="bx bx-shield-quarter bx-flashing"></i>&ensp;Access Denied!</font>';
                            if ($internet_connection  == FALSE)
		                        echo '<br><font color="red"><i class="bx bx-wifi bx-flashing"></i>&ensp;Please check your internet connection and try again.</font>';
                            if ($validationresults == FALSE || $registered == FALSE)
                        echo '<br><font color="red"><i class="bx bxs-lock bx-flashing"></i>&ensp;Please enter valid email address, password <br> &ensp;&emsp;(if required).</font>';
                   ?>
                  </div>
            <?php
                 }
           ?>
           <input type="hidden" id="token" name="token">                   
        </form>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
  <script type="text/javascript">
  $(function(){
    $(`#email-error`).hide();
    $(`#password-error`).hide();

    var emailError = false;
    var passError = false;
 
    $(`#email`).focusout(function(){
        check_email();
      });
    $(`#pass`).focusout(function(){
        check_pass();
      });

      function check_email(){
          	var email = $(`#email`).val();
          	var where = 'email';
            $.post("verification.php",{email:email,where:where},
              function(result){
              	if (result == 'missing') {
              		$(`#email-error`).show();
              		$(`#email-error`).html('<i class="bx bxs-data bx-flashing"></i>&ensp;This email address does not exists.');
              		emailError = true;
              	}
              	else{
              		$(`#email-error`).hide();
              		$(`#email-error`).html('');
              		emailError = false;
              	}
            });
        }

        function check_pass(){
          var email = $(`#email`).val();
          	var password = $(`#pass`).val();
          	var where = 'password';
              $.post("verification.php",{email:email,password:password,where:where},
              function(result){
              	if (result == 'invalid') {
              		$(`#password-error`).show();
              		$(`#password-error`).html('<i class="bx bxs-data bx-flashing"></i>&ensp;Invalid Password.');
              		passError = true;
              	}
              	else{
              		$(`#password-error`).hide();
              		$(`#password-error`).html('');
              		passError = false;
              	}
          });
        }

        $(`#login-form`).submit(function(){

          check_email();
          check_pass();   

          if (emailError == false &&  passError == false) {
          	return true;
          }else{
          	return false;
          }
        });

  });

  grecaptcha.ready(function() {
    // do request for recaptcha token
    // response is promise with passed token
        grecaptcha.execute('<?php echo $public_key; ?>', {action:'validate_captcha'})
                  .then(function(token) {
            // add token value to form
            document.getElementById('token').value = token;
        });
    });
  </script>
</body>
</html>
<?php
else:
	//redirect to dashboard
  if($access == '2'){
    $redirect_page = $_REQUEST['page_url'];
    if($redirect_link == ''){
      Redirect::to("../".$dashboard_url);
    }
    else if($redirect_page == ''){
      Redirect::to("../".$dashboard_url);
    }
    else{
      if (strpos($redirect_link, 'admin') == TRUE) {
        Redirect::to("../".$dashboard_url);
      }
    Redirect::to($redirect_page); 
    }
  }else{
    Redirect::to("../".$admin_url);
  }
endif;
?>