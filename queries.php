<?php  
require('config.php');
$customer = new Customer();
$faq = new Faq();
$subscribersList = mysqli_query($connection,"SELECT * FROM newsletter_subscribers ORDER BY id DESC")or die($connection->error);
$faqsList = mysqli_query($connection,$faq->GetAllFaqs())or die($connection->error);
$activeCustomersList = mysqli_query($connection, $customer->GetActiveCustomer())or die($connection->error);
$blacklistedList =  mysqli_query($connection,$customer->GetBlacklistedCustomer())or die($connection->error);
?>

