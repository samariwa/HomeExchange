<?php
class Customer{
   public function GetActiveCustomer()
   {
       return "SELECT id, first_name,other_name, last_name, physical_address, phone_number, email_address FROM users WHERE role_id = '2' AND user_status = '1'";
   }

   public function FetchCustomer($user_id)
    {
        return "SELECT id, first_name,other_name, last_name, phone_number, email_address FROM users WHERE role_id = '2' AND if = '$user_id'";
    }

   public function GetExchangePoints($user_id)
   {
     $query = new Database();
     return $query->get("home_owners","exchange_points", array('user_id','=',$user_id));
   }

   public function SetExchangePoints($user_id, $points)
   {
     return "UPDATE home_owners SET exchange_points = exchange_points + '$points' WHERE user_id = '$user_id'";
   }

   public function TransferExchangePoints($sender_id, $receiver_id, $points)
   {
    return "UPDATE home_owners SET exchange_points = exchange_points - '$points' WHERE user_id = '$sender_id';
    UPDATE home_owners SET exchange_points = exchange_points + '$points' WHERE user_id = '$receiver_id'";
   }

   public function GetBlacklistedCustomer()
   {
       return "SELECT id, first_name,other_name, last_name, physical_address, phone_number, email_address FROM users WHERE role_id = '2' AND user_status = '0'";
   }

}