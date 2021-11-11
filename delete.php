<?php
require('config.php');
$where =$_POST['where'];
if($where == 'user' )
{  
    $user = new User();
	$id =$_POST['id'];
    mysqli_query($connection, $customer->DeleteUser($id));
    echo 1;
    exit();
}

else if($where == 'home' )
{  
    $home = new Home();
    mysqli_query($connection, $home->DeleteHome($_POST['id']))or die($connection->error);
    echo 1;
    exit();
}

else if($where == 'home_avaliability' )
{  
    $home_availability = new HomeAvailabilityDetails();
    mysqli_query($connection, $home_availability->RemoveHomeAvailability($_POST["id"]))or die($connection->error);
    echo 1;
    exit();
}


else if($where == 'delete_request' )
{  
    $request = new HomeExchangeRequest();
    mysqli_query($connection,$request->CancelExchangeRequest($_POST['id']))or die($connection->error);
    echo 1;
    exit();
}

elseif ($where == 'cancel_availability') {
    mysqli_query($connection,"DELETE FROM `home_availability` WHERE `id` = '".$_POST['availability_id']."'") or die(mysqli_error($connection));
    echo 'success';
  }
  elseif ($where == 'delete_home') {
    mysqli_query($connection,"DELETE FROM `homes` WHERE `id` = '".$_POST['id']."'") or die(mysqli_error($connection));
    echo 'success';
  }
 else if($where == 'remove_image' )
{   
    mysqli_query($connection,"Delete from `images` where id='".$_POST['id']."'")or die($connection->error);
    exit();
 }

 else if($where == 'faq' )
{  
    $id =$_POST['id'];
   mysqli_query($connection,"Delete from `faqs` where id='".$id."'")or die($connection->error);
    echo 1;
    exit();
 }


?>