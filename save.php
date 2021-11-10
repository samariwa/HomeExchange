<?php
require('config.php');
require_once "functions.php";
session_start();
$view = $_SESSION['role'];
$where =$_POST['where'];
$customer = new Customer();
if ($where == 'customer' ) {
	$id = $_POST['id'];
   $location = $_POST['location'];
   $number = $_POST['number'];
   $email = $_POST['email'];
   $note = $_POST['note'];
	mysqli_query($connection,"UPDATE `users` SET `physical_address` = '".$location."',`phone_number` = '".$number."',`email_address` = '".$email."' WHERE `id` = '".$id."'")or die($connection->error);
}
elseif( $where == 'admin'){
   $id = $_POST['id'];
   $email = $_POST['email'];
   $number = $_POST['number'];
mysqli_query($connection,"UPDATE `users` SET `phone_number` = '".$number."',email_address = '".$email."'  WHERE  id = '".$id."'")or die($connection->error);
}
elseif ($where == 'blacklist') {
	$id = $_POST['id'];
    $location = $_POST['location'];
    $number = $_POST['number'];
    $email = $_POST['email'];
mysqli_query($connection,"UPDATE `users` SET `physical_address` = '".$location."',`phone_number` = '".$number."',`email_address` = '".$email."' WHERE id = '".$id."'")or die($connection->error);
}

elseif ($where == 'faq') {
  $id = $_POST['id'];
    $question = $_POST['question'];
     $answer = $_POST['answer'];
mysqli_query($connection,"UPDATE `faqs` SET `question` = '".$question."',`answer` = '".$answer."' WHERE `id` = '".$id."'")or die($connection->error);
}

elseif ($where == 'profile') {
  $staffid = $_POST['staffid'];
    $username = $_POST['username'];
     $email = $_POST['email'];
     $number = $_POST['number'];
     $nationalid = $_POST['nationalid'];
mysqli_query($connection,"UPDATE `users` SET `username` = '".$username."',`email` = '".$email."',`number` = '".$number."',`nationalID` = '".$nationalid."' WHERE `staffID` = '".$staffid."'")or die($connection->error);
unset($_SESSION['user']);
$_SESSION['user'] = $username;
echo "saved";
}

elseif ($where == 'edit_availability') {
  $home_availability = new HomeAvailabilityDetails();

  mysqli_query($connection, $home_availability->UpdateHomeAvailability($_POST['id'], $_POST['start'], $_POST['end'], $_POST['extra_details'])) or die(mysqli_error($connection));
  echo 'success';
}

elseif ($where == 'edit_home') {
  $home = new Home();
  mysqli_query($connection, $home->UpdateHomeDetails($_POST['id'], $_POST['name'], $_POST['description'])) or die(mysqli_error($connection));
  echo 'success';
}

elseif ($where == 'customerProfile') {
  if (isset($_POST['email']) && isset($_POST['mobile']) && isset($_POST['firstname']) && isset($_POST['othername']) && isset($_POST['lastname']) && isset($_POST['location'])) {
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
  $fullname = $_POST['firstname'].' '.$_POST['lastname'];
$result2 = mysqli_query($connection,"SELECT email_address,phone_number FROM users where email_address = '".$_POST['old_email']."'")or die($connection->error);
$row2 = mysqli_fetch_array($result2);
$result3 = mysqli_query($connection,"SELECT EXISTS(SELECT email_address,phone_number from users  WHERE email_address = '".$_POST['email']."' OR phone_number = '".$_POST['mobile']."')")or die($connection->error);
$row3 = mysqli_fetch_array($result3);
if ($row3[0] == 1 && $_POST['mobile'] !== $row2['phone_number'] && $_POST['email'] !== $row2['email_address']) {
    echo "exists";
}
else{
mysqli_query($connection,"UPDATE `users`  SET `first_name` = '".$_POST['firstname']."',`other_name` = '".$_POST['othername']."',`last_name` = '".$_POST['lastname']."', `email_address` = '".$_POST['email']."',`phone_number` = '".$_POST['mobile']."' WHERE `phone_number` = '".$row2['phone_number']."'") or die(mysqli_error($connection));
echo "success";
unset($_SESSION['user']);
unset($_SESSION['email']);
$_SESSION['user'] = $_POST['firstname'];
$_SESSION['email'] = $_POST['email'];
}
}
else{
  echo "error";
} 
}
}

elseif($where == 'request')
{
  $request = new HomeExchangeRequest();
   if($_POST['action'] == 'accept')
   {
     $points = ExchangePoints($_POST['source'], $unit_of_exchange, $_POST['target']);
     mysqli_query($connection,$request->AcceptExchangeRequest($_POST['id'],$_POST['availability'])) or die(mysqli_error($connection));
     if($points < 0)
     {
      mysqli_query($connection,"UPDATE home_owners set exchange_points = exchange_points - $points WHERE id = '".$_POST['my_id']."'") or die(mysqli_error($connection));
      mysqli_query($connection,"UPDATE home_owners set exchange_points = exchange_points + $points WHERE id = '".$_POST['requester_id']."'") or die(mysqli_error($connection));
     }
     elseif($points > 0)
     {
      mysqli_query($connection,"UPDATE home_owners set exchange_points = exchange_points + $points WHERE id = '".$_POST['my_id']."'") or die(mysqli_error($connection));
      mysqli_query($connection,"UPDATE home_owners set exchange_points = exchange_points - $points WHERE id = '".$_POST['requester_id']."'") or die(mysqli_error($connection));
     }
     echo "1";
   }
   elseif($_POST['action'] == 'decline')
   {
    mysqli_query($connection,$request->DeclineExchangeRequest($_POST['id'])) or die(mysqli_error($connection));
    echo "1";
   }
   elseif($_POST['action'] == 'decline_all')
   {
    mysqli_query($connection,"UPDATE home_exchange_request INNER JOIN home_availability ON home_exchange_request.availability_id = home_availability.id INNER JOIN homes ON home_availability.home_id = homes.id INNER JOIN home_owners ON home_owners.id = homes.home_owner_id set request_response = '2' WHERE request_response = '0' AND home_owners.id = '".$_POST['my_id']."'") or die(mysqli_error($connection));
    echo "1";
   }
}
 ?>
