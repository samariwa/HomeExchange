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
        return $query->get("home_owner_ratings","AVG(rating_value)", array('home_owner_id','=',$home_owner_id));
    }

    public function GetAllHomeOwnerRatings($home_owner_id)
    {
        $query = new Database();
        return $query->get("home_owner_ratings","*", array('home_owner_id','=',$home_owner_id));
    }

    public function SetAverageHomeOwnerRating($user_id, $rating)
    {
        $query = new Database();
        return $query->update("home_owners", "user_id", $user_id, array('average_rating' => $rating));
    }
}