<?php
//require user configuration and database connection parameters
///////////////////////////////////////
//START OF USER CONFIGURATION/////////
/////////////////////////////////////
//Define MySQL database parameters

$username = "root";
$password = "samokoth.1999";
$hostname = "127.0.0.1";
$database = "home_exchange";
$port = "3306";

//Defining authenticator credentials
$authenticator_email = 'symphauthenticator@gmail.com';
$authenticator_password = 'Kenya.2030';

//mail host
$mail_host = "smtp.gmail.com";

//site primary contact number
$contact_number = "+254 7XX XXX XXX";

//business physical address
$physical_address = "This address";

//Defining organization details
$organization = 'Holiday Swap';

//Defining Recaptcha parameters
$token_verification_site = "https://www.google.com/recaptcha/api/siteverify";
$private_key ='6Ld_DqAaAAAAAC_Xp5g6yDr5XPjC1oIlMGZwX5cS';
$public_key='6Ld_DqAaAAAAAIVKl_AmFc4qhHItRTT75yqbmhtR';
//server test
//$private_key ='6LcNe8oaAAAAAAAxymwmkEdBCEYiMt4w5yRwqTOT';
//$public_key='6LcNe8oaAAAAAGuQTSOKBYNhjRf60UEs5YjCNUw5';

//Defining length of salt,minimum=10, maximum=35
$length_salt = 15;

//User browser
$useragent = $_SERVER["HTTP_USER_AGENT"];

//Defining the maximum number of failed attempts to ban brute force attackers
//minimum is 5
$maxfailedattempts = 5;

//initial admin password on registration
$default_admin_pass = 'Kenya.2030'; 

//initial exchange points awarded when customer adds home
$initial_exchange_points = 750;

//Defining session timeout in seconds
//minimum 60 (for one minute)
$sessiontimeout = 60*30;

//client ip address
$iptocheck = $_SERVER['REMOTE_ADDR'];
//Defining cookies timeout in seconds
//remember me cookies
$remember_me_expiry = time()+60*60*7*24;
//favouritescookies
$favourite_expiry = time() +60*60*7*24;

spl_autoload_register(function($class)
{
   require_once 'classes/'.$class.'.php';
});

////////////////////////////////////
//END OF USER CONFIGURATION/////////
////////////////////////////////////
//DO NOT EDIT ANYTHING BELOW!

$connection = mysqli_connect($hostname,$username, $password, $database, $port)
or die("Unable to connect to Server");
$login_url = 'auth/login.php';
$logout_url = 'auth/logout.php';
$home_url = 'index.php';
$dashboard_url = 'dashboard.php';
$admin_url = 'admin/dashboard.php';
$protocol = $_SERVER['SERVER_PROTOCOL'];
if(strpos($protocol, "https"))
{
    $protocol="https://";
}
else
{
    $protocol="http://";
}
$home_link = $protocol.$_SERVER['HTTP_HOST'].'/HomeExchange';
$dashboard_link = $protocol.$_SERVER['HTTP_HOST'].'/HomeExchange/'.$dashboard_url;
$admin_dashboard_link = $protocol.$_SERVER['HTTP_HOST'].'/HomeExchange/'.$admin_url;
$redirect_link = $protocol.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
?>