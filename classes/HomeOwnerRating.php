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
        return $query->get("home_owner_ratings","AVG(rating_value) as rating", array('home_owner_id','=',$home_owner_id));
    } 
    
    public function CheckRaterUnique($home_owner_id, $rater_id)
    {
        return "SELECT id FROM home_owner_ratings WHERE home_customer_id = '$rater_id' AND home_owner_id = '$home_owner_id'";
    }

    public function UpdateRating($rating_id, $rating)
    {
        $query = new Database();
        return $query->update("home_owner_ratings", "id", $rating_id, array('rating_value' => $rating));
    }

    public function GetAllHomeOwnerRatings($home_owner_id)
    {
        $query = new Database();
        return $query->get("home_owner_ratings","*", array('home_owner_id','=',$home_owner_id));
    }

    public function SetAverageHomeOwnerRating($owner_id, $rating)
    {
        $query = new Database();
        return $query->update("home_owners", "id", $owner_id, array('average_rating' => $rating));
    }
}