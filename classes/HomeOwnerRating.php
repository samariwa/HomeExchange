<?php
class HomeOwnerRating{
    public function RateHomeOwner($home_owner_id, $home_customer_id, $value)
    {
        $query = new Database();
        return $query->insert("home_owner_ratings", array('home_owner_id' => $home_owner_id,'home_customer_id' => $home_customer_id,'rating_value' => $value ));
    }

    public function GetAverageHomeOwnerRating($home_owner_id)
    {
        $query = new Database();
        return $query->get("home_owners","average_rating", array('id','=',$home_owner_id));
    }

    public function GetAllHomeOwnerRatings($home_owner_id)
    {
        $query = new Database();
        return $query->get("home_owner_ratings","*", array('home_owner_id','=',$home_owner_id));
    }

    public function SetAverageHomeOwnerRating()
    {

    }
}