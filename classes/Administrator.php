<?php
class Administrator{

    public function GetActiveAdmins()
    {
        return "SELECT id, first_name,other_name, last_name, phone_number, email_address FROM users WHERE role_id = '1' AND user_status = '1'";
    }

    public function GetDeactivatedAdmins()
    {
        return "SELECT id, first_name,other_name, last_name, phone_number, email_address FROM users WHERE role_id = '1' AND user_status = '0'";
    }

    public function FetchAdmin($user_id)
    {
        return "SELECT id, first_name,other_name, last_name, phone_number, email_address FROM users WHERE role_id = '1' AND if = '$user_id'";
    }

}