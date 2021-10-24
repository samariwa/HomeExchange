<?php
 include('../queries.php');
 require('../config.php');
 session_start();
 ?> 
<!doctype html>
<html><head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customers Print</title>
</head><body>
<p align="center"><strong><img src="../assets/images/LOGO.png" height="100" width="150"></strong></p>
<p align="center">Active Customers</p>
  <?php
        $activecustomersrowcount = mysqli_num_rows($activeCustomersList);
      ?>

<p align="center">Total Number: <?php echo $activecustomersrowcount; ?></p>
<?php
$today = date('l, F d, Y h:i A', time());
?>
<hr>
<p> <?php echo $today ?></p>
<hr>
<table  class="table table-striped " style="display:block;overflow-y:scroll;">
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="3%">#</th>
      <th scope="col" width="14%">Name</th>
      <th scope="col" width="12%">Physical Address</th>
      <th scope="col" width="17%">Contact Number</th>
      <th scope="col" width="10%">Email Address</th>
      <th scope="col"width="10%">Exchange Points</th>
    </tr>
  </thead>
  <tbody >
    <?php
        $count = 0;
        foreach($activeCustomersList as $row){
         $count++;
         $id = $row['id'];
         $owner_id= mysqli_query($connection,"SELECT exchange_points FROM home_owners WHERE user_id = '".$row['id']."'")or die($connection->error);
        $owner_result = mysqli_fetch_array($owner_id);
        $points = '';
        if ($owner_result == TRUE) 
        {
            $points = $owner_result['exchange_points'];
        }
        else{
          $points = 0;
        }
         $name = $row['first_name'].' '.$row['other_name'].' '.$row['last_name'];
        $location = $row['physical_address'];
        $number = $row['phone_number'];
        $email = $row['email_address'];
      ?>
    <tr>
      <th scope="row"><?php echo $id; ?></th>
      <td ><?php echo $name; ?></td>
      <td><?php echo $location; ?></td>
      <td><?php echo $number; ?></td>
      <td ><?php echo $email; ?></td>
      <td ><?php echo $points; ?></td>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>
<br>
<p>Prepared by: <?php echo $_SESSION['user']; ?>
</body></html>