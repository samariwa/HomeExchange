<?php
class Customer{
   public function GetActiveCustomer()
   {
       return "SELECT id, first_name,other_name, last_name, physical_address, phone_number, email_address, exchange_points FROM users WHERE role_id = '2' AND user_status = '1'";
   }

   public function GetBlacklistedCustomer()
   {
       return "SELECT id, first_name,other_name, last_name, physical_address, phone_number, email_address, exchange_points FROM users WHERE role_id = '2' AND user_status = '0'";
   }

   public function BlacklistCustomer($id)
   {
       $db = new Database();
       return $db->update("users", "id", $id, array('user_status' => '0'));
   }

   public function RestoreCustomer($id)
   {
       $db = new Database();
       return $db->update("users", "id", $id, array('user_status' => '1'));
   }

   public function DeleteCustomer($id)
   {
       $db = new Database();
       return $db->delete("users", $id);
   }
}