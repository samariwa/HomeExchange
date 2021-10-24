<?php  
require('config.php');
$customer = new Customer();
$faq = new Faq();
$role = new Role();
$admin = new Administrator();
$home = new Home();
$exchange = new HomeExchangeRequest();
$subscribersList = mysqli_query($connection,"SELECT * FROM newsletter_subscribers ORDER BY id DESC")or die($connection->error);
$faqsList = mysqli_query($connection,$faq->GetAllFaqs())or die($connection->error);
$activeCustomersList = mysqli_query($connection, $customer->GetActiveCustomer())or die($connection->error);
$activeCustomersCount = mysqli_num_rows($activeCustomersList);
$blacklistedList =  mysqli_query($connection,$customer->GetBlacklistedCustomer())or die($connection->error);
$blacklistedCount = mysqli_num_rows($blacklistedList);
$activeRoles = mysqli_query($connection,$role->GetActiveRoles())or die($connection->error);
$activeRolesCount = mysqli_num_rows($activeRoles);
$activeAdminsList = mysqli_query($connection, $admin->GetActiveAdmins())or die($connection->error);
$activeAdminsCount = mysqli_num_rows($activeAdminsList);
$activeHomesList = mysqli_query($connection, $home->GetActiveHomes())or die($connection->error);
$activeHomesCount = mysqli_num_rows($activeHomesList);
$deactivatedHomesList =  mysqli_query($connection,$home->GetDeactivatedHomes())or die($connection->error);
$deactivatedHomesCount = mysqli_num_rows($deactivatedHomesList);
$acceptedExchangeRequests = mysqli_query($connection,$exchange->GetExchanges())or die($connection->error);
$acceptedExchangeCount = mysqli_num_rows($acceptedExchangeRequests);
$countyList = mysqli_query($connection,"SELECT county from counties")or die($connection->error);
$homeOwnersList = mysqli_query($connection,"SELECT home_owners.id as id,first_name,last_name,phone_number,email_address,average_rating,exchange_points from home_owners INNER JOIN users ON home_owners.user_id = users.id")or die($connection->error);
$homeOwnersCount = mysqli_num_rows($homeOwnersList);
?>

