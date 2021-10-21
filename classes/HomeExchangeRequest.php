<?php
class HomeExchangeRequest{

   public function MakeExchangeRequest($requester_id, $availability_id, $no_of_occupants, $start_date, $end_date, $extra_details)
   {
      $query = new Database();
      return $query->insert("home_exchange_request", array('requester_id' => $requester_id,'availability_id' => $availability_id,'number_of_occupants' => $no_of_occupants, 'exchange_start_date' => $start_date, 'exchange_end_date' => $end_date, 'exchange_extra_details' => $extra_details ));
   }

   public function GetExchanges()
   {
      $query = new Database();
      return $query->get("home_exchange_request","*", array('request_status','=','1'));
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

   public function AcceptExchangeRequest($requester_id, $availability_id)
   {
      $home_availability = new HomeAvailabilityDetails();
      return "UPDATE home_exchange_request SET request_response = '1' WHERE requester_id = '$sender_id' AND availability_id = '$availability_id'";
      $home_availability->RemoveHomeAvailability($availability_id);
   }

   public function DeclineExchangeRequest($requester_id, $availability_id)
   {
      return "UPDATE home_exchange_request SET request_response = '0' WHERE requester_id = '$sender_id' AND availability_id = '$availability_id'";
   }

}