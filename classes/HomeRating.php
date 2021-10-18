<?php
class HomeRating{
    public function RateHome($home_id, $home_rater_id, $value)
    {
        $query = new Database();
        return $query->insert("home_ratings", array('home_id' => $home_id,'home_rater_id' => $home_rater_id,'rating_value' => $value ));
    }

    public function GetAverageHomeRating($home_id)
    {
        $query = new Database();
        return $query->get("homes","average_rating", array('id','=',$home_id));
    }

    public function GetAllHomeRatings($home_id)
    {
        $query = new Database();
        return $query->get("home_ratings","*", array('home_id','=',$home_id));
    }

    public function SetAverageHomeRating()
    {

    }
}