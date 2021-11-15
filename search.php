<?php  
require('config.php');
if(isset($_POST['search'])){
  $result_output = '';
  $query = "SELECT subcounty FROM subcounties WHERE subcounty LIKE '%".$_POST["search"]."%'";
  $query2 = "SELECT county FROM counties WHERE county LIKE '%".$_POST["search"]."%'";
 /* if($_POST['category'] !== '0'){
    $query .= " AND Category_id = '".$_POST['category']."'";
  }*/
  $result = mysqli_query($connection,$query);
  $result2 = mysqli_query($connection,$query2);
       if (mysqli_num_rows($result) > 0) { 
        while($row = mysqli_fetch_array($result))
        {
          $result_output .= '
          <a href="homes-list.php?location='.$row["subcounty"].'" class="list-group-item list-group-item-action border-1">'.$row["subcounty"].'</a>
          ';
        }                      
       }
       else if(mysqli_num_rows($result2) > 0){
        while($row2 = mysqli_fetch_array($result2))
        {
          $result_output .= '
          <a href="homes-list.php?location='.$row2["county"].'" class="list-group-item list-group-item-action border-1">'.$row2["county"].'</a>
          ';
        }
       }
       else{
        $result_output = '
        <a href="#" class="list-group-item border-1" style="text-decoration:none;color:inherit;">Destination not found</a>
        ';
       }
       echo $result_output;
}

if(isset($_POST['searchSubmit'])){
  $data = $_POST['search'];
  header('location: template/homes-list.php#'.$data);
}

if(isset($_POST['where']))
{
  $result_output = '';
  if($_POST['where'] == 'county')
  {
    $query = "SELECT county FROM counties WHERE county LIKE '%".$_POST["text"]."%'";
    $result = mysqli_query($connection,$query);
    if (mysqli_num_rows($result) > 0) { 
        while($row = mysqli_fetch_array($result))
        {
          $result_output .= '
          <a href="#" id="county" class="list-group-item list-group-item-action border-1">'.$row["county"].'</a>
          ';
        }                      
     }
     else{
      $result_output = '
      <a href="#" class="list-group-item border-1" style="text-decoration:none;color:inherit;">County not found</a>
      ';
     }
     echo $result_output;
  }
  if($_POST['where'] == 'subcounty')
  {
    $query = "SELECT subcounty FROM subcounties INNER JOIN counties ON subcounties.county_id = counties.id WHERE subcounty LIKE '%".$_POST["subcounty"]."%' AND county LIKE '%".$_POST["county"]."%'";
    $result = mysqli_query($connection,$query);
    if (mysqli_num_rows($result) > 0) { 
      while($row = mysqli_fetch_array($result))
      {
        $result_output .= '
        <a href="#" id="subcounty" class="list-group-item list-group-item-action border-1">'.$row["subcounty"].'</a>
        ';
      }                      
   }
   else{
    $result_output = '
    <a href="#" class="list-group-item border-1" style="text-decoration:none;color:inherit;">Sub-County not found</a>
    ';
   }
   echo $result_output;
  }
}

?>