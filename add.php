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
	   $user->create($connection, array('role_id' => '1','first_name' => $firstname,'other_name' => $othername,'last_name' => $lastname,'phone_number' => $number,'email_address' => $email,'password' => $hash, 'user_status' => '0')) or die(mysqli_error($connection));
   }
}
elseif($where == 'stock'){
       $unit = $_POST['unit'];
       $result2 = mysqli_query($connection,"SELECT Name FROM inventory_units WHERE id = '".$unit."';")or die($connection->error);
       $row2 = mysqli_fetch_array($result2);
       $unit_name = $row2['Name'];
       $raw_name = $_POST['name'];
       $raw_name2 = str_replace('  ',' ',$raw_name);
       $raw_name3 = ltrim($raw_name2,' ');
       $raw_name4 = rtrim($raw_name3,' ');
       $name = $raw_name4.' '.$unit_name;
       $category = $_POST['category'];
       $supplier = $_POST['supplier'];
       $received = $_POST['received'];
       $expiry = $_POST['expiry'];
       $fileName = $_FILES['upload']['name'];
       $path = time().'.png';
       move_uploaded_file($_FILES['upload']['tmp_name'], 'assets/images/products/'.$path);
       $bp = $_POST['bp'];
       $sp = $_POST['sp'];
       $qty = $_POST['qty'];
       $contains = $_POST['contains'];
       $subunit = $_POST['subunit'];
       $replenish = '';
       if(isset($_POST['replenish']))
       {
       $replenish = $_POST['replenish'];
       }
       else{
         $replenish = '0';
       }
       $restock = $_POST['restock'];
       $row = mysqli_query($connection,"SELECT `Name` FROM stock WHERE Name = '".$name."'")or die($connection->error);
       $result = mysqli_fetch_array($row);
       if ( $result == TRUE) {
         echo "exists";
       }
       else{
         echo "success";
          mysqli_query($connection,"INSERT INTO `stock` (`Category_id`,`Supplier_id`,`Name`,`Unit_id`,`Subunit_id`,`Contains`,`subunit_replenish_qty`,`Restock_Level`,`Buying_price`,`Price`,`Quantity`,`Opening_stock`,`image`) VALUES ('$category','$supplier','$name','$unit','$subunit','$contains','$replenish','$restock','$bp','$sp','$qty','$qty','$path');") or die(mysqli_error($connection));
        $result1 = mysqli_query($connection,"SELECT * FROM stock WHERE Name = '".$name."';")or die($connection->error);
       $row1 = mysqli_fetch_array($result1);
       $Stock_id = $row1['id'];
        mysqli_query($connection,"INSERT INTO `stock_flow` (`Stock_id`,`Expiry_date`,`Buying_price`,`Selling_Price`,`Received_date`,`Purchased`) VALUES ('$Stock_id','$expiry','$bp','$sp','$received','$qty')") or die(mysqli_error($connection));
       }

}
else if ($where == 'categories') {
   $category = $_POST['category'];
   $row = mysqli_query($connection,"SELECT * FROM category WHERE Category_Name = '".$category."'")or die($connection->error);
   $result = mysqli_fetch_array($row);
   if ( $result == TRUE) {
     echo "exists";
   }
   else{
    echo "success";
    mysqli_query($connection,"INSERT INTO `category` (`Category_Name`) VALUES ('$category')") or die(mysqli_error($connection));
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
else if ($where == 'blog') {
  $title = $_POST['title'];
  $blog = $_POST['blog_text'];
  $fileName = $_FILES['upload']['tmp_name'];
  $sourceProperties = getimagesize($fileName);
  $resizeFileName = time();
  $uploadPath = 'assets/images/blog/'; 
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
    move_uploaded_file($file, $fullPath);
  $row = mysqli_query($connection,"SELECT * FROM blogs WHERE blog = '".$blog."'")or die($connection->error);
  $result = mysqli_fetch_array($row);
  if ( $result == TRUE) {
    echo "exists";
  }
  else{
   echo "success";
   mysqli_query($connection,"INSERT INTO `blogs` (`title`,`blog`,`image`) VALUES ('$title','$blog','$path')") or die(mysqli_error($connection));
  }
  } 
}
else if ($where == 'units') {
   $unit = $_POST['unit'];
   $row = mysqli_query($connection,"SELECT * FROM inventory_units WHERE Name = '".$unit."'")or die($connection->error);
   $result = mysqli_fetch_array($row);
   if ( $result == TRUE) {
     echo "exists";
   }
   else{
    echo "success";
    mysqli_query($connection,"INSERT INTO `inventory_units` (`Name`) VALUES ('$unit')") or die(mysqli_error($connection));
   }
} 

else if ($where == 'supplier') {
   $name = $_POST['name'];
   $contact = $_POST['contact'];
   $row = mysqli_query($connection,"SELECT * FROM suppliers WHERE Name = '".$name."' OR Supplier_contact = '".$contact."'")or die($connection->error);
   $result = mysqli_fetch_array($row);
   if ( $result == TRUE) {
     echo "exists";
   }
   else{
    echo "success";
    mysqli_query($connection,"INSERT INTO `suppliers` (`Name`,`Supplier_contact`) VALUES ('$name','$contact')") or die(mysqli_error($connection));
   }
}
else if ($where == 'vehicles') {
   $type = $_POST['type'];
   $driver = $_POST['driver'];
   $reg = $_POST['reg'];
   $route = $_POST['route'];
   $row0 = mysqli_query($connection,"SELECT `id` FROM users WHERE firstname = '".$driver."'")or die($connection->error);
   $result0 = mysqli_fetch_array($row0);
   $id = $result0['id'];
   $row = mysqli_query($connection,"SELECT * FROM vehicles WHERE Reg_Number = '".$reg."'")or die($connection->error);
   $result = mysqli_fetch_array($row);
   if ( $result == TRUE) {
     echo "exists";
   }
   else{
     echo "success";
    mysqli_query($connection,"INSERT INTO `vehicles` (`Driver_id`,`Type`,`Reg_Number`,`Route`) VALUES ('$id','$type','$reg','$route')") or die(mysqli_error($connection));
   }
}
else if ($where == 'deliverer') {
     $fname = $_POST['fname'];
     $lname = $_POST['lname'];
     $contact = $_POST['contact'];
     $staffId = $_POST['staffId'];
     $nationalId = $_POST['nationalId'];
     $yob = $_POST['yob'];
     $gender = $_POST['gender'];
     $salary = $_POST['salary'];
     $role = '5';
     $row = mysqli_query($connection,"SELECT * FROM users WHERE nationalID = '".$nationalId."' or staffID = '".$staffId."'")or die($connection->error);
     $result = mysqli_fetch_array($row);
     if ( $result == TRUE) {
       echo "exists";
     }
     else{
      echo "success";
      mysqli_query($connection,"INSERT INTO `users` (`firstname`,`lastname`,`number`,`Job_Id`,`staffID`,`nationalID`,`yob`,`gender`,`salary`) VALUES ('$fname','$lname','$contact','$role','$staffId','$nationalId','$yob','$gender','$salary')") or die(mysqli_error($connection));
     }
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

else if ($where == 'note') {
     $title = $_POST['title'];
     $message = $_POST['message'];
     $access = $_POST['access'];
     $user = $_SESSION['user'];
      echo "success";
     $row = mysqli_query($connection,"SELECT id FROM users WHERE username = '".$user."'")or die($connection->error);
     $result = mysqli_fetch_array($row);
     $id = $result['id'];
      mysqli_query($connection,"INSERT INTO `notes` (`User_id`,`Title`,`Note`,`Public`) VALUES ('$id','$title','$message','$access')") or die(mysqli_error($connection));
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


elseif ($where == 'files') {
  $name = $_POST['name'];
  $description = $_POST['description'];
  $upload = $_POST['upload'];
  $location = $_POST['location'];
  $owner = $_SESSION['user'];
  $owner_id= mysqli_query($connection,"SELECT staffID FROM users WHERE username = '".$owner."'")or die($connection->error);
    $uploader_id = mysqli_fetch_array($owner_id);
     $uploader = $uploader_id['staffID'];
      $exists= mysqli_query($connection,"SELECT *  FROM files WHERE file_name = '".$name."'")or die($connection->error);
      $exists_result = mysqli_fetch_array($exists);
       if ($exists_result == TRUE) {
       $exists_number = mysqli_query($connection,"SELECT COUNT(id) AS NumberOfFiles FROM files WHERE file_name = '".$name."'")or die($connection->error);
      $exists_value = mysqli_fetch_array($exists_number);
      $exists_count = $exists_value['NumberOfFiles'];
     $total_count = $exists_count + 1;
     $name = $name."(".$total_count.")";
     }
    $random = generateRandomString();
    $save = mysqli_query($connection,"INSERT INTO `files` (`folder_serial`,`file_serial`,`file_name`,`description`,`file_owner_id`) VALUES ('$location','$random','$name','$description','$uploader')") or die(mysqli_error($connection));
        $save = $this->db->query("INSERT INTO folders set ".$data);
        if($save){
         echo "success";
      }
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
