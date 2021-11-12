<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require('config.php');
require_once "functions.php";
$where =$_POST['where'];
session_start();
if($where == 'admin' )
{
   $firstname = $_POST['firstname'];
   $othername = $_POST['othername'];
   $lastname = $_POST['lastname'];
   $email = $_POST['email'];
   $number = $_POST['mobile'];
   $hash = password_hash($default_admin_pass, PASSWORD_DEFAULT);
   $row = mysqli_query($connection,"SELECT * FROM users WHERE email_address = '".$email."' OR phone_number = '".$number."'")or die($connection->error);
   $result = mysqli_fetch_array($row);
   if ( $result == TRUE) {
    echo "exists";
   }
   else{
     echo "success";
     $user = new User();
	   $user->create($connection, array('role_id' => '1','first_name' => $firstname,'other_name' => $othername,'last_name' => $lastname,'phone_number' => $number,'email_address' => $email,'password' => $hash)) or die(mysqli_error($connection));
   }
}

else if ($where == 'faq') {
  $faq = new Faq();
  $question = $_POST['question'];
  $answer = $_POST['answer'];
  $row = mysqli_query($connection,$faq->GetFaq( 'question',array('question' ,'=', $question)))or die($connection->error);
  $result = mysqli_fetch_array($row);
  if ( $result == TRUE) {
    echo "exists";
  }
  else{
   echo "success";
   mysqli_query($connection,$faq->AddFaq($question,$answer))or die($connection->error);
  }
}

else if ($where == 'feedback') {
  mysqli_query($connection,"INSERT INTO `customer_feedback` (`user_id`, `message`) VALUES ('".$_POST['user']."','".$_POST['message']."')") or die(mysqli_error($connection));
  echo "1";
}

else if ($where == 'home-images') {
  $fileName = $_FILES['upload']['tmp_name'];
  $sourceProperties = getimagesize($fileName);
  $resizeFileName = time();
  $uploadPath = 'assets/images/homes/'; 
  $fileExt = pathinfo($_FILES['upload']['name'], PATHINFO_EXTENSION);
  $path = $resizeFileName.'.'.$fileExt;
  $fullPath = $uploadPath.$path;
  $imageProcess = '';
  $uploadImageType = $sourceProperties[2];
  $sourceImageWidth = $sourceProperties[0];
  $sourceImageHeight = $sourceProperties[1];
  switch ($uploadImageType){
    case IMAGETYPE_JPEG:
      $resourceType = imagecreatefromjpeg($fileName);
      $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
      imagejpeg($imageLayer,$fullPath);
      $imageProcess = 1;
      break;
    case IMAGETYPE_GIF:
      $resourceType = imagecreatefromgif($fileName);
      $imageLayer =  resizeImage($resourceType, $sourceImageWidth, $sourceImageHeight);
      imagegif($imageLayer,$fullPath);
      $imageProcess = 1;
      break;
    case IMAGETYPE_PNG:
      $resourceType = imagecreatefrompng($fileName);
      $imageLayer =  resizeImage($resourceType, $sourceImageWidth, $sourceImageHeight);
      imagepng($imageLayer,$fullPath);
      $imageProcess = 1;
      break;

    default:
    $imageProcess = 0;
    break;  
  }
  
  if($imageProcess == 1)
  {
    move_uploaded_file($fileName, $fullPath);
    $home = new Home();
    mysqli_query($connection,$home->addHomeImages($_POST['home_id'], $path)) or die(mysqli_error($connection));
  }
}

else if ($where == 'request') {
  $extra_requirements = $_POST['extra_requirements'];
  if($extra_requirements == '')
  {
    $extra_requirements = 'No extra details';
  }
  $owner_id= mysqli_query($connection,"SELECT id FROM home_owners WHERE user_id = '".$_POST['user_id']."'")or die($connection->error);
  $owner_result = mysqli_fetch_array($owner_id);
  $request = new HomeExchangeRequest();
  mysqli_query($connection,$request->MakeExchangeRequest($owner_result['id'], $_POST['exchange_home'],$_POST['availability_id'], $_POST['people_accompanying'], $_POST['start_date'], $_POST['end_date'], $extra_requirements))or die($connection->error);
  echo "1";
}

