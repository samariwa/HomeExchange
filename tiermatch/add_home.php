<?php
require('../config.php');
require_once "../functions.php";
$where =$_POST['where'];
$home = new Home();
$customer = new Customer();
session_start();
if ($where == 'home'){
   $features = json_decode($_POST['home_features']);
   $home_features = base64_encode(json_encode($features));
   $tier_result = exec("/Library/Frameworks/Python.framework/Versions/3.9/bin/python3 ml.py ".$home_features);
  $fileName = $_FILES['upload']['tmp_name'];
  $sourceProperties = getimagesize($fileName);
  $resizeFileName = time();
  $uploadPath = '../assets/images/homes/'; 
  $fileExt = pathinfo($_FILES['upload']['name'], PATHINFO_EXTENSION);
  $path = $resizeFileName.'.'.$fileExt;
  $fullPath = $uploadPath.$path;
  $imageProcess = '';
  $uploadImageType = $sourceProperties[2];
  $sourceImageWidth = $sourceProperties[0];
  $sourceImageHeight = $sourceProperties[1];
  switch ($uploadImageType){
    case IMAGETYPE_JPEG:
      $resourceType = imagecreatefromjpeg($fileName);
      $imageLayer = resizeHomeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
      imagejpeg($imageLayer,$fullPath);
      $imageProcess = 1;
      break;
    case IMAGETYPE_GIF:
      $resourceType = imagecreatefromgif($fileName);
      $imageLayer =  resizeHomeImage($resourceType, $sourceImageWidth, $sourceImageHeight);
      imagegif($imageLayer,$fullPath);
      $imageProcess = 1;
      break;
    case IMAGETYPE_PNG:
      $resourceType = imagecreatefrompng($fileName);
      $imageLayer =  resizeHomeImage($resourceType, $sourceImageWidth, $sourceImageHeight);
      imagepng($imageLayer,$fullPath);
      $imageProcess = 1;
      break;

    default:
    $imageProcess = 0;
    break;  
  }
  
  if($imageProcess == 1)
  {
    move_uploaded_file($fileName, $fullPath);
  $subcounty_id= mysqli_query($connection,"SELECT id FROM subcounties WHERE subcounty = '".$_POST['subcounty']."'")or die($connection->error);
   $subcounty_result = mysqli_fetch_array($subcounty_id);
    $owner_id= mysqli_query($connection,"SELECT id FROM home_owners WHERE user_id = '".$_POST['user']."'")or die($connection->error);
    $owner_result = mysqli_fetch_array($owner_id);
    $home_owner_id = '';
   if ($owner_result == TRUE) 
   {
      $home_owner_id = $owner_result['id'];
      mysqli_query($connection,$customer->SetExchangePoints($_POST['user'],$initial_exchange_points)) or die(mysqli_error($connection));
   }
   else
   {
    mysqli_query($connection,"INSERT INTO `home_owners` (`user_id`,`exchange_points`) VALUES ('".$_POST['user']."','$initial_exchange_points')") or die(mysqli_error($connection));
    $owner_id= mysqli_query($connection,"SELECT id FROM home_owners WHERE user_id = '".$_POST['user']."'")or die($connection->error);
    $owner_result = mysqli_fetch_array($owner_id);
    $home_owner_id = $owner_result['id'];
   }
   mysqli_query($connection,"INSERT INTO `homes` (`home_owner_id`,`name`, `description`,`home_tier`, `address`,`home_image`) VALUES ('$home_owner_id','".$_POST['title']."','".$_POST['description']."','$tier_result','".$subcounty_result['id']."','$path')") or die(mysqli_error($connection));
   $home_id= mysqli_query($connection,"SELECT id FROM homes WHERE home_owner_id = '$home_owner_id' ORDER BY Created_at  DESC LIMIT 1")or die($connection->error);
   $home_result = mysqli_fetch_array($home_id);
   mysqli_query($connection,$home->AddHomeFeatures($home_result['id'], $features[0], $features[1], $features[2], $features[3], $features[4], $features[5], $_POST['area'], $features[6], $features[7], $features[8], $features[9], $features[10], $features[11], $features[12], $features[13], $features[14], $features[15], $features[16], $features[17] )) or die(mysqli_error($connection));
   echo $home_result['id'];
  } 
}
?>