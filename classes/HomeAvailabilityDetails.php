<?php
class HomeAvailabilityDetails{
    
    public function AddHomeAvailability($home_id, $start_date, $end_date, $extra_details)
    {
        $query = new Database();
        return $query->insert("home_availability", array('home_id' => $home_id,'availability_start_date' => $start_date,'availability_end_date' => $end_date,  'extra_details' => $extra_details ));
    }

    public function UpdateHomeAvailability($availability_id, $home_id, $start_date, $end_date, $extra_details)
    {
        $query = new Database();
        return $query->update("home_availability", "id", $availability_id, array('home_id' => $home_id, 'availability_start_date' => $start_date, 'availability_end_date' => $end_date, 'extra_details' => $extra_details));
    }

    public function RemoveHomeAvailability($availability_id)
    {
        $query = new Database();
        return $query->delete("home_availability",$availability_id);
    }

}