elseif ($where == 'rate-home') {
  $home_rating = new HomeRating();
  $rater_unique = mysqli_query($connection, $home_rating->CheckRaterUnique($_POST['home_id'],$_POST['rater_id'])) or die(mysqli_error($connection));
  $rater_result = mysqli_fetch_array($rater_unique);
  if($rater_result == TRUE)
  {
    mysqli_query($connection, $home_rating->UpdateRating($rater_result['id'],$_POST['val'])) or die(mysqli_error($connection));
  }
  else
  {
    mysqli_query($connection, $home_rating->RateHome($_POST['home_id'],$_POST['rater_id'],$_POST['val'])) or die(mysqli_error($connection));
  }
  $avg_rating = mysqli_query($connection, $home_rating->GetAverageHomeRating($_POST['home_id'])) or die(mysqli_error($connection));
  $result = mysqli_fetch_array($avg_rating);
  mysqli_query($connection, $home_rating->SetAverageHomeRating($_POST['home_id'],$result['rating'])) or die(mysqli_error($connection));
  echo "1";
}

elseif ($where == 'rate-home-owner') {
  $home_owner_rating = new HomeOwnerRating();
  $rater_unique = mysqli_query($connection, $home_owner_rating->CheckRaterUnique($_POST['owner_id'],$_POST['rater_id'])) or die(mysqli_error($connection));
  $rater_result = mysqli_fetch_array($rater_unique);
  if($rater_result == TRUE)
  {
    mysqli_query($connection, $home_owner_rating->UpdateRating($rater_result['id'],$_POST['val'])) or die(mysqli_error($connection));
  }
  else
  {
    mysqli_query($connection, $home_owner_rating->RateHomeOwner($_POST['owner_id'],$_POST['rater_id'],$_POST['val'])) or die(mysqli_error($connection));
  }
  $avg_rating = mysqli_query($connection, $home_owner_rating->GetAverageHomeOwnerRating($_POST['owner_id'])) or die(mysqli_error($connection));
  $result = mysqli_fetch_array($avg_rating);
  mysqli_query($connection, $home_owner_rating->SetAverageHomeOwnerRating($_POST['owner_id'],$result['rating'])) or die(mysqli_error($connection));
  echo "1";
}


