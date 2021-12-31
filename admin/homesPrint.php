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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
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
<table  class="table table-striped" style="display:block;overflow-y:scroll;">
  <thead class="thead-dark">
    <tr>
      <th class="text-center" scope="col" width="3%">#</th>
      <th class="text-center" scope="col" width="14%">Home Owner</th>
      <th class="text-center" scope="col" width="14%">Name</th>
      <th class="text-center" scope="col" width="12%">Location</th>
      <th class="text-center" scope="col" width="17%">Rating</th>
      <th class="text-center" scope="col" width="10%">Tier</th>
      <th class="text-center" scope="col"width="10%">Extra Details</th>
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
      <th scope="row" class="text-center"><?php echo $id; ?></th>
      <td class="text-center"><?php echo $owner_name; ?></td>
      <td class="text-center"><?php echo $name; ?></td>
      <td class="text-center"><?php echo $location; ?></td>
      <td class="text-center"><?php echo  $rating; ?></td>
      <td class="text-center"><?php echo $tier; ?></td>
      <td class="text-center"><?php echo $extra_details; ?></td>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>
<br>
<p>Prepared by: <?php echo $_SESSION['user']; ?>
</body></html>