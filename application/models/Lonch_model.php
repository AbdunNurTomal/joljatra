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
	public function lonch_by_group($group_id){
        $result = $this->db->get_where('lonch', array('group_id'=>$group_id));
        return $result->result();
    }
	public function schedule_by_lonch($lonch_id){
        $result = $this->db->get_where('lonch_schedules', array('lonch_id'=>$lonch_id));
        return $result->result();
    }
	public function get_booking_list_by_lonch($lonch){
		$sql="Select `cabin_booking_list`.`schedule_id`,`cabin_boking`.`transaction_type`,SUM(`total_cabin`)as 'total_cabin',SUM(`total_price`)as 'total_price',SUM(`actual_price`)as 'actual_price',SUM(`discount_price`)as 'discount_price'
			  from `cabin_boking`
			  INNER JOIN `cabin_booking_list` ON `cabin_boking`.`id`=`cabin_booking_list`.`booking_id`
			  WHERE `cabin_boking`.`lonch_id`='".$lonch."'
              group by `transaction_type`,`schedule_id`";
		$query = $this->db->query($sql);
		$pata=array();
		if($query->num_rows() > 0){
			$total_actual=$total_cabin=0;
			foreach ($query->result() as $row) {
				$data=array();
				$data['t_type'] = $row->transaction_type;
				$data['schedule'] = $this->get_schedule_by_id($row->schedule_id);
				$data['cabin'] = $row->total_cabin;
				$total_cabin = $total_cabin + $data['cabin'];
				$data['actual'] = $row->actual_price;
				$total_actual = $total_actual + $data['actual'];
				$pata[]=$data;
			}
			//if($total_actual && $total_sells && $total_commission){
				$data['t_type'] = '';
				$data['schedule'] = 'Total';
				$data['cabin'] = $total_cabin;
				$data['actual'] = $total_actual;
				//$data['sells'] = $total_sells;
				//$data['commission'] = $total_commission;
				
				$pata[]=$data;
			//}
		}
		//print_r($pata);exit;
        return $pata;
	}	
	public function get_schedule_by_id($schedule_id){
		$result = $this->db->get_where('lonch_schedules', array('id'=>$schedule_id));
        $schedule = $result->row(0);
		if(isset($schedule)&&($schedule->from_destination!=NULL)&&($schedule->to_destination!=NULL)){ $name=$schedule->from_destination.'~'.$schedule->to_destination.' ('.$schedule->day.'|'.$schedule->time.')'; }
		else { $name=''; }
        return $name;
	}
	public function get_schedule_by_id_new($lonch_id,$schedule_id){
		$result = $this->db->get_where('lonch_schedules', array('id'=>$schedule_id,'lonch_id'=>$lonch_id));
        return $result->row(0);
	}
	public function get_from_destination_eng($from_destination){
        $result = $this->db->get_where('destinations', array('name'=>$from_destination));
        return $result->row(0)->name_eng;
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
	public function get_lonch_by_group($group_id){
        $result = $this->db->get_where('lonch', array('group_id'=>$group_id));
        return $result->result();
    }
    public function get_floor($floor_id){
        $result = $this->db->get_where('lonch_floors', array('id'=>$floor_id));
        return $result->row(0);
    }
	/////////////
	public function get_floor_by_name_plan($f_id,$lonch_id,$f_name){
		$result = $this->db->get_where('lonch_floors', array('id'=>$f_id,'lonch_id'=>$lonch_id,'floor_name'=>$f_name));
        return $result->row(0);
	}
	public function get_floor_by_plan($floor_id){
        $result = $this->db->get_where('lonch_floors', array('id'=>$floor_id));
        return $result->row(0);
    }
	////////////
    public function get_lonch_floors($lonch_id){
        $result = $this->db->get_where('lonch_floors', array('lonch_id'=>$lonch_id));
		$pata=array();
		if($result->num_rows() > 0){
			$total_actual=$total_sells=$total_commission=$total_cabin=0;
			foreach ($result->result() as $row) {
				$data=array();
				$data['id'] = $row->id;
				$data['schedule'] = $this->get_lonch_schedule_name($row->id,$lonch_id);
				$data['floor_name'] = $row->floor_name;
				$data['actual'] = $row->cabin_price;
				$total_actual = $total_actual + $data['actual'];
				$data['sells'] = $row->cabin_sells_price;
				$total_sells = $total_sells + $data['sells'];
				$data['commission'] = $row->cabin_commission;
				$total_commission = $total_commission + $data['commission'];
				$data['cabin'] = $row->cabin;
				$total_cabin = $total_cabin + $data['cabin'];
				$pata[]=$data;
			}
			//if($total_actual && $total_sells && $total_commission){
				$data['id'] = '';
				$data['schedule'] = '';
				$data['floor_name'] = 'Total';
				$data['actual'] = $total_actual;
				$data['sells'] = $total_sells;
				$data['commission'] = $total_commission;
				$data['cabin'] = $total_cabin;
				$pata[]=$data;
			//}
		}
		//print_r($pata);exit;
        return $pata;
    }
	 public function get_lonch_floors_data($lonch_id){
        $result = $this->db->get_where('lonch_floors', array('lonch_id'=>$lonch_id));
        return $result->result();
    }
	public function get_lonch_floors_data_new($lonch_id,$schedule_id){
        $result = $this->db->get_where('lonch_floors', array('lonch_id'=>$lonch_id,'id'=>$schedule_id));
        return $result->result();
    }
	public function get_lonch_floors_name_data($lonch_id,$schedule_id){
        $result = $this->db->get_where('lonch_floors', array('lonch_id'=>$lonch_id,'id'=>$schedule_id));
        return $result->row(0);
    }
    public function get_lonch_schedules($lonch_id){
        $result = $this->db->get_where('lonch_schedules', array('lonch_id'=>$lonch_id));
        return $result->result();
    }
	public function get_lonch_schedule_name($schedule_id,$lonch_id){
        $result = $this->db->get_where('lonch_schedules', array('id'=>$schedule_id,'lonch_id'=>$lonch_id));
		$schedule ='';
		if($result->num_rows() > 0){
			foreach ($result->result() as $row) {
				$schedule = $row->from_destination.' ~ '.$row->to_destination.' ('.$row->time.')';
			}
		}
        return $schedule;
    }
  
    // return single schedule
    public function get_schedule_by_day($lonch_id, $day, $from_destination, $to_destination){
        $result = $this->db->get_where('lonch_schedules', array('lonch_id'=>$lonch_id, 'day'=>$day, 'from_destination'=>$from_destination, 'to_destination'=>$to_destination));
        return $result->row(0);
    }
	/////////////
	public function get_schedule_by_day_new($lonch_id, $day, $from_destination, $to_destination,$schedule_id){
		if($this->session->userdata('site_lang')=='bd'){
			$result = $this->db->get_where('lonch_schedules', array('id'=>$schedule_id,'lonch_id'=>$lonch_id, 'day'=>$day, 'from_destination'=>$from_destination, 'to_destination'=>$to_destination));
		}else if($this->session->userdata('site_lang')=='en'){
			$result = $this->db->get_where('lonch_schedules', array('id'=>$schedule_id,'lonch_id'=>$lonch_id, 'day'=>$day, 'from_destination_eng'=>$from_destination, 'to_destination_eng'=>$to_destination));
		}
        return $result->row(0);
    }
	public function get_schedule_by_day_new_offline($lonch_id, $day, $from_destination, $to_destination,$schedule_id){
		$result = $this->db->get_where('lonch_schedules', array('id'=>$schedule_id,'lonch_id'=>$lonch_id, 'day'=>$day, 'from_destination'=>$from_destination, 'to_destination'=>$to_destination));
        return $result->row(0);
    }
	////////////
    
    // return all schedule
    public function get_schedules_by_day($lonch_id, $day, $from_destination, $to_destination){
		if($this->session->userdata('site_lang')=='bd'){
			$result = $this->db->get_where('lonch_schedules', array('lonch_id'=>$lonch_id, 'day'=>$day, 'from_destination'=>$from_destination, 'to_destination'=>$to_destination));
		}else if($this->session->userdata('site_lang')=='en'){
			$result = $this->db->get_where('lonch_schedules', array('lonch_id'=>$lonch_id, 'day'=>$day, 'from_destination_eng'=>$from_destination, 'to_destination_eng'=>$to_destination));
		}
        return $result->result();
    }
	public function get_schedules_by_day_offline($lonch_id, $day, $from_destination, $to_destination){
		$result = $this->db->get_where('lonch_schedules', array('lonch_id'=>$lonch_id, 'day'=>$day, 'from_destination'=>$from_destination, 'to_destination'=>$to_destination));
        return $result->result();
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
	// this function for all discount lonch
	public function all_discount_lonch(){
		$result = $this->db->get_where('lonch','discount_status!=\'non\'');
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
	 // this function for get all lonch for perticula user
    public function get_all_discount_lonch($owner_id=null){
        
        if($this->user_type=='admin' and $owner_id!=null){
            return $this->lonch_by_owner($owner_id);
        }
        elseif($this->user_type=='admin' and $owner_id==null){
            return $this->all_discount_lonch();
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
    
    public function get_cabin_plans($lonch_id, $floor_id, $floor_cabin, $floor_name){
		$floor_name = str_replace('%20', ' ', $floor_name);
        $result = $this->db->get_where('cabin_plan', array('id'=>$floor_id, 'lonch_id'=>$lonch_id, 'floor_id'=>$floor_id, 'floor_name'=>$floor_name));
		$count=1;
		if($result->num_rows() > 0){
			$pata=array();
			foreach ($result->result() as $row) {
				$data=array();
				$data['cabin'] = $row->cabin_number;
				$data['actual_price'] = $row->actual_price;
				$data['sells_price'] = $row->sells_price;
				$data['commission'] = $row->commission;
				$pata[]=$data;
				$count++;
			}
			for($i=$count;$i<=$floor_cabin;$i++){
				$data=array();
				$data['cabin'] = $i;
				$data['actual_price'] = '';
				$data['sells_price'] =  '';
				$data['commission'] = '';
				$pata[]=$data;
			}   
			return $pata; 
		}else{
			return false;
		}	
    }
    public function single_cabin_plan($floor_name, $schedule, $lonch_id, $floor_id, $cabin_number){
		//echo $floor_name.'~'.$schedule.'~'.$lonch_id.'~'.$floor_id.'~'.$cabin_number;exit;
        $result = $this->db->get_where('cabin_plan', array('id'=>$schedule, 'lonch_id'=>$lonch_id, 'floor_id'=>$floor_id, 'floor_name'=>$floor_name, 'cabin_number'=>$cabin_number));
        return $result->row(0);
    }
    // check single boking is ok or not 
    public function check_single_booking($floor_name,$lonch_id, $floor_id, $schedule_id, $cabin_number, $journey_date){
        $this->db->where("journey_date BETWEEN '$journey_date' AND '$journey_date'");
        $result =  $this->db->where(array('lonch_id'=>$lonch_id, 'floor_id'=>$floor_id, 'floor_name'=>$floor_name, 'schedule_id'=>$schedule_id, 'cabin_number'=>$cabin_number, 'journey_date'=>$journey_date))->get('cabin_booking_list');
        return $result->result();
    }

}