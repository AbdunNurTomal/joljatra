<?php
class Lonch_model extends CI_Model {
    public function __construct(){
        parent:: __construct();
        $this->user_type = $this->session->userdata('current_user_type');
        
    }
    // this function for change number
    public function entobn($number){
        $search_array= array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০", 'দিন', 'দিন', 'দিন', 'দিন', 'ঘন্টা', 'ঘন্টা', 'ঘন্টা', 'ঘন্টা', "মিনিট", "মিনিট", "মিনিট", "মিনিট");
        $replace_array= array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0", "day", "Day", "days", "Days", "Hour", "hour", "Hours", "hours", "Minute", "minitue", "Minitues", "minitues");
        $en_number = str_replace( $replace_array, $search_array, $number);
        $en_number = rtrim($en_number, 's');

        return $en_number;
    }

    public function lonch_by_owner($owner_id){
        $result = $this->db->get_where('lonch', array('owner_id'=>$owner_id));
        return $result->result();
    }
    
    public function lonch_groups(){
        $result = $this->db->get('lonch_group');
        return $result->result();
    }
    public function lonch_group_by_owner($owner_id){
        $result = $this->db->get_where('lonch_group', array('owner_id'=>$owner_id));
        return $result->result();
    }
    public function get_group($group_id){
        $result = $this->db->get_where('lonch_group', array('id'=>$group_id));
        return $result->row(0);
    }
    public function get_lonch($lonch_id){
        $result = $this->db->get_where('lonch', array('id'=>$lonch_id));
        return $result->row(0);
    }
    public function get_floor($floor_id){
        $result = $this->db->get_where('lonch_floors', array('id'=>$floor_id));
        return $result->row(0);
    }
    public function get_lonch_floors($lonch_id){
        $result = $this->db->get_where('lonch_floors', array('lonch_id'=>$lonch_id));
        return $result->result();
    }
    public function get_lonch_schedules($lonch_id){
        $result = $this->db->get_where('lonch_schedules', array('lonch_id'=>$lonch_id));
        return $result->result();
    }
    public function get_schedule_by_day($lonch_id, $day, $from_destination, $to_destination){
        $result = $this->db->get_where('lonch_schedules', array('lonch_id'=>$lonch_id, 'day'=>$day, 'from_destination'=>$from_destination, 'to_destination'=>$to_destination));
        return $result->row(0);
    }
    public function get_cabin_plans($lonch_id, $floor_id){
        $result = $this->db->get_where('cabin_plan', array('lonch_id'=>$lonch_id, 'floor_id'=>$floor_id));
        return $result->result();
    }
    public function single_cabin_plan($lonch_id, $floor_id, $cabin_number){
        $result = $this->db->get_where('cabin_plan', array('lonch_id'=>$lonch_id, 'floor_id'=>$floor_id, 'cabin_number'=>$cabin_number));
        return $result->row(0);
    }
    
    
    // this function for return authonticate user lonch group
    public function get_lonch_groups($owner_id=null){
        
        if($this->user_type=='admin' and $owner_id!=null){
            return $this->lonch_group_by_owner($owner_id);
        }
        elseif($this->user_type=='admin' and $owner_id==null){
            return $this->lonch_groups();
        }elseif($this->user_type=='owner'){
            return $this->lonch_group_by_owner($this->session->userdata('current_user_id'));
        }else{
            return null;
        }
    }
    
    // this function for all lonch
    public function all_lonch(){
        $result = $this->db->get('lonch');
        return $result->result();
    }
	
    // this function for get all lonch for perticula user
    public function get_all_lonch($owner_id=null){
        
        if($this->user_type=='admin' and $owner_id!=null){
            return $this->lonch_by_owner($owner_id);
        }
        elseif($this->user_type=='admin' and $owner_id==null){
            return $this->all_lonch();
        }elseif($this->user_type=='owner'){
            return $this->lonch_by_owner($this->session->userdata('current_user_id'));
        }else{
            return null;
        }
    }
	
	public function get_all_discount_lonch($owner_id=null)(
		if($this->user_type=='admin' and $owner_id!=null){
            return $this->lonch_by_owner($owner_id);
        }
        elseif($this->user_type=='admin' and $owner_id==null){
            return $this->all_lonch();
        }elseif($this->user_type=='owner'){
            return $this->lonch_by_owner($this->session->userdata('current_user_id'));
        }else{
            return null;
        }
	}
    
    // this functio for get cabin type all
    public function get_all_cabin_type(){
        $result = $this->db->get('cabin_type');
        return $result->result();
    }
    // this functio for get cabin type by owner id
    public function get_cabin_type_by_owner($woner_id){
        $result = $this->db->where('owner_id', $woner_id)->get('cabin_type');
        return $result->result();
    }
    
    // get single cabin types by cabin type id
    public function get_cabin_type($cabin_type_id){
        $result = $this->db->get_where('cabin_type', array('id'=>$cabin_type_id));
        return $result->row(0);
    }
    
    
    // this function for get cabin tpyes
    public function get_cabin_types($owner_id=null){
        
        if($this->user_type=='admin' and $owner_id!=null){
            return $this->get_cabin_type_by_owner($owner_id);
        }
        elseif($this->user_type=='admin' and $owner_id==null){
            return $this->get_all_cabin_type();
        }elseif($this->user_type=='owner'){
            return $this->get_cabin_type_by_owner($this->session->userdata('current_user_id'));
        }else{
            return null;
        }
    }
    
    
    // this method for get all lonch destinations
    public function lonch_destinations(){
        $result = $this->db->get('destinations');
        return $result->result();
    }
    public function get_destination($destination_id){
       $result = $this->db->get_where('destinations', array('id'=>$destination_id));
        return $result->row(0);
    }
    
    
    
    // check single boking is ok or not 
    public function check_single_booking($lonch_id, $floor_id, $schedule_id, $cabin_number, $journey_date){
        $this->db->where("journey_date BETWEEN '$journey_date' AND '$journey_date'");
        $result =  $this->db->where(array('lonch_id'=>$lonch_id, 'floor_id'=>$floor_id, 'schedule_id'=>$schedule_id, 'cabin_number'=>$cabin_number, 'journey_date'=>$journey_date))->get('cabin_booking_list');
        return $result->result();
    }

}