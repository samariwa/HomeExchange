<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require_once "../functions.php";
require('../config.php');
$query = new Database();
$verified = FALSE;
$no_Error = TRUE;
$exists = TRUE;
$botDetect = FALSE;
$internet_connection = TRUE;
if (isset($_REQUEST['forgot-button'])) {
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
   if (isset($_POST['email'])){
      $email = $connection->real_escape_string($_POST['email']);
      $check=mysqli_query($connection,$query->get("users","first_name", array('email_address','=',$email)));
       $row = mysqli_fetch_array($check);
      $exists=mysqli_num_rows($check);
        $name = $row['first_name'];
      if ($exists > 0){
        $random = generateRandomString();
        $reset_link = $protocol.$_SERVER['HTTP_HOST'].'/HomeExchange/auth/reset.php?email='.$email.'&token='.$random;
        mysqli_query($connection, "UPDATE users SET token= '$random',tokenExpire=DATE_ADD(NOW(), INTERVAL 5 MINUTE )WHERE email_address ='$email'");
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
        $mail -> Subject = "Reset Password";
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
              Hi $name,<br><br>
                In order to reset your password, please click on the link below:<br>
                <a href='
                $reset_link'>Password Reset Link</a><br><br>
                Kindly reset your password in the given time limit of 5 minutes.<br><br>
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
            $verified = TRUE;
        }
          else{
            $no_Error = FALSE;
        }
      }else{
        $exists = FALSE;
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
  <title>Forgot Password</title>
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
  <div class="limiter">
    <div class="container-login100" style="background-image:url('../assets/images/forgot_bg.jpeg');background-repeat: no-repeat;background-size: 1300px 800px;">
      <div class="wrap-login100">
        <div class="login100-form-title" style="background-image:url('../assets/images/forgot_auth_bg.png')">
          <span class="login100-form-title-1">
            Forgot Password
          </span>
        </div>

        <form class="login100-form" method="POST" id="forgot-form">

          <div class="wrap-input100 m-b-20">
          <span style="color: red;" id="email-error"></span>
            <span class="label-input100">Email Address</span>
            <input class="input100"  type="email" name="email" id="email" required placeholder="Enter email address">
            <span class="focus-input100"></span>
          </div>

           <div class="flex-sb-m w-full m-b-30">
   
          </div>
          <div class="container-login100-form-btn">
            <button class="login100-form-btn" name="forgot-button" id="send" type="submit">
              Verify
            </button>
          </div>
          <?php if ($botDetect == TRUE && $internet_connection  == TRUE)
              echo '<font color="red"><i class="bx bx-shield-quarter bx-flashing"></i>&ensp;Access Denied!</font>';
            if ($internet_connection  == FALSE)
		          echo '<br><font color="red"><i class="bx bx-wifi bx-flashing"></i>&ensp;Please check your internet connection and try again.</font>';
           if ($verified == TRUE)
            echo '&emsp;<font color="green"><i class="bx bx-check-circle bx-flashing"></i>&ensp;Please check your email for verification code.<br><i class="bx bxs-hourglass-bottom bx-flashing"></i>&ensp;The code expires in 5 minutes.</font>';
             if ($no_Error == FALSE)
            echo '<br><br>&emsp;&emsp;<font color="red"><i class="bx bx-error-alt bx-flashing"></i>&ensp;Something went wrong. Please try again.</font>';
             if ($exists == FALSE)
            echo '<br>&emsp;&emsp;<font color="red"><i class="bx bx-error-alt bx-flashing"></i>&ensp;Please ensure that the email address entered was <br>&emsp;&ensp;used in registration.</font>'; ?>
            <br><br>
          <div>
            <br>
             <p><a href="<?php echo 'login.php?page_url=../'.$home_url; ?>" style="color: inherit;text-decoration: none;">Back to Login</a></p>
          </div>   
          <input type="hidden" id="token" name="token">              
        </form>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script type="text/javascript">
  $(function(){
    $(`#email-error`).hide();

    var emailError = false;
 
    $(`#email`).focusout(function(){
        check_email();
      }); 


      function check_email(){
          	var email = $(`#email`).val();
          	var where = 'email';
            $.post("verification.php",{email:email,where:where},
              function(result){
              	if (result == 'missing') {
              		$(`#email-error`).show();
              		$(`#email-error`).html('<i class="bx bx-error-alt bx-flashing"></i>&ensp;Kindly enter email-address used in registration.');
              		emailError = true;
              	}
              	else{
              		$(`#email-error`).hide();
              		$(`#email-error`).html('');
              		emailError = false;
              	}
            });
        }

        $(`#forgot-form`).submit(function(){

          check_email();  
          if (emailError == false ) {
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