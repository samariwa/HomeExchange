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
    <title>Home Owners Print</title>
</head><body>
<p align="center"><strong><img src="../assets/images/LOGO.png" height="100" width="150"></strong></p>
<p align="center">Active Home Owners</p>

<p align="center">Total Number: <?php echo $homeOwnersCount; ?></p>
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
      <th scope="col" width="8%">Phone Number</th>
      <th scope="col"width="10%">Email Address</th>
      <th scope="col" width="13%">Average Rating</th>
      <th scope="col" width="17%">Exchange Points</th>
    </tr>
  </thead>
  <tbody >
    <?php
        $count = 0;
        foreach($homeOwnersList as $row){
          $count++;
          $id = $row['id'];
          $name = $row['first_name'].' '.$row['last_name'];
          $phone_number = $row['phone_number'];
          $email_address = $row['email_address'];
          $exchange_points = $row['exchange_points'];
          $average_rating = $row['average_rating'];
      ?>
    <tr>
      <th scope="row"><?php echo $id; ?></th>
      <td ><?php echo $name; ?></td>
      <td><?php echo $phone_number; ?></td>
      <td><?php echo $email_address; ?></td>
      <td ><?php echo $average_rating; ?></td>
      <td ><?php echo $exchange_points; ?></td>    
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>
<br>
<p>Prepared by: <?php echo $_SESSION['user']; ?>
</body></html>