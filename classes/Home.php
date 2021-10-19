<?php
class Home{
   public function GetActiveHomes()
   {
      $query = new Database();
        return $query->get("homes","*", array('home_status','=','1'));
   }

   public function fetchHomeDetails($home_id)
   {
      $query = new Database();
      return $query->get("homes","*", array('id','=', $home_id));
   }

   public function fetchHomeImages($home_id)
   {
      $query = new Database();
      return $query->get("images","url", array('home_id','=', $home_id));
   }

   public function DeleteHome($home_id)
   {
      $query = new Database();
      return $query->delete("homes", $home_id);
   }

   public function AddHome($owner_id, $name, $description, $address, $tier, $extra_details, $image_url)
   {
      $query = new Database();
      return $query->insert("homes", array('home_owner_id' => $owner_id,'name' => $name,'description' => $description ,'address' => $address,'home_tier' => $tier ,'home_extra_details' => $extra_details,'home_image' => $image_url ));
   }

   public function FetchOwnerLatestHomeId($owner_id)
   {
      return "SELECT id, Created_at FROM homes INNER JOIN (SELECT id AS max_id, MAX(Created_at) AS max_created_at FROM homes GROUP BY id) subQuery ON subQuery.max_id = id AND subQuery.max_created_at = Created_at WHERE id = '$owner_id'";
   }

   public function AddHomeFeatures($home_id, $swimming_pool, $home_type, $residence_type, $wifi, $tv, $ac, $bedrooms, $bathrooms, $capacity, $gym, $parking, $wheelchair, $pets, $kids, $workers, $security, $garden, $smokers )
   {
      $query = new Database();
      return $query->insert("home_features", array('home_id' => $home_id,'swimming_pool' => $swimming_pool,'home_type' => $home_type ,'residence_type' => $residence_type,'wifi' => $wifi ,'tv' => $tv,'ac' => $ac,'bedrooms' => $bedrooms ,'bathrooms' => $bathrooms,'capacity' => $capacity ,'private_gym' => $gym,'parking' => $parking,'wheelchair_accessibility' => $wheelchair,'pets_allowed' => $pets,'kids_friendly' => $kids,'home_workers' => $workers,'security_guard' => $security,'private_garden' => $garden,'smokers_allowed' => $smokers ));
   }

   public function GetHomeFeatures($home_id)
   {
      $query = new Database();
      return $query->get("home_features","*", array('home_id','=', $home_id));
   }

   public function UpdateHomeFeatures($home_id)
   {
      $query = new Database();
      return $query->update("home_features", "home_id", $home_id, $values = array());
   }

   public function DeactivateHome($home_id)
   {
      $query = new Database();
      return $query->update("home_features", "home_id", $home_id, array('home_status' => '0'));
   }

   public function ReactivateHome($home_id)
   {
      $query = new Database();
      return $query->update("home_features", "home_id", $home_id, array('home_status' => '1'));
   }

   public function UpdateHomeDetails($home_id)
   {
      $query = new Database();
      return $query->update("homes", "id", $home_id, $values = array());
   }

   public function GetHomeRating($home_id)
   {
      $query = new Database();
      return $query->get("homes","average_rating", array('home_id','=', $home_id));
   }
}