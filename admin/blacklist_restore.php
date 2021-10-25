<?php  
require('../config.php');
$where =$_POST['where'];
$user = new User();
$home = new Home();
if($where == 'blacklist' )
{  
	$id =$_POST['id'];
    mysqli_query($connection, $user->DeactivateUser($id));
    echo 1;
    exit();
}
else if($where == 'blacklistHome' )
{  
	$id =$_POST['id'];
	 mysqli_query($connection, $home->DeactivateHome($id));
       echo 1;
       exit();
}
else if($where == 'restore' )
{  
	$id =$_POST['id'];
	 mysqli_query($connection, $user->ReactivateUser($id));
       echo 1;
       exit();
}
else if($where == 'restoreHome' )
{  
	$id =$_POST['id'];
	 mysqli_query($connection, $home->ReactivateHome($id));
       echo 1;
       exit();
}
 ?>