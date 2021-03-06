<?php
use \PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require('../config.php');
require('../functions.php');
session_start();
$botDetect = FALSE;
$usernamenotempty = TRUE;
$usernamevalidate = TRUE;
$usernotduplicate = TRUE;
$passwordnotempty = TRUE;
$passwordvalidate = TRUE;
$passwordmatch  = TRUE;
$verificationmatch = TRUE;
$internet_connection = TRUE;
$mailsent = FALSE;
$query = new Database();
if(isset($_GET['verification']))
	{
		$user_details = mysqli_fetch_array(mysqli_query($connection,$query->get("users","*", array('email_address','=',$_GET['email']))));
		if($_GET['verification'] == $user_details['token'])
		{
			$_SESSION['user'] = $user_details['first_name'];
			$_SESSION['email'] = $_GET['email'];
			$random = genRandomSaltString();
			$salt_ip = substr($random, 0, $length_salt);
			//hash the ip address, user-agent and the salt
			$hash_user = sha1($salt_ip . $iptocheck . $useragent);
			//concatenate the salt and the hash to form a signature
			$signature = $salt_ip . $hash_user;
			$_SESSION['signature'] = $signature;
			$_SESSION['logged_in'] = TRUE;
			$_SESSION['LAST_ACTIVITY'] = time();

			if (isset($_SESSION['logged_in'])) {
				mysqli_query($connection,$query->update("users", "email_address", $_GET['email'], array('online' => '1', 'user_status' => '1')));
				mysqli_query($connection,$query->insert("logged_devices", array('user_id' => $user_details['id'], 'ip_address' => $iptocheck, 'browser/device' => $useragent))) or die(mysqli_error($connection));
				SessionManager::flash('success', 'You have registered successfully!');
				Redirect::to($dashboard_link);
				exit;
			}		
		}
		else
		{
			$verificationmatch = FALSE;
		}
	}
if (isset($_REQUEST['submit_button'])) {
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
		//sanitize user inputs
    $first_name = sanitize($_POST["firstname"]);
	$other_name = sanitize($_POST["othername"]);
    $last_name = sanitize($_POST["lastname"]);
	$location = sanitize($_POST["location"]);
    $email = sanitize($_POST["email"]);
    $mobile = sanitize($_POST["mobile"]);
    $desired_password = sanitize($_POST["pass"]);
    $desired_password1 = sanitize($_POST["pass2"]);
    $hash = password_hash($desired_password, PASSWORD_DEFAULT);
    if (!($fetch = mysqli_fetch_array(mysqli_query($connection,$query->get("users","phone_number", array('phone_number','=',$mobile)))))) {
//no records for this user in the MySQL database
        $usernotduplicate = TRUE;
    } else {
        $usernotduplicate = FALSE;
    }
	
    if (!($fetch = mysqli_fetch_array(mysqli_query($connection,$query->get("users","email_address", array('email_address','=',$email)))))) {
//no records for this user in the MySQL database
        $usernotduplicate = TRUE;
    } else {
        $usernotduplicate = FALSE;
    }
//validate password

    if (empty($desired_password)) {
        $passwordnotempty = FALSE;
    } else {
        $passwordnotempty = TRUE;
    }
//php function ctype_alnum for checking the characters used in registration
    if ( ((strlen($desired_password)) < 8)) {
        $passwordvalidate = FALSE;
    } else {
        $passwordvalidate = TRUE;
    }

    if ($desired_password == $desired_password1) {
        $passwordmatch = TRUE;
    } else {
        $passwordmatch = FALSE;
    }

    if (($usernamenotempty == TRUE)
        && ($usernamevalidate == TRUE)
        && ($usernotduplicate == TRUE)
        && ($passwordnotempty == TRUE)
        && ($passwordmatch == TRUE)
        && ($passwordvalidate == TRUE)
        ){
	//Insert details to database
	 $user = new User();
	 $user->create($connection, array('role_id' => '2','first_name' => $first_name,'other_name' => $other_name,'last_name' => $last_name,'phone_number' => $mobile,'email_address' => $email,'physical_address' => $location,'password' => $hash));
		$verification_key = generateRandomString();
		$verified_link = $protocol.$_SERVER['HTTP_HOST'].'/HomeExchange/auth/registration.php?email='.$email.'&verification='.$verification_key;
        mysqli_query($connection, "UPDATE users SET token= '$verification_key' WHERE email_address ='$email'");
        require_once "PHPMailer/PHPMailer.php";
        require_once "PHPMailer/Exception.php";
        require_once "PHPMailer/SMTP.php";
         $mail = new PHPMailer(true);
        $mail -> addAddress($email,'Recepient');
        $mail -> setFrom($authenticator_email,$organization);
        $mail->IsSMTP();
        $mail->Host = $mail_host;
        // optional
        // used only when SMTP requires authentication  
        $mail->SMTPAuth = true;
        $mail->Username = $authenticator_email;
        $mail->Password = $authenticator_password;
        $mail -> Subject = "Activate your Home Swap account";
        $mail -> isHTML(true);
		$mail->AddEmbeddedImage('../assets/images/logo.png', 'logo');
        $mail->AddEmbeddedImage('../assets/images/socials/facebook.png', 'facebook');
        $mail->AddEmbeddedImage('../assets/images/socials/twitter.png', 'twitter');
        $mail->AddEmbeddedImage('../assets/images/socials/instagram.png', 'instagram');
        $mail->AddEmbeddedImage('../assets/images/socials/youtube.png', 'youtube');
        $mail -> Body = "
		      <p style='text-align:center'><img src='cid:logo' height='80px' width='80px' alt='logo'></p>
              <hr style='border-top: 3px solid #FD5555;'>
              <br>
              Hi $first_name,<br><br>
			    You've successfully signed up for Home Swap.
                In order to activate your account, please click on the link below (this will confirm you email address):<br>
                <a href='
                $verified_link'>Account Activation Link</a><br><br>
                
                Kind Regards,<br>
                Home Swap.
				<br><br><br><br><br><br>
                <hr style='border-top: 1px solid #666666;'>
                <br>
				<a href='#'><img src='cid:facebook' style='width:25px;height:25px;' alt='facebook'></a>
				<a href='#'><img src='cid:twitter' style='width:25px;height:25px;' alt='twitter'></a>
				<a href='#'><img src='cid:instagram' style='width:25px;height:25px;' alt='instagram'></a>
				<a href='#'><img src='cid:youtube' style='width:25px;height:25px;' alt='youtube'></a>
				
				<a href='#' style='margin-left:10px;color: #666666; text-align:right'>Unsubscribe</a>
				<a href='#' style='margin-left:10px;color: #666666; text-align:right'>Privacy Policy</a>
				<a href='#' style='margin-left:10px;color: #666666; text-align:right'>Terms of Service</a>
                ";
          if($mail -> send()){
            $mailsent = TRUE;
        }
	 }
	}
	else{
		$botDetect = TRUE;
	}
 }
