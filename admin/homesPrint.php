<?php
 include('../queries.php');
 session_start();
 ?> 
<!doctype html>
<html><head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Homes Print</title>
</head><body>
<p align="center"><strong><img src="../assets/images/LOGO.png" height="100" width="150"></strong></p>
<p align="center">Active Homes</p>
<p align="center">Total Number: <?php echo $activeHomesCount; ?></p>
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
      <th scope="col" width="14%">Home Owner</th>
      <th scope="col" width="14%">Name</th>
      <th scope="col" width="12%">Location</th>
      <th scope="col" width="17%">Rating</th>
      <th scope="col" width="10%">Tier</th>
      <th scope="col"width="10%">Extra Details</th>
    </tr>
  </thead>
  <tbody >
    <?php
        $count = 0;
        foreach($activeHomesList as $row){
          $count++;
          $id = $row['home_id'];
          $owner_name = $row['first_name'].' '.$row['last_name'];
          $name = $row['name'];
         $location = $row['county'].', '.$row['subcounty'];
         $rating = $row['average_rating'];
         $tier = $row['home_tier'];
         $extra_details = $row['home_extra_details'];
      ?>
    <tr>
      <th scope="row"><?php echo $id; ?></th>
      <td ><?php echo $owner_name; ?></td>
      <td><?php echo $name; ?></td>
      <td><?php echo $location; ?></td>
      <td ><?php echo  $rating; ?></td>
      <td ><?php echo $tier; ?></td>
      <td><?php echo $extra_details; ?></td>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>
<br>
<p>Prepared by: <?php echo $_SESSION['user']; ?>
</body></html>