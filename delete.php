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


else if($where == 'category' )
{  
	$id =$_POST['id'];
mysqli_query($connection,"Delete from `category` where id='".$id."'")or die($connection->error);
    echo 1;
    exit();
}

else if($where == 'supplier' )
{  
	$id =$_POST['id'];
mysqli_query($connection,"Delete from `suppliers` where id='".$id."'")or die($connection->error);
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
 else if($where == 'cook' )
{  
    $id =$_POST['id'];
mysqli_query($connection,"Delete from `users` where id='".$id."'")or die($connection->error);
    echo 1;
    exit();
 }
  else if($where == 'office' )
{  
    $id =$_POST['id'];
   mysqli_query($connection,"Delete from `users` where id='".$id."'")or die($connection->error);
    echo 1;
    exit();
 }
 else if($where == 'publicNote' )
{  
    $id =$_POST['id'];
   mysqli_query($connection,"Delete from `notes` where id='".$id."'")or die($connection->error);
    echo 1;
    exit();
 }
 else if($where == 'privateNote' )
{  
    $id =$_POST['id'];
   mysqli_query($connection,"Delete from `notes` where id='".$id."'")or die($connection->error);
    echo 1;
    exit();
 }
 else if($where == 'faq' )
{  
    $id =$_POST['id'];
   mysqli_query($connection,"Delete from `faqs` where id='".$id."'")or die($connection->error);
    echo 1;
    exit();
 }
 else if($where == 'blog' )
 {  
     $id =$_POST['id'];
     $row = mysqli_query($connection,"SELECT image FROM blogs WHERE id = '".$id."'")or die($connection->error);
     $result = mysqli_fetch_array($row);
     $path = $result['image'];
    mysqli_query($connection,"Delete from `blogs` where id='".$id."'")or die($connection->error);
    unlink('assets/images/blog/'.$path);
     echo 1;
     exit();
  }
 else if($where == 'expenseHeading' )
{  
    $id =$_POST['id'];
   mysqli_query($connection,"Delete from `expenses` where id='".$id."'")or die($connection->error);
    echo 1;
    exit();
 }
  else if($where == 'expense' )
{  
    $id =$_POST['id'];
   mysqli_query($connection,"Delete from `expense_details` where id='".$id."'")or die($connection->error);
    echo 1;
    exit();
 }
 else if($where == 'calendar' )
{  
   if(isset($_POST["id"]))
{
     $id =$_POST['id'];
   mysqli_query($connection,"DELETE from event WHERE id='$id'")or die($connection->error);
}

 }
?>