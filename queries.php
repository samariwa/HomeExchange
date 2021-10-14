<?php  
require('config.php');
$subscribersList = mysqli_query($connection,"SELECT * FROM newsletter_subscribers ORDER BY id DESC")or die($connection->error);
$customersList = mysqli_query($connection,"SELECT id, first_name, physical_address,phone_number,email_address FROM users WHERE user_status != '0' AND role_id = '2' ORDER BY id DESC")or die($connection->error);
$faqsList = mysqli_query($connection,"SELECT * FROM faqs ")or die($connection->error);
?>

