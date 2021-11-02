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
        return $query->get("home_ratings","AVG(rating_value) as rating", array('home_id','=',$home_id));
    }

    public function CheckRaterUnique($home_id, $rater_id)
    {
        return "SELECT id FROM home_ratings WHERE home_rater_id = '$rater_id' AND home_id = '$home_id'";
    }

    public function UpdateRating($rating_id, $rating)
    {
        $query = new Database();
        return $query->update("home_ratings", "id", $rating_id, array('rating_value' => $rating));
    }

    public function GetAllHomeRatings($home_id)
    {
        $query = new Database();
        return $query->get("home_ratings","*", array('home_id','=',$home_id));
    }

    public function SetAverageHomeRating($home_id, $rating)
    {
        $query = new Database();
        return $query->update("homes", "id", $home_id, array('average_rating' => $rating));
    }
}