elseif ($where == 'newsletter') {
  if (isset($_POST['email'])) {
	$data = [
		'secret' => $private_key,
		'response' => $_POST['token'],
        'remoteip' => $iptocheck
	];
	$options = array(
		'http' => array(
		 'header' => "Content-type: application/x-www-form-urlencoded\r\n",
		     'method' => 'POST',
		     'content' => http_build_query($data)
		 )
	);
	$context = stream_context_create($options);
	$response = file_get_contents($token_verification_site, false, $context);
	$res = json_decode($response, true);
	if ($res['success'] == 'true' && $res['score'] >= 0.5) {
  $row = mysqli_query($connection,"SELECT * FROM newsletter_subscribers WHERE email = '".$_POST['email']."'")or die($connection->error);
   $result = mysqli_fetch_array($row);
   if ( $result == TRUE) {
     echo "exists";
   }
   else{
    echo "success";
    $registered = "";
    $row = mysqli_query($connection,"SELECT * FROM users WHERE email_address = '".$_POST['email']."'")or die($connection->error);
    $result = mysqli_fetch_array($row);
    if ( $result == TRUE) {
      $registered = "1";
    }
    else{
      $registered = "0";
    }
    mysqli_query($connection,"INSERT INTO `newsletter_subscribers` (`email`, `registered_user`) VALUES ('".$_POST['email']."','$registered')") or die(mysqli_error($connection));
   }
  }
}
else{
  echo "error";
} 
}
elseif ($where == 'site_contact') {
  $full_name = "";
  $number = "";
  $registered = "";
  if (isset($_POST['email']) && isset($_POST['message']) && isset($_POST['subject'])) {
	$data = [
		'secret' => $private_key,
		'response' => $_POST['token'],
        'remoteip' => $iptocheck
	];
	$options = array(
		'http' => array(
		 'header' => "Content-type: application/x-www-form-urlencoded\r\n",
		     'method' => 'POST',
		     'content' => http_build_query($data)
		 )
	);
	$context = stream_context_create($options);
	$response = file_get_contents($token_verification_site, false, $context);
	$res = json_decode($response, true);
	if ($res['success'] == 'true' && $res['score'] >= 0.5) {
  $row = mysqli_query($connection,"SELECT * FROM users WHERE email_address = '".$_POST['email']."'")or die($connection->error);
   $result = mysqli_fetch_array($row);
   if ( $result == TRUE) {
     $registered = "1";
     $full_name = $result['first_name'].' '.$result['last_name'];
     $number = $result['phone_number'];
   }
   else{ 
    $registered = "0";
    $full_name = $_POST['name'];
    $number = $_POST['number'];
   }
    require_once "auth/PHPMailer/PHPMailer.php";
    require_once "auth/PHPMailer/Exception.php";
    require_once "auth/PHPMailer/SMTP.php";
    $mail = new PHPMailer(true);
    $mail -> addAddress($authenticator_email,$organization);
    $mail -> setFrom($authenticator_email,$organization);
    $mail->IsSMTP();
    $mail->Host = $mail_host;
    // optional
    // used only when SMTP requires authentication  
    $mail->SMTPAuth = true;
    $mail->Username = $authenticator_email;
    $mail->Password = $authenticator_password;
    $mail -> Subject = $_POST['subject'];
    $mail -> isHTML(true);
    $mail -> Body = $_POST['message'].'<br><br>Customer Name: '.$full_name.'<br><br>Customer Number: '.$number.'<br><br>Customer Email: '.$_POST['email'];
    $mail -> send();
   mysqli_query($connection,"INSERT INTO `site_communication` (`name`, `email`, `number`,`subject`, `message`,`registered_user`) VALUES ('$full_name','".$_POST['email']."','$number','".$_POST["subject"]."','".$_POST["message"]."','$registered')") or die(mysqli_error($connection));
    echo "success";
  }
  else{
    echo "error";
  } 
}
}
elseif ($where == 'site_comment') {
  $name = "";
  if (isset($_POST['home']) && isset($_POST['comment'])) {
	$data = [
		'secret' => $private_key,
		'response' => $_POST['token'],
        'remoteip' => $iptocheck
	];
	$options = array(
		'http' => array(
		 'header' => "Content-type: application/x-www-form-urlencoded\r\n",
		     'method' => 'POST',
		     'content' => http_build_query($data)
		 )
	);
	$context = stream_context_create($options);
	$response = file_get_contents($token_verification_site, false, $context);
	$res = json_decode($response, true);
	if ($res['success'] == 'true' && $res['score'] >= 0.5) {
  $row = mysqli_query($connection,"SELECT * FROM users WHERE id = '".$_POST['commenter']."'")or die($connection->error);
   $result = mysqli_fetch_array($row);
     $registered = "1";
     $name = $result['first_name'].' '.$result['last_name'];
   mysqli_query($connection,"INSERT INTO `comments` (`home_id`,`commenter`,`comment`) VALUES ('".$_POST['home']."','$name','".$_POST['comment']."')") or die(mysqli_error($connection));
    echo "success";
  }
  else{
    echo "error";
  } 
}
}
elseif ($where == 'site_subcomment') {
  $name = "";
  $registered = "";
  if (isset($_POST['email']) && isset($_POST['subcomment'])) {
	$data = [
		'secret' => $private_key,
		'response' => $_POST['token'],
        'remoteip' => $iptocheck
	];
	$options = array(
		'http' => array(
		 'header' => "Content-type: application/x-www-form-urlencoded\r\n",
		     'method' => 'POST',
		     'content' => http_build_query($data)
		 )
	);
	$context = stream_context_create($options);
	$response = file_get_contents($token_verification_site, false, $context);
	$res = json_decode($response, true);
	if ($res['success'] == true && $res['score'] >= 0.5) {
  $row = mysqli_query($connection,"SELECT * FROM users WHERE email = '".$_POST['email']."'")or die($connection->error);
   $result = mysqli_fetch_array($row);
   if ( $result == TRUE) {
     $registered = "1";
     $name = $result['firstname'].' '.$result['lastname'];
   }
   else{ 
    $registered = "0";
    $name = $_POST['name'];
   }
   mysqli_query($connection,"INSERT INTO `comments` (`comment_id`,`commenter`, `registered`, `belongs_to`,`comment`) VALUES ('".$_POST['id']."','$name','$registered','comment','".$_POST['subcomment']."')") or die(mysqli_error($connection));
    echo "success";
  }
  else{
    echo "error";
  } 
}
}

elseif ($where == 'availability') {
    $home_availability = new HomeAvailabilityDetails();
     mysqli_query($connection, $home_availability->AddHomeAvailability($_POST['home_id'], $_POST['start_date'], $_POST['end_date'], $_POST['extra_details'])) or die(mysqli_error($connection));
     echo 'success';
}
 ?>
