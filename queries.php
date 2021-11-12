<?php  
require('config.php');
$customer = new Customer();
$faq = new Faq();
$role = new Role();
$admin = new Administrator();
$home = new Home();
$exchange = new HomeExchangeRequest();
$subscribersList = mysqli_query($connection,"SELECT * FROM newsletter_subscribers ORDER BY id DESC")or die($connection->error);
$feedbackList = mysqli_query($connection,"SELECT customer_feedback.id as id,first_name, last_name, message FROM customer_feedback INNER JOIN users on customer_feedback.user_id = users.id")or die($connection->error);
$feedbackCount = mysqli_num_rows($feedbackList );
$faqsList = mysqli_query($connection,$faq->GetAllFaqs())or die($connection->error);
$activeCustomersList = mysqli_query($connection, $customer->GetActiveCustomer())or die($connection->error);
$activeCustomersCount = mysqli_num_rows($activeCustomersList);
$blacklistedList =  mysqli_query($connection,$customer->GetBlacklistedCustomer())or die($connection->error);
$blacklistedCount = mysqli_num_rows($blacklistedList);
$activeRoles = mysqli_query($connection,$role->GetActiveRoles())or die($connection->error);
$activeRolesCount = mysqli_num_rows($activeRoles);
$activeAdminsList = mysqli_query($connection, $admin->GetActiveAdmins())or die($connection->error);
$activeAdminsCount = mysqli_num_rows($activeAdminsList);
$deactivatedAdminsList = mysqli_query($connection, $admin->GetDeactivatedAdmins())or die($connection->error);
$deactivatedAdminsCount = mysqli_num_rows($deactivatedAdminsList);
$activeHomesList = mysqli_query($connection, $home->GetActiveHomes())or die($connection->error);
$activeHomesCount = mysqli_num_rows($activeHomesList);
$availableHomesList =  mysqli_query($connection,$home->GetAvailableHomes())or die($connection->error);
$availableHomesCount =  mysqli_num_rows($availableHomesList);
$deactivatedHomesList =  mysqli_query($connection,$home->GetDeactivatedHomes())or die($connection->error);
$deactivatedHomesCount = mysqli_num_rows($deactivatedHomesList);
$acceptedExchangeRequests = mysqli_query($connection,$exchange->GetExchanges())or die($connection->error);
$acceptedExchangeCount = mysqli_num_rows($acceptedExchangeRequests);
$countyList = mysqli_query($connection,"SELECT id, county from counties")or die($connection->error);
$homeOwnersList = mysqli_query($connection,"SELECT home_owners.id as id,first_name,last_name,phone_number,email_address,average_rating,exchange_points from home_owners INNER JOIN users ON home_owners.user_id = users.id")or die($connection->error);
$homeOwnersCount = mysqli_num_rows($homeOwnersList);
$signupsWk1 = mysqli_query($connection,"SELECT COALESCE(COUNT(id),0) AS 'sum' FROM users where DATE(Created_at) >= DATE_SUB( CURDATE(), INTERVAL 1 MONTH ) and DATE(Created_at) < DATE_SUB( CURDATE(), INTERVAL 3 WEEK )")or die($connection->error);
$signupsWk2 = mysqli_query($connection,"SELECT COALESCE(COUNT(id),0) AS 'sum' FROM users where DATE(Created_at) >= DATE_SUB( CURDATE(), INTERVAL 3 WEEK ) and DATE(Created_at) < DATE_SUB( CURDATE(), INTERVAL 2 WEEK )")or die($connection->error);
$signupsWk3 = mysqli_query($connection,"SELECT COALESCE(COUNT(id),0) AS 'sum' FROM users where DATE(Created_at) >= DATE_SUB( CURDATE(), INTERVAL 2 WEEK ) and DATE(Created_at) < DATE_SUB( CURDATE(), INTERVAL 1 WEEK )")or die($connection->error);
$signupsWk4 = mysqli_query($connection,"SELECT COALESCE(COUNT(id),0) AS 'sum' FROM users where DATE(Created_at) >= DATE_SUB( CURDATE(), INTERVAL 1 WEEK ) and DATE(Created_at) <= DATE_SUB( CURDATE(), INTERVAL 0 DAY )")or die($connection->error);
$newHomesWk1 = mysqli_query($connection,"SELECT COALESCE(COUNT(id),0) AS 'sum' FROM homes where DATE(Created_at) >= DATE_SUB( CURDATE(), INTERVAL 1 MONTH ) and DATE(Created_at) < DATE_SUB( CURDATE(), INTERVAL 3 WEEK )")or die($connection->error);
$newHomesWk2 = mysqli_query($connection,"SELECT COALESCE(COUNT(id),0) AS 'sum' FROM homes where DATE(Created_at) >= DATE_SUB( CURDATE(), INTERVAL 3 WEEK ) and DATE(Created_at) < DATE_SUB( CURDATE(), INTERVAL 2 WEEK )")or die($connection->error);
$newHomesWk3 = mysqli_query($connection,"SELECT COALESCE(COUNT(id),0) AS 'sum' FROM homes where DATE(Created_at) >= DATE_SUB( CURDATE(), INTERVAL 2 WEEK ) and DATE(Created_at) < DATE_SUB( CURDATE(), INTERVAL 1 WEEK )")or die($connection->error);
$newHomesWk4 = mysqli_query($connection,"SELECT COALESCE(COUNT(id),0) AS 'sum' FROM homes where DATE(Created_at) >= DATE_SUB( CURDATE(), INTERVAL 1 WEEK ) and DATE(Created_at) <= DATE_SUB( CURDATE(), INTERVAL 0 DAY )")or die($connection->error);
$newHomeOwnersWk1 = mysqli_query($connection,"SELECT COALESCE(COUNT(id),0) AS 'sum' FROM home_owners where DATE(Created_at) >= DATE_SUB( CURDATE(), INTERVAL 1 MONTH ) and DATE(Created_at) < DATE_SUB( CURDATE(), INTERVAL 3 WEEK )")or die($connection->error);
$newHomeOwnersWk2 = mysqli_query($connection,"SELECT COALESCE(COUNT(id),0) AS 'sum' FROM home_owners where DATE(Created_at) >= DATE_SUB( CURDATE(), INTERVAL 3 WEEK ) and DATE(Created_at) < DATE_SUB( CURDATE(), INTERVAL 2 WEEK )")or die($connection->error);
$newHomeOwnersWk3 = mysqli_query($connection,"SELECT COALESCE(COUNT(id),0) AS 'sum' FROM home_owners where DATE(Created_at) >= DATE_SUB( CURDATE(), INTERVAL 2 WEEK ) and DATE(Created_at) < DATE_SUB( CURDATE(), INTERVAL 1 WEEK )")or die($connection->error);
$newHomeOwnersWk4 = mysqli_query($connection,"SELECT COALESCE(COUNT(id),0) AS 'sum' FROM home_owners where DATE(Created_at) >= DATE_SUB( CURDATE(), INTERVAL 1 WEEK ) and DATE(Created_at) <= DATE_SUB( CURDATE(), INTERVAL 0 DAY )")or die($connection->error);
$availabilitiesWk1 = mysqli_query($connection,"SELECT COALESCE(COUNT(id),0) AS 'sum' FROM home_owners where DATE(Created_at) >= DATE_SUB( CURDATE(), INTERVAL 1 MONTH ) and DATE(Created_at) < DATE_SUB( CURDATE(), INTERVAL 3 WEEK )")or die($connection->error);
$availabilitiesWk2 = mysqli_query($connection,"SELECT COALESCE(COUNT(id),0) AS 'sum' FROM home_owners where DATE(Created_at) >= DATE_SUB( CURDATE(), INTERVAL 3 WEEK ) and DATE(Created_at) < DATE_SUB( CURDATE(), INTERVAL 2 WEEK )")or die($connection->error);
$availabilitiesWk3 = mysqli_query($connection,"SELECT COALESCE(COUNT(id),0) AS 'sum' FROM home_owners where DATE(Created_at) >= DATE_SUB( CURDATE(), INTERVAL 2 WEEK ) and DATE(Created_at) < DATE_SUB( CURDATE(), INTERVAL 1 WEEK )")or die($connection->error);
$availabilitiesWk4 = mysqli_query($connection,"SELECT COALESCE(COUNT(id),0) AS 'sum' FROM home_owners where DATE(Created_at) >= DATE_SUB( CURDATE(), INTERVAL 1 WEEK ) and DATE(Created_at) <= DATE_SUB( CURDATE(), INTERVAL 0 DAY )")or die($connection->error);
$requestsWk1 = mysqli_query($connection,"SELECT COALESCE(COUNT(id),0) AS 'sum' FROM home_exchange_request where DATE(Created_at) >= DATE_SUB( CURDATE(), INTERVAL 1 MONTH ) and DATE(Created_at) < DATE_SUB( CURDATE(), INTERVAL 3 WEEK )")or die($connection->error);
$requestsWk2 = mysqli_query($connection,"SELECT COALESCE(COUNT(id),0) AS 'sum' FROM home_exchange_request where DATE(Created_at) >= DATE_SUB( CURDATE(), INTERVAL 3 WEEK ) and DATE(Created_at) < DATE_SUB( CURDATE(), INTERVAL 2 WEEK )")or die($connection->error);
$requestsWk3 = mysqli_query($connection,"SELECT COALESCE(COUNT(id),0) AS 'sum' FROM home_exchange_request where DATE(Created_at) >= DATE_SUB( CURDATE(), INTERVAL 2 WEEK ) and DATE(Created_at) < DATE_SUB( CURDATE(), INTERVAL 1 WEEK )")or die($connection->error);
$requestsWk4 = mysqli_query($connection,"SELECT COALESCE(COUNT(id),0) AS 'sum' FROM home_exchange_request where DATE(Created_at) >= DATE_SUB( CURDATE(), INTERVAL 1 WEEK ) and DATE(Created_at) <= DATE_SUB( CURDATE(), INTERVAL 0 DAY )")or die($connection->error);
$exchangesWk1 = mysqli_query($connection,"SELECT COALESCE(COUNT(id),0) AS 'sum' FROM home_exchange_request where DATE(Created_at) >= DATE_SUB( CURDATE(), INTERVAL 1 MONTH ) and DATE(Created_at) < DATE_SUB( CURDATE(), INTERVAL 3 WEEK ) AND request_response = '1'")or die($connection->error);
$exchangesWk2 = mysqli_query($connection,"SELECT COALESCE(COUNT(id),0) AS 'sum' FROM home_exchange_request where DATE(Created_at) >= DATE_SUB( CURDATE(), INTERVAL 3 WEEK ) and DATE(Created_at) < DATE_SUB( CURDATE(), INTERVAL 2 WEEK ) AND request_response = '1'")or die($connection->error);
$exchangesWk3 = mysqli_query($connection,"SELECT COALESCE(COUNT(id),0) AS 'sum' FROM home_exchange_request where DATE(Created_at) >= DATE_SUB( CURDATE(), INTERVAL 2 WEEK ) and DATE(Created_at) < DATE_SUB( CURDATE(), INTERVAL 1 WEEK ) AND request_response = '1'")or die($connection->error);
$exchangesWk4 = mysqli_query($connection,"SELECT COALESCE(COUNT(id),0) AS 'sum' FROM home_exchange_request where DATE(Created_at) >= DATE_SUB( CURDATE(), INTERVAL 1 WEEK ) and DATE(Created_at) <= DATE_SUB( CURDATE(), INTERVAL 0 DAY ) AND request_response = '1'")or die($connection->error);
$exchangesMonth1 = mysqli_query($connection,"SELECT COALESCE(COUNT(id),0) AS 'sum' FROM home_exchange_request where DATE(Created_at) >= DATE_SUB( CURDATE(), INTERVAL 4 MONTH ) and DATE(Created_at) < DATE_SUB( CURDATE(), INTERVAL 3 MONTH ) AND request_response = '1'")or die($connection->error);
$exchangesMonth2 = mysqli_query($connection,"SELECT COALESCE(COUNT(id),0) AS 'sum' FROM home_exchange_request where DATE(Created_at) >= DATE_SUB( CURDATE(), INTERVAL 3 MONTH ) and DATE(Created_at) < DATE_SUB( CURDATE(), INTERVAL 2 MONTH ) AND request_response = '1'")or die($connection->error);
$exchangesMonth3 = mysqli_query($connection,"SELECT COALESCE(COUNT(id),0) AS 'sum' FROM home_exchange_request where DATE(Created_at) >= DATE_SUB( CURDATE(), INTERVAL 2 MONTH ) and DATE(Created_at) < DATE_SUB( CURDATE(), INTERVAL 1 MONTH ) AND request_response = '1'")or die($connection->error);
$exchangesMonth4 = mysqli_query($connection,"SELECT COALESCE(COUNT(id),0) AS 'sum' FROM home_exchange_request where DATE(Created_at) >= DATE_SUB( CURDATE(), INTERVAL 1 MONTH ) and DATE(Created_at) <= DATE_SUB( CURDATE(), INTERVAL 0 DAY ) AND request_response = '1'")or die($connection->error);
$subscribersWk1 = mysqli_query($connection,"SELECT COALESCE(COUNT(id),0) AS 'sum' FROM newsletter_subscribers where DATE(Created_at) >= DATE_SUB( CURDATE(), INTERVAL 1 MONTH ) and DATE(Created_at) < DATE_SUB( CURDATE(), INTERVAL 3 WEEK )")or die($connection->error);
$subscribersWk2 = mysqli_query($connection,"SELECT COALESCE(COUNT(id),0) AS 'sum' FROM newsletter_subscribers where DATE(Created_at) >= DATE_SUB( CURDATE(), INTERVAL 3 WEEK ) and DATE(Created_at) < DATE_SUB( CURDATE(), INTERVAL 2 WEEK )")or die($connection->error);
$subscribersWk3 = mysqli_query($connection,"SELECT COALESCE(COUNT(id),0) AS 'sum' FROM newsletter_subscribers where DATE(Created_at) >= DATE_SUB( CURDATE(), INTERVAL 2 WEEK ) and DATE(Created_at) < DATE_SUB( CURDATE(), INTERVAL 1 WEEK )")or die($connection->error);
$subscribersWk4 = mysqli_query($connection,"SELECT COALESCE(COUNT(id),0) AS 'sum' FROM newsletter_subscribers where DATE(Created_at) >= DATE_SUB( CURDATE(), INTERVAL 1 WEEK ) and DATE(Created_at) <= DATE_SUB( CURDATE(), INTERVAL 0 DAY )")or die($connection->error);
$tier1number = mysqli_query($connection,"SELECT COALESCE(COUNT(id),0) AS 'sum' FROM homes where home_tier = '1'")or die($connection->error);
$tier2number = mysqli_query($connection,"SELECT COALESCE(COUNT(id),0) AS 'sum' FROM homes where home_tier = '2'")or die($connection->error);
$tier3number = mysqli_query($connection,"SELECT COALESCE(COUNT(id),0) AS 'sum' FROM homes where home_tier = '3'")or die($connection->error);
$tier4number = mysqli_query($connection,"SELECT COALESCE(COUNT(id),0) AS 'sum' FROM homes where home_tier = '4'")or die($connection->error);
$tier5number = mysqli_query($connection,"SELECT COALESCE(COUNT(id),0) AS 'sum' FROM homes where home_tier = '5'")or die($connection->error);
$homeNumber = mysqli_query($connection,"SELECT COALESCE(COUNT(id),0) AS 'sum' FROM homes")or die($connection->error);
$homes_no = mysqli_fetch_array($homeNumber);
$swimmingNumber = mysqli_query($connection,"SELECT COALESCE(COUNT(id),0) AS 'sum' FROM home_features where swimming_pool = '1'")or die($connection->error);
$swimming_no = mysqli_fetch_array($swimmingNumber);
$primaryOwnershipNumber = mysqli_query($connection,"SELECT COALESCE(COUNT(id),0) AS 'sum' FROM home_features where residence_type = '1'")or die($connection->error);
$primary_ownership_no = mysqli_fetch_array($primaryOwnershipNumber);
$secondaryOwnershipNumber = mysqli_query($connection,"SELECT COALESCE(COUNT(id),0) AS 'sum' FROM home_features where residence_type= '0'")or die($connection->error);
$secondary_ownership_no = mysqli_fetch_array($secondaryOwnershipNumber);
$housesNumber = mysqli_query($connection,"SELECT COALESCE(COUNT(id),0) AS 'sum' FROM home_features where home_type = '1'")or die($connection->error);
$houses_no = mysqli_fetch_array($housesNumber);
$apartmentsNumber = mysqli_query($connection,"SELECT COALESCE(COUNT(id),0) AS 'sum' FROM home_features where home_type = '0'")or die($connection->error);
$apartments_no = mysqli_fetch_array($apartmentsNumber);
$wifiNumber = mysqli_query($connection,"SELECT COALESCE(COUNT(id),0) AS 'sum' FROM home_features where wifi = '1'")or die($connection->error);
$wifi_no = mysqli_fetch_array($wifiNumber);
$tvNumber = mysqli_query($connection,"SELECT COALESCE(COUNT(id),0) AS 'sum' FROM home_features where tv = '1'")or die($connection->error);
$tv_no = mysqli_fetch_array($tvNumber);
$acNumber = mysqli_query($connection,"SELECT COALESCE(COUNT(id),0) AS 'sum' FROM home_features where ac = '1'")or die($connection->error);
$ac_no = mysqli_fetch_array($acNumber);
$gymNumber = mysqli_query($connection,"SELECT COALESCE(COUNT(id),0) AS 'sum' FROM home_features where private_gym = '1'")or die($connection->error);
$gym_no = mysqli_fetch_array($gymNumber);
$parkingNumber = mysqli_query($connection,"SELECT COALESCE(COUNT(id),0) AS 'sum' FROM home_features where parking = '1'")or die($connection->error);
$parking_no = mysqli_fetch_array($parkingNumber);
$kidsNumber = mysqli_query($connection,"SELECT COALESCE(COUNT(id),0) AS 'sum' FROM home_features where kids_friendly = '1'")or die($connection->error);
$kids_no = mysqli_fetch_array($kidsNumber);
$petsNumber = mysqli_query($connection,"SELECT COALESCE(COUNT(id),0) AS 'sum' FROM home_features where pets_allowed = '1'")or die($connection->error);
$pets_no = mysqli_fetch_array($petsNumber);
$wheelchairNumber = mysqli_query($connection,"SELECT COALESCE(COUNT(id),0) AS 'sum' FROM home_features where wheelchair_accessibility = '1'")or die($connection->error);
$wheelchair_no = mysqli_fetch_array($wheelchairNumber);
$securityNumber = mysqli_query($connection,"SELECT COALESCE(COUNT(id),0) AS 'sum' FROM home_features where security_guard = '1'")or die($connection->error);
$security_no = mysqli_fetch_array($securityNumber);
$workersNumber = mysqli_query($connection,"SELECT COALESCE(COUNT(id),0) AS 'sum' FROM home_features where home_workers = '1'")or die($connection->error);
$workers_no = mysqli_fetch_array($workersNumber);
$gardenNumber = mysqli_query($connection,"SELECT COALESCE(COUNT(id),0) AS 'sum' FROM home_features where private_garden = '1'")or die($connection->error);
$garden_no = mysqli_fetch_array($gardenNumber);
$smokersNumber = mysqli_query($connection,"SELECT COALESCE(COUNT(id),0) AS 'sum' FROM home_features where smokers_allowed = '1'")or die($connection->error);
$smokers_no = mysqli_fetch_array($smokersNumber);
$customer_preferences = mysqli_query($connection,"SELECT home_id as 'id',homes.name as 'name',COUNT(home_id) as count FROM wishlist inner join homes on home_id = homes.id  where DATE(wishlist.Created_at) >= DATE_SUB( CURDATE(), INTERVAL 3 MONTH) AND DATE(wishlist.Created_at) <= DATE_SUB( CURDATE(), INTERVAL 0 DAY ) GROUP BY home_id ORDER BY count DESC")or die($connection->error); 
$totalPreferences = mysqli_query($connection,"SELECT COUNT(home_id) as count FROM wishlist   where DATE(wishlist.Created_at) >= DATE_SUB( CURDATE(), INTERVAL 3 MONTH) AND DATE(wishlist.Created_at) <= DATE_SUB( CURDATE(), INTERVAL 0 DAY )")or die($connection->error);
$randomAvailableHomes = mysqli_query($connection,"SELECT homes.id as home_id, first_name, last_name, name, county, subcounty, homes.average_rating as average_rating, home_tier,home_image,home_extra_details,availability_start_date,availability_end_date,home_availability_status,extra_details  FROM homes INNER JOIN home_owners ON homes.home_owner_id = home_owners.id INNER JOIN users ON home_owners.user_id = users.id INNER JOIN subcounties ON homes.address = subcounties.id INNER JOIN counties ON subcounties.county_id = counties.id INNER JOIN home_availability ON home_availability.home_id = homes.id WHERE home_status = '1' AND home_availability_status = '1' OR home_availability_status = '2' ORDER BY RAND() LIMIT 5;")or die($connection->error);
$demandedCounties = mysqli_query($connection,"SELECT counties.county as 'county',COUNT(home_exchange_request.id) AS 'sum' FROM home_exchange_request inner join home_availability on home_exchange_request.availability_id = home_availability.id INNER JOIN homes ON home_availability.home_id = homes.id INNER JOIN subcounties ON homes.address = subcounties.id INNER JOIN counties ON subcounties.county_id = counties.id WHERE DATE(home_exchange_request.Created_at) >= DATE_SUB( CURDATE(), INTERVAL 6 MONTH ) AND DATE(home_exchange_request.Created_at) <= DATE_SUB( CURDATE(), INTERVAL 0 DAY ) GROUP BY counties.id ORDER BY sum DESC LIMIT 5")or die($connection->error);
$requestsNumber = mysqli_query($connection,"SELECT COALESCE(COUNT(id),0) AS 'sum' FROM home_exchange_request")or die($connection->error);
$requests_no = mysqli_fetch_array($requestsNumber);
$tier1Wk1 = mysqli_query($connection,"SELECT COALESCE(COUNT(home_exchange_request.id),0) AS 'sum' FROM home_exchange_request INNER JOIN home_availability ON home_exchange_request.availability_id = home_availability.id INNER JOIN homes ON home_availability.home_id = homes.id WHERE homes.home_tier = '1' AND DATE(home_exchange_request.Created_at) >= DATE_SUB( CURDATE(), INTERVAL 1 MONTH) and DATE(home_exchange_request.Created_at) < DATE_SUB( CURDATE(), INTERVAL 3 WEEK)")or die($connection->error);
$tier1Wk2 = mysqli_query($connection,"SELECT COALESCE(COUNT(home_exchange_request.id),0) AS 'sum' FROM home_exchange_request INNER JOIN home_availability ON home_exchange_request.availability_id = home_availability.id INNER JOIN homes ON home_availability.home_id = homes.id WHERE homes.home_tier = '1' AND DATE(home_exchange_request.Created_at) >= DATE_SUB( CURDATE(), INTERVAL 3 WEEK ) and DATE(home_exchange_request.Created_at) < DATE_SUB( CURDATE(), INTERVAL 2 WEEK)")or die($connection->error);
$tier1Wk3 = mysqli_query($connection,"SELECT COALESCE(COUNT(home_exchange_request.id),0) AS 'sum' FROM home_exchange_request INNER JOIN home_availability ON home_exchange_request.availability_id = home_availability.id INNER JOIN homes ON home_availability.home_id = homes.id WHERE homes.home_tier = '1' AND DATE(home_exchange_request.Created_at) >= DATE_SUB( CURDATE(), INTERVAL 2 WEEK ) and DATE(home_exchange_request.Created_at) < DATE_SUB( CURDATE(), INTERVAL 1 WEEK )")or die($connection->error);
$tier1Wk4 = mysqli_query($connection,"SELECT COALESCE(COUNT(home_exchange_request.id),0) AS 'sum' FROM home_exchange_request INNER JOIN home_availability ON home_exchange_request.availability_id = home_availability.id INNER JOIN homes ON home_availability.home_id = homes.id WHERE homes.home_tier = '1' AND DATE(home_exchange_request.Created_at) >= DATE_SUB( CURDATE(), INTERVAL 1 WEEK ) and DATE(home_exchange_request.Created_at) <= DATE_SUB( CURDATE(), INTERVAL 0 DAY )")or die($connection->error);
$tier2Wk1 = mysqli_query($connection,"SELECT COALESCE(COUNT(home_exchange_request.id),0) AS 'sum' FROM home_exchange_request INNER JOIN home_availability ON home_exchange_request.availability_id = home_availability.id INNER JOIN homes ON home_availability.home_id = homes.id WHERE homes.home_tier = '2' AND DATE(home_exchange_request.Created_at) >= DATE_SUB( CURDATE(), INTERVAL 1 MONTH) and DATE(home_exchange_request.Created_at) < DATE_SUB( CURDATE(), INTERVAL 3 WEEK)")or die($connection->error);
$tier2Wk2 = mysqli_query($connection,"SELECT COALESCE(COUNT(home_exchange_request.id),0) AS 'sum' FROM home_exchange_request INNER JOIN home_availability ON home_exchange_request.availability_id = home_availability.id INNER JOIN homes ON home_availability.home_id = homes.id WHERE homes.home_tier = '2' AND DATE(home_exchange_request.Created_at) >= DATE_SUB( CURDATE(), INTERVAL 3 WEEK ) and DATE(home_exchange_request.Created_at) < DATE_SUB( CURDATE(), INTERVAL 2 WEEK)")or die($connection->error);
$tier2Wk3 = mysqli_query($connection,"SELECT COALESCE(COUNT(home_exchange_request.id),0) AS 'sum' FROM home_exchange_request INNER JOIN home_availability ON home_exchange_request.availability_id = home_availability.id INNER JOIN homes ON home_availability.home_id = homes.id WHERE homes.home_tier = '2' AND DATE(home_exchange_request.Created_at) >= DATE_SUB( CURDATE(), INTERVAL 2 WEEK ) and DATE(home_exchange_request.Created_at) < DATE_SUB( CURDATE(), INTERVAL 1 WEEK )")or die($connection->error);
$tier2Wk4 = mysqli_query($connection,"SELECT COALESCE(COUNT(home_exchange_request.id),0) AS 'sum' FROM home_exchange_request INNER JOIN home_availability ON home_exchange_request.availability_id = home_availability.id INNER JOIN homes ON home_availability.home_id = homes.id WHERE homes.home_tier = '2' AND DATE(home_exchange_request.Created_at) >= DATE_SUB( CURDATE(), INTERVAL 1 WEEK ) and DATE(home_exchange_request.Created_at) <= DATE_SUB( CURDATE(), INTERVAL 0 DAY )")or die($connection->error);
$tier3Wk1 = mysqli_query($connection,"SELECT COALESCE(COUNT(home_exchange_request.id),0) AS 'sum' FROM home_exchange_request INNER JOIN home_availability ON home_exchange_request.availability_id = home_availability.id INNER JOIN homes ON home_availability.home_id = homes.id WHERE homes.home_tier = '3' AND DATE(home_exchange_request.Created_at) >= DATE_SUB( CURDATE(), INTERVAL 1 MONTH) and DATE(home_exchange_request.Created_at) < DATE_SUB( CURDATE(), INTERVAL 3 WEEK)")or die($connection->error);
$tier3Wk2 = mysqli_query($connection,"SELECT COALESCE(COUNT(home_exchange_request.id),0) AS 'sum' FROM home_exchange_request INNER JOIN home_availability ON home_exchange_request.availability_id = home_availability.id INNER JOIN homes ON home_availability.home_id = homes.id WHERE homes.home_tier = '3' AND DATE(home_exchange_request.Created_at) >= DATE_SUB( CURDATE(), INTERVAL 3 WEEK ) and DATE(home_exchange_request.Created_at) < DATE_SUB( CURDATE(), INTERVAL 2 WEEK)")or die($connection->error);
$tier3Wk3 = mysqli_query($connection,"SELECT COALESCE(COUNT(home_exchange_request.id),0) AS 'sum' FROM home_exchange_request INNER JOIN home_availability ON home_exchange_request.availability_id = home_availability.id INNER JOIN homes ON home_availability.home_id = homes.id WHERE homes.home_tier = '3' AND DATE(home_exchange_request.Created_at) >= DATE_SUB( CURDATE(), INTERVAL 2 WEEK ) and DATE(home_exchange_request.Created_at) < DATE_SUB( CURDATE(), INTERVAL 1 WEEK )")or die($connection->error);
$tier3Wk4 = mysqli_query($connection,"SELECT COALESCE(COUNT(home_exchange_request.id),0) AS 'sum' FROM home_exchange_request INNER JOIN home_availability ON home_exchange_request.availability_id = home_availability.id INNER JOIN homes ON home_availability.home_id = homes.id WHERE homes.home_tier = '3' AND DATE(home_exchange_request.Created_at) >= DATE_SUB( CURDATE(), INTERVAL 1 WEEK ) and DATE(home_exchange_request.Created_at) <= DATE_SUB( CURDATE(), INTERVAL 0 DAY )")or die($connection->error);
$tier4Wk1 = mysqli_query($connection,"SELECT COALESCE(COUNT(home_exchange_request.id),0) AS 'sum' FROM home_exchange_request INNER JOIN home_availability ON home_exchange_request.availability_id = home_availability.id INNER JOIN homes ON home_availability.home_id = homes.id WHERE homes.home_tier = '4' AND DATE(home_exchange_request.Created_at) >= DATE_SUB( CURDATE(), INTERVAL 1 MONTH) and DATE(home_exchange_request.Created_at) < DATE_SUB( CURDATE(), INTERVAL 3 WEEK)")or die($connection->error);
$tier4Wk2 = mysqli_query($connection,"SELECT COALESCE(COUNT(home_exchange_request.id),0) AS 'sum' FROM home_exchange_request INNER JOIN home_availability ON home_exchange_request.availability_id = home_availability.id INNER JOIN homes ON home_availability.home_id = homes.id WHERE homes.home_tier = '4' AND DATE(home_exchange_request.Created_at) >= DATE_SUB( CURDATE(), INTERVAL 3 WEEK ) and DATE(home_exchange_request.Created_at) < DATE_SUB( CURDATE(), INTERVAL 2 WEEK)")or die($connection->error);
$tier4Wk3 = mysqli_query($connection,"SELECT COALESCE(COUNT(home_exchange_request.id),0) AS 'sum' FROM home_exchange_request INNER JOIN home_availability ON home_exchange_request.availability_id = home_availability.id INNER JOIN homes ON home_availability.home_id = homes.id WHERE homes.home_tier = '4' AND DATE(home_exchange_request.Created_at) >= DATE_SUB( CURDATE(), INTERVAL 2 WEEK ) and DATE(home_exchange_request.Created_at) < DATE_SUB( CURDATE(), INTERVAL 1 WEEK )")or die($connection->error);
$tier4Wk4 = mysqli_query($connection,"SELECT COALESCE(COUNT(home_exchange_request.id),0) AS 'sum' FROM home_exchange_request INNER JOIN home_availability ON home_exchange_request.availability_id = home_availability.id INNER JOIN homes ON home_availability.home_id = homes.id WHERE homes.home_tier = '4' AND DATE(home_exchange_request.Created_at) >= DATE_SUB( CURDATE(), INTERVAL 1 WEEK ) and DATE(home_exchange_request.Created_at) <= DATE_SUB( CURDATE(), INTERVAL 0 DAY )")or die($connection->error);
$tier5Wk1 = mysqli_query($connection,"SELECT COALESCE(COUNT(home_exchange_request.id),0) AS 'sum' FROM home_exchange_request INNER JOIN home_availability ON home_exchange_request.availability_id = home_availability.id INNER JOIN homes ON home_availability.home_id = homes.id WHERE homes.home_tier = '5' AND DATE(home_exchange_request.Created_at) >= DATE_SUB( CURDATE(), INTERVAL 1 MONTH) and DATE(home_exchange_request.Created_at) < DATE_SUB( CURDATE(), INTERVAL 3 WEEK)")or die($connection->error);
$tier5Wk2 = mysqli_query($connection,"SELECT COALESCE(COUNT(home_exchange_request.id),0) AS 'sum' FROM home_exchange_request INNER JOIN home_availability ON home_exchange_request.availability_id = home_availability.id INNER JOIN homes ON home_availability.home_id = homes.id WHERE homes.home_tier = '5' AND DATE(home_exchange_request.Created_at) >= DATE_SUB( CURDATE(), INTERVAL 3 WEEK ) and DATE(home_exchange_request.Created_at) < DATE_SUB( CURDATE(), INTERVAL 2 WEEK)")or die($connection->error);
$tier5Wk3 = mysqli_query($connection,"SELECT COALESCE(COUNT(home_exchange_request.id),0) AS 'sum' FROM home_exchange_request INNER JOIN home_availability ON home_exchange_request.availability_id = home_availability.id INNER JOIN homes ON home_availability.home_id = homes.id WHERE homes.home_tier = '5' AND DATE(home_exchange_request.Created_at) >= DATE_SUB( CURDATE(), INTERVAL 2 WEEK ) and DATE(home_exchange_request.Created_at) < DATE_SUB( CURDATE(), INTERVAL 1 WEEK )")or die($connection->error);
$tier5Wk4 = mysqli_query($connection,"SELECT COALESCE(COUNT(home_exchange_request.id),0) AS 'sum' FROM home_exchange_request INNER JOIN home_availability ON home_exchange_request.availability_id = home_availability.id INNER JOIN homes ON home_availability.home_id = homes.id WHERE homes.home_tier = '5' AND DATE(home_exchange_request.Created_at) >= DATE_SUB( CURDATE(), INTERVAL 1 WEEK ) and DATE(home_exchange_request.Created_at) <= DATE_SUB( CURDATE(), INTERVAL 0 DAY )")or die($connection->error);
?>

