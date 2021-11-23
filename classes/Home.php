<?php
class Home{
   public function GetActiveHomes()
   {
        return "SELECT homes.id as home_id, first_name, last_name, name, county, subcounty, homes.average_rating as average_rating, home_tier,home_image,home_extra_details  FROM homes INNER JOIN home_owners ON homes.home_owner_id = home_owners.id INNER JOIN users ON home_owners.user_id = users.id INNER JOIN subcounties ON homes.address = subcounties.id INNER JOIN counties ON subcounties.county_id = counties.id WHERE home_status = '1'";
   }

   public function GetAvailableHomes()
   {
      return "SELECT homes.id as home_id, first_name, last_name, name, county, subcounty, homes.average_rating as average_rating, home_tier,home_image,home_extra_details,availability_start_date,availability_end_date,home_availability_status,extra_details FROM homes INNER JOIN home_owners ON homes.home_owner_id = home_owners.id INNER JOIN users ON home_owners.user_id = users.id INNER JOIN subcounties ON homes.address = subcounties.id INNER JOIN counties ON subcounties.county_id = counties.id INNER JOIN home_availability ON home_availability.home_id = homes.id WHERE home_status = '1' AND home_availability_status = '1' OR home_availability_status = '2'";
   }

   public function fetchHomeDetails($home_id)
   {
      return "SELECT homes.id as home_id, users.id as user_id, home_owners.id as owner_id, first_name, last_name, name,description, county, subcounty, dashboard_views, homes.average_rating as average_rating, home_tier,home_image,home_extra_details  FROM homes INNER JOIN home_owners ON homes.home_owner_id = home_owners.id INNER JOIN users ON home_owners.user_id = users.id INNER JOIN subcounties ON homes.address = subcounties.id INNER JOIN counties ON subcounties.county_id = counties.id WHERE homes.id = '$home_id'";
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

   public function fetchDashboardVisitor($ip_address, $home_id)
   {
      return "SELECT COALESCE(COUNT(id),0) as sum FROM home_dashboard_views WHERE ip_address = '$ip_address' AND home_id = '$home_id'";
   }

   public function increaseUniqueVisitorCount($home_id)
   {
      return "UPDATE homes SET dashboard_views = dashboard_views + '1' WHERE id = '$home_id'";
   }

   public function addUniqueVisitor($ip_address, $home_id)
   {
      $query = new Database();
      return $query->insert("home_dashboard_views", array('home_id' => $home_id, 'ip_address' => $ip_address));
   }

   public function searchAvailableHomes($swimming_pool, $wifi, $tv, $ac, $capacity, $gym, $parking, $wheelchair, $pets, $kids, $workers, $security, $garden, $smokers, $county, $subcounty, $enddate)
   {
      return "SELECT subquery.home_id as home_id, subquery.name as name, subquery.county as county, subquery.subcounty as subcounty, subquery.average_rating as average_rating, subquery.home_tier as home_tier, subquery.home_image as home_image, subquery.availability_start_date,subquery.availability_end_date,subquery.home_availability_status FROM (SELECT homes.id as home_id, name, county, subcounty, homes.average_rating as average_rating, home_tier,home_image,availability_start_date,availability_end_date,home_availability_status, swimming_pool, wifi, tv, ac, private_gym, home_workers,security_guard,private_garden FROM homes INNER JOIN home_availability ON home_availability.home_id = homes.id INNER JOIN subcounties ON homes.address = subcounties.id INNER JOIN counties ON subcounties.county_id = counties.id INNER JOIN home_features ON homes.id = home_features.home_id WHERE home_status = '1' AND home_availability_status = '1' OR home_availability_status = '2' AND capacity >= '$capacity' AND wheelchair_accessibility >= '$wheelchair' AND kids_friendly >= '$kids' AND pets_allowed >= '$pets' AND smokers_allowed >= '$smokers' AND parking >= '$parking' AND county = '$county' AND date(availability_end_date) >= date('$enddate')) subquery WHERE subquery.swimming_pool = '$swimming_pool' OR subquery.wifi = '$wifi' OR subquery.tv = '$tv1'OR subquery.ac = '$ac' OR subquery.private_gym = '$gym1' OR subquery.home_workers = '$workers' OR subquery.security_guard = '$security' OR subquery.private_garden = '$garden' OR subquery.subcounty = '$subcounty'";
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

   public function fetchHomesInLocation($location)
   {
      return "SELECT homes.id as home_id, first_name, last_name, name, county, subcounty, homes.average_rating as average_rating, home_tier,home_image,home_extra_details,availability_start_date,availability_end_date,home_availability_status,extra_details FROM homes INNER JOIN home_owners ON homes.home_owner_id = home_owners.id INNER JOIN users ON home_owners.user_id = users.id INNER JOIN subcounties ON homes.address = subcounties.id INNER JOIN counties ON subcounties.county_id = counties.id INNER JOIN home_availability ON home_availability.home_id = homes.id WHERE home_status = '1' AND (home_availability_status = '1' OR home_availability_status = '2') AND (county = '$location' OR subcounty = '$location')";
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