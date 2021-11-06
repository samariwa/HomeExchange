<?php
class Home{
   public function GetActiveHomes()
   {
        return "SELECT homes.id as home_id, first_name, last_name, name, county, subcounty, homes.average_rating as average_rating, home_tier,home_image,home_extra_details  FROM homes INNER JOIN home_owners ON homes.home_owner_id = home_owners.id INNER JOIN users ON home_owners.user_id = users.id INNER JOIN subcounties ON homes.address = subcounties.id INNER JOIN counties ON subcounties.county_id = counties.id WHERE home_status = '1'";
   }

   public function GetAvailableHomes()
   {
      return "SELECT homes.id as home_id, first_name, last_name, name, county, subcounty, homes.average_rating as average_rating, home_tier,home_image,home_extra_details,availability_start_date,availability_end_date,home_availability_status,extra_details  FROM homes INNER JOIN home_owners ON homes.home_owner_id = home_owners.id INNER JOIN users ON home_owners.user_id = users.id INNER JOIN subcounties ON homes.address = subcounties.id INNER JOIN counties ON subcounties.county_id = counties.id INNER JOIN home_availability ON home_availability.home_id = homes.id WHERE home_status = '1' AND home_availability_status = '1'";
   }

   public function fetchHomeDetails($home_id)
   {
      return "SELECT homes.id as home_id, users.id as user_id, home_owners.id as owner_id, first_name, last_name, name,description, county, subcounty, homes.average_rating as average_rating, home_tier,home_image,home_extra_details  FROM homes INNER JOIN home_owners ON homes.home_owner_id = home_owners.id INNER JOIN users ON home_owners.user_id = users.id INNER JOIN subcounties ON homes.address = subcounties.id INNER JOIN counties ON subcounties.county_id = counties.id WHERE homes.id = '$home_id'";
   }

   public function fetchAvailabilityDetails($home_id)
   {
      return "SELECT homes.id as home_id,home_availability.id as availability_id, first_name, last_name, home_owners.average_rating as owner_rating, phone_number, name,  homes.average_rating as average_rating, home_tier,availability_start_date,availability_end_date,extra_details  FROM homes INNER JOIN home_owners ON homes.home_owner_id = home_owners.id INNER JOIN users ON home_owners.user_id = users.id INNER JOIN home_availability ON home_availability.home_id = homes.id WHERE homes.id = '$home_id'";
   }

   public function getUserHomes($owner_id)
   {
      $query = new Database();
      return $query->get("homes","*", array('home_owner_id','=', $owner_id));
   }

   public function fetchHomeImages($home_id)
   {
      $query = new Database();
      return $query->get("images","*", array('home_id','=', $home_id));
   }

   public function fetchHomeComments($home_id)
   {
      $query = new Database();
      return $query->get("comments","*", array('home_id','=', $home_id));
   }
   
   public function addHomeImages($home_id, $url)
   {
      $query = new Database();
      return $query->insert("images", array('home_id' => $home_id, 'url' => $url ));
   }

   public function DeleteHome($home_id)
   {
      $query = new Database();
      return $query->delete("homes", $home_id);
   }

   public function AddHome($details = array())
   {
      $query = new Database();
      return $query->insert("homes", $details);
   }

   public function FetchOwnerLatestHomeId($owner_id)
   {
      return "SELECT id, Created_at FROM homes INNER JOIN (SELECT id AS max_id, MAX(Created_at) AS max_created_at FROM homes GROUP BY id) subQuery ON subQuery.max_id = id AND subQuery.max_created_at = Created_at WHERE id = '$owner_id'";
   }

   public function AddHomeFeatures($home_id, $swimming_pool, $home_type, $residence_type, $wifi, $tv, $ac, $size, $bedrooms, $bathrooms, $capacity, $gym, $parking, $wheelchair, $pets, $kids, $workers, $security, $garden, $smokers )
   {
      $query = new Database();
      return $query->insert("home_features", array('home_id' => $home_id,'swimming_pool' => $swimming_pool,'home_type' => $home_type ,'residence_type' => $residence_type,'wifi' => $wifi ,'tv' => $tv,'ac' => $ac,'size' => $size,'bedrooms' => $bedrooms ,'bathrooms' => $bathrooms,'capacity' => $capacity ,'private_gym' => $gym,'parking' => $parking,'wheelchair_accessibility' => $wheelchair,'pets_allowed' => $pets,'kids_friendly' => $kids,'home_workers' => $workers,'security_guard' => $security,'private_garden' => $garden,'smokers_allowed' => $smokers ));
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
      return $query->update("homes", "id", $home_id, array('home_status' => '0'));
   }

   public function GetDeactivatedHomes()
   {
      return "SELECT homes.id as home_id, first_name, last_name, name, county, subcounty, homes.average_rating as average_rating, home_tier,home_image,home_extra_details  FROM homes INNER JOIN home_owners ON homes.home_owner_id = home_owners.id INNER JOIN users ON home_owners.user_id = users.id INNER JOIN subcounties ON homes.address = subcounties.id INNER JOIN counties ON subcounties.county_id = counties.id WHERE home_status = '0'";
   }

   public function ReactivateHome($home_id)
   {
      $query = new Database();
      return $query->update("homes", "id", $home_id, array('home_status' => '1'));
   }

   public function UpdateHomeDetails($home_id, $name, $description)
   {
      $query = new Database();
      return $query->update("homes", "id", $home_id, array('name' => $name,'description' => $description));
   }

   public function GetHomeRating($home_id)
   {
      $query = new Database();
      return $query->get("homes","average_rating", array('home_id','=', $home_id));
   }
}