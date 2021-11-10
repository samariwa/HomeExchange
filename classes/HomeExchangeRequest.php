<?php
class HomeExchangeRequest{

   public function MakeExchangeRequest($requester_id, $home,$availability_id, $no_of_occupants, $start_date, $end_date, $extra_details)
   {
      $query = new Database();
      return $query->insert("home_exchange_request", array('requester_id' => $requester_id,'exchange_home_id' => $home,'availability_id' => $availability_id,'number_of_occupants' => $no_of_occupants, 'exchange_start_date' => $start_date, 'exchange_end_date' => $end_date, 'exchange_extra_details' => $extra_details ));
   }

   public function GetExchanges()
   {
      $query = new Database();
      return $query->get("home_exchange_request","*", array('request_status','=','1'));
   }

   public function GetPendingExchangeRequests($user_id)
   {
      return "SELECT home_owners.id as my_id, home_exchange_request.exchange_home_id as requester_home_id, home_exchange_request.id as request_id, number_of_occupants, exchange_start_date, exchange_end_date, exchange_extra_details, homes.name as name, homes.home_tier as tier FROM home_exchange_request INNER JOIN home_availability ON home_exchange_request.availability_id = home_availability.id INNER JOIN homes ON home_availability.home_id = homes.id INNER JOIN home_owners ON homes.home_owner_id = home_owners.id INNER JOIN users ON home_owners.user_id = users.id INNER JOIN subcounties ON homes.address = subcounties.id INNER JOIN counties ON subcounties.county_id = counties.id WHERE users.id = '$user_id' AND request_status = '1' AND request_response = '0'";
   }

   public function GetPendingRequesterDetails($home_id)
   {
      return "SELECT home_owners.id as requester_id, availability_id, first_name, last_name, phone_number, homes.home_image as image, homes.name as name, counties.county as county, subcounties.subcounty as subcounty, homes.home_tier as tier FROM home_exchange_request INNER JOIN homes ON home_exchange_request.exchange_home_id = homes.id INNER JOIN home_owners ON homes.home_owner_id = home_owners.id INNER JOIN users ON home_owners.user_id = users.id INNER JOIN subcounties ON homes.address = subcounties.id INNER JOIN counties ON subcounties.county_id = counties.id WHERE homes.id = '$home_id' AND request_status = '1' AND request_response = '0'";
   }

   public function GetPendingExchangeResponses($user_id)
   {
      return "SELECT home_owners.id as requester_id, home_exchange_request.id as request_id, availability_id, first_name, last_name, phone_number, homes.home_image as image, homes.name as name, counties.county as county, subcounties.subcounty as subcounty, homes.home_tier as tier FROM home_exchange_request INNER JOIN homes ON home_exchange_request.exchange_home_id = homes.id INNER JOIN home_owners ON homes.home_owner_id = home_owners.id INNER JOIN users ON home_owners.user_id = users.id INNER JOIN subcounties ON homes.address = subcounties.id INNER JOIN counties ON subcounties.county_id = counties.id WHERE users.id = '$user_id' AND request_status = '1' AND request_response != '0'";
   }

   public function GetPendingResponderDetails($availability_id, $request_id)
   {
      return "SELECT home_owners.id as my_id, home_exchange_request.exchange_home_id as requester_home_id ,first_name, last_name, phone_number,request_response, homes.home_image as image, homes.name as name, counties.county as county, subcounties.subcounty as subcounty,home_exchange_request.id as request_id, homes.name as name, homes.home_tier as tier FROM home_exchange_request INNER JOIN home_availability ON home_exchange_request.availability_id = home_availability.id INNER JOIN homes ON home_availability.home_id = homes.id INNER JOIN home_owners ON homes.home_owner_id = home_owners.id INNER JOIN users ON home_owners.user_id = users.id INNER JOIN subcounties ON homes.address = subcounties.id INNER JOIN counties ON subcounties.county_id = counties.id WHERE home_availability.id = '$availability_id' AND home_exchange_request.id = '$request_id' AND request_status = '1' AND request_response != '0'";
   }

   public function getExchangeRequests($home_id)
   {
     return "SELECT COUNT(home_exchange_request.id) as sum, first_name, last_name, exchange_start_date,exchange_end_date,exchange_extra_details  FROM home_exchange_request INNER JOIN users ON home_exchange_request.requester_id = users.id INNER JOIN home_availability ON home_exchange_request.availability_id = home_availability.id WHERE home_availability.home_id = '$home_id' GROUP BY home_exchange_request.id";
   }
   
   public function CancelExchangeRequest($request_id)
   {
      $query = new Database();
      return $query->delete("home_exchange_request",$request_id);
   }

   public function FetchExchangeRequests($availability_id)
   {
      $query = new Database();
      return $query->get("home_exchange_request","*", array('availability_id','=',$availability_id));
   }

   public function AcceptExchangeRequest($request_id, $availability_id)
   {
      $home_availability = new HomeAvailabilityDetails();
      return "UPDATE home_exchange_request SET request_response = '1' WHERE id = '$request_id'";
      $home_availability->RemoveHomeAvailability($availability_id);
   }

   public function DeclineExchangeRequest($request_id)
   {
      return "UPDATE home_exchange_request SET request_response = '2' WHERE id = '$request_id'";
   }

}