?>    
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Registration</title>
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
</head>
<body>	
	<div class="limiter">
		<div class="container-login100" style="background-image:url('../assets/images/signup_bg.jpeg');background-repeat: no-repeat;background-size: 1300px 1300px;">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image:url('../assets/images/signup_auth_bg.jpeg')">
					<span class="login100-form-title-1">
						Sign Up
					</span>
				</div>  
				<form class="login100-form" id="registration-form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">

					<div class="wrap-input100 m-b-20">
						<span class="label-input100">First Name</span>
						<input class="input100" type="text" name="firstname" id="firstname" required placeholder="Christine">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 m-b-20">
						<span class="label-input100">Other Name</span>
						<input class="input100" type="text" name="othername" id="othername" required placeholder="Zawadi">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 m-b-20">
						<span class="label-input100">Last Name</span>
						<input class="input100" type="text" name="lastname" id="lastname" required placeholder="Washiali">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 m-b-20">
						<span class="label-input100">Physical Address</span>
						<input class="input100" type="text" name="location" id="location" required placeholder="&#xf041; Lang'ata, Nairobi, Kenya" style="font-family:Arial, FontAwesome">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 m-b-20">
						<span style="color: red;" id="mobile-error"></span>
						<span class="label-input100">Mobile Number</span>
						<input class="input100" type="text" name="mobile" id="mobile" required placeholder="&#xf095; +254 7## ### ###" style="font-family:Arial, FontAwesome">
						<span class="focus-input100" ></span>
					</div>

					<div class="wrap-input100 m-b-20">
						<span style="color: red;" id="email-error"></span>
						<span class="label-input100">Email Address</span>
						<input class="input100" type="email" name="email" id="email" required placeholder="&#xf0e0; christine*****@gmail.com" style="font-family:Arial, FontAwesome">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 m-b-20">
						<span style="color: red;" id="pass-error"></span>
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="pass" id="pass" required placeholder="Enter password">
						<span class="focus-input100" ></span>
					</div>

					<div class="wrap-input100 m-b-20">
						<span style="color: red;" id="pass2-error"></span>
						<span class="label-input100">Confirm Password</span>
						<input class="input100" type="password" name="pass2" id="pass2" required placeholder="Re-enter password">
						<span class="focus-input100" ></span>
					</div>

					<div class="flex-sb-m w-full m-b-30" style="margin-top: 30px">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" required name="T&C">
							<label class="label-checkbox100" for="ckb1">
								I agree to the <a href="#" style="color: inherit;text-decoration: underline;">Terms and Conditions</a>
							</label>
						</div>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" name="submit_button">
							Sign Up
						</button>
					</div>
					<div>
						<br>
						
						<p>Already have an account?&ensp;<a href="<?php echo 'login.php?page_url=../'.$dashboard_url; ?>" style="color: inherit;text-decoration: underline;">Sign In</a></p>
					</div>	
					<div style="margin-top: 20px">
		                  <!-- Display error -->
		                  <?php if ($botDetect == TRUE && $internet_connection  == TRUE)
		                    echo '<font color="red"><i class="bx bx-shield-quarter bx-flashing"></i>&ensp;Access Denied!</font>'; 
					        if ($passwordmatch == FALSE)
					        echo '<br><br>&emsp;&emsp;&emsp;&ensp;<font color="red"><i class="bx bxs-error bx-flashing"></i>&ensp;Your passwords do not match.</font>'; 
							if ($internet_connection  == FALSE)
		                    echo '<br><font color="red"><i class="bx bx-wifi bx-flashing"></i>&ensp;Please check your internet connection and try again.</font>';
					        if ($passwordvalidate == FALSE)
					        echo '<br><br>&emsp;&emsp;&emsp;&emsp;<font color="red"><i class="bx bx-shield-quarter bx-flashing"></i>&ensp;Your password should be greater than 8 characters.</font>'; 
					        if ($usernamevalidate == FALSE)
					        echo '<br><br>&emsp;&emsp;&emsp;&emsp;<font color="red"><i class="bx bx-shield-quarter bx-flashing"></i>&ensp;Your username should be less than 11 characters.</font>'; 
							if ($mailsent == TRUE)
					        echo '<br><br><font color="green"><i class="bx bx-check-circle bx-flashing"></i>&ensp;Please check your email for an activation link for your account.</font>'; 
					        if ($verificationmatch == FALSE)
					        echo '<br><br><font color="red"><i class="bx bx-shield-quarter bx-flashing"></i>&ensp;Your verification keys do not match. <br>Kindly ensure that you are using the correct activation link.</font>'; 		
					        if ($usernotduplicate == FALSE)
					        echo '<br><br>&emsp;&emsp;&emsp;&emsp;<font color="red"><i class="bx bxs-data bx-flashing"></i>&ensp;User already exists.</font>'; ?>
                  </div>
					<input type="hidden" id="token" name="token">       		        
				</form>
			</div>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
	<script type="text/javascript">
		$(function(){
		  $(`#email-error`).hide();
		  $(`#mobile-error`).hide();
		  $(`#pass-error`).hide();
		  $(`#pass2-error`).hide();

		  var emailError = false;
          var mobileError = false;
          var passError = false;
          var pass2Error = false;

           $(`#email`).focusout(function(){
              check_email();
          });
          $(`#mobile`).focusout(function(){
              check_mobile();
          });
          $(`#pass`).focusout(function(){
              check_pass();
          });
          $(`#pass2`).focusout(function(){
              check_pass2();
          });

          
          function check_email(){
          	var email = $(`#email`).val();
          	var where = 'email';
            $.post("verification.php",{email:email,where:where},
              function(result){
              	if (result == 'exists') {
              		$(`#email-error`).show();
              		$(`#email-error`).html('<i class="bx bxs-data bx-flashing"></i>&ensp;This email address already exists.');
              		emailError = true;

              	}
              	else{
              		$(`#email-error`).hide();
              		$(`#email-error`).html('');
              		emailError = false;
              	}
            });
        }


 
        function check_mobile(){
          	var mobile = $(`#mobile`).val();
          	var where = 'mobile';
              $.post("verification.php",{mobile:mobile,where:where},
              function(result){
              	if (result == 'exists') {
              		$(`#mobile-error`).show();
              		$(`#mobile-error`).html('<i class="bx bxs-data bx-flashing"></i>&ensp;This mobile number already exists.');
              		mobileError = true;
              	}
              	else{
              		$(`#mobile-error`).hide();
              		$(`#mobile-error`).html('');
              		emailError = false;
              	}
          });
        }

        function check_pass(){
          	var pass = $(`#pass`).val().length;
          	if (pass > 0 && pass < 8) {
              $(`#pass-error`).show();
              $(`#pass-error`).html('<i class="bx bx-shield-quarter bx-flashing"></i>&ensp;Password should be greater than 8 characters.');
              passError = true;
          	}
          	else{
               $(`#pass-error`).hide();
              	$(`#pass-error`).html('');
              	passError = false;
          	}
          	
        }
        function check_pass2(){
          	var pass2 = $(`#pass2`).val();
          	var pass = $(`#pass`).val();
          	if( pass2 !== pass && pass2 != ''){
          		$(`#pass2-error`).show();
              $(`#pass2-error`).html('<i class="bx bxs-error bx-flashing"></i>&ensp;Your passwords do not match.');
              pass2Error = true;
          	}
          	else{
          		$(`#pass2-error`).hide();
              	$(`#pass2-error`).html('');
              	pass2Error = false;
          	}
          	
        } 

        $(`#registration-form`).submit(function(){
          check_email();
          check_mobile();
          check_pass(); 
          check_pass2();          

          if (emailError == false && mobileError == false && passError == false && pass2Error == false) {
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