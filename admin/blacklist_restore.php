<?php  
require('../config.php');
$where =$_POST['where'];
$customer = new Customer();
if($where == 'blacklist' )
{  
	$id =$_POST['id'];
    mysqli_query($connection, $customer->BlacklistCustomer($id));
    echo 1;
    exit();
}
else if($where == 'restore' )
{  
	$id =$_POST['id'];
	 mysqli_query($connection, $customer->RestoreCustomer($id));
       echo 1;
       exit();
}
 ?>