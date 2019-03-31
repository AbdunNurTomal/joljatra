<?php
class Booking_model extends MY_Model{
	function __construct(){
        parent::__construct();
        date_default_timezone_set('Asia/Dhaka');
        
        $this->passenger_id=null;
        $this->total_cabin=null;
        $this->cabins=array();
        $this->total_price=null;
		$this->total_actual_price=null;
		$this->total_payable_price=null;
		$this->discount_price=null;
        $this->transaction_id=null;
        $this->transaction_type=null;
        $this->order_ac_type=null;
        $this->order_ac_id=null;
        $this->lonch_id=null;
        $this->journey_date=null;
        $this->from_destination=null;
        $this->to_destination=null;
        $this->passenger_name=null;
        $this->passenger_phone=null;
        // single cabin extra 
        $this->booking_id=null;
        $this->cabin_number=null;
        $this->floor_id=null;
		$this->floor_name=null;
        $this->schedule_id=null;
        $this->cabin_price=null;
        $this->schedule_day=null;
        $this->schedule_time=null;
        $this->journey_date=null;
    }
	
	function get_passenger_id($passenger_name,$passenger_phone){
		$result = $this->db->where(array('user_name'=>$passenger_name, 'phone'=>$passenger_phone))->get('users');
		$passenger = $result->row(0);
		if(isset($passenger)&&($passenger->id!='')){ $id=$passenger->id; }
		else { $id=''; }
        return $id;
	}
	function get_passenger_id_by_phone($passenger_phone){
		$result = $this->db->where(array('phone'=>$passenger_phone))->get('users');
		$passenger = $result->row(0);
		if(isset($passenger)&&($passenger->id!='')){ $id=$passenger->id; }
		else { $id=''; }
        return $id;
	}
	function get_passenger_phone_by_id($passenger_id){
		$result = $this->db->where(array('id'=>$passenger_id))->get('users');
		$passenger = $result->row(0);
		if(isset($passenger)&&($passenger->phone!=NULL)){ $phone=$passenger->phone; }
		else { $phone=''; }
        return $phone;
	}
	function get_passenger_name_by_id($passenger_id){
		$result = $this->db->where(array('id'=>$passenger_id))->get('users');
		$passenger = $result->row(0);
		if(isset($passenger)&&($passenger->first_name!=NULL)&&($passenger->last_name!=NULL)){ $name=$passenger->first_name.' '.$passenger->last_name; }
		else { $name=''; }
        return $name;
	}
	
    // add booking on database 
    public function offline_booking($group_id,$f_name,$lonch_id, $from_destination, $to_destination, $journey_date, $cabins, $f_id, $s_id, $passenger_name, $passenger_phone,$passenger_id){
		//echo $group_id.'~'.$f_name.'~'.$lonch_id.'~'.$from_destination.'~'.$to_destination.'~'.$journey_date.'~'.$cabins.'~'.$f_id.'~'.$s_id.'~'.$passenger_name.'~'.$passenger_phone.'~'.$passenger_id;
        // set all the varable of tables 
        $this->from_destination=$from_destination;
        $this->to_destination=$to_destination;
        $this->journey_date=$this->make_db_time($journey_date);
		
		$this->lonch_id=$lonch_id;
		$this->schedule_id=$s_id;
		$this->floor_id=$f_id;
		$this->floor_name=$f_name;
        //$this->cabins=$cabins;
		$cabins = explode(',',$cabins);
        $this->total_cabin=count($cabins);
        
        
        $this->order_ac_type=$this->session->userdata('current_user_type');
        $this->order_ac_id=$this->session->userdata('current_user_id');
        $this->schedule_day=$this->get_day($journey_date);
        
		$this->passenger_id=$passenger_id;
        $this->passenger_name=$passenger_name;
        $this->passenger_phone=$passenger_phone;
                
        // if seet pricess set the cabin pricess
        if($cabins){
            //$floor = $this->lonch_model->get_floor($f_id);
            //if($floor){
            //    //$floor_price=$floor->cabin_price;
			//	$floor_name=$floor->floor_name;
            //}
            foreach($cabins as $cabin){
                $single_cabin_plan = $this->lonch_model->single_cabin_plan($f_name,$f_id,$lonch_id, $f_id, $cabin);
                $seet_title=null;
				//print_r($single_cabin_plan);
                if($single_cabin_plan){
                    //$cabin_type_id = $single_cabin_plan->cabin_type_id;
                    //$cabin_type = $this->lonch_model->get_cabin_type($cabin_type_id);
                    //if($cabin_type){
                    //   
                    //    $seet_price = $cabin_type->price;
                    //}else{
                    //   
                    //    $seet_price=$floor_price;
                    //}
					$seet_price=$single_cabin_plan->sells_price;
                }else{
                   
                    $seet_price='';
                }
                
                $this->total_price+=$seet_price;
                $this->cabins[$cabin]=$seet_price;
            }
			$t_type ="offline";
			$discount=$this->get_discount_price($t_type,$group_id,$this->lonch_id,$f_id,$f_id,$this->passenger_id,$this->passenger_phone,$this->journey_date);
			//print_r($discount);exit;
			if(isset($discount)&&(count($discount)>0)){
				$exact_discount=max($discount);
				$this->discount_price = ($exact_discount*$this->total_price)/100;
				$this->total_actual_price=$this->total_price;
				$this->total_payable_price=($this->total_price-$this->discount_price);
			}else{
				$this->discount_price = 0;
				$this->total_actual_price=$this->total_price;
				$this->total_payable_price=$this->total_price;
			}
        }
        //make a attributes of database
        $booking_attr=array(
            'total_cabin'=>$this->total_cabin,
            'total_price'=>$this->total_payable_price,
			'actual_price'=>$this->total_actual_price,
			'discount_price'=>$this->discount_price,
            'transaction_type'=>$t_type,
            'order_ac_type'=>$this->order_ac_type,
            'order_ac_id'=>$this->order_ac_id,
            'lonch_id'=>$this->lonch_id,
            'journey_date'=>$this->journey_date,
            'from_destination'=>$this->from_destination,
            'to_destination'=>$this->to_destination,
			'passenger_id'=>$this->passenger_id,
            'passenger_name'=>$this->passenger_name,
            'passenger_phone'=>$this->passenger_phone,
            'status'=>'complete',
            'order_date'=>date('Y-m-d H:i:s'),
        );
        
        $errors=array();
        if($this->db->insert('cabin_boking', $booking_attr)){
            $this->booking_id=$this->db->insert_id();
        }else{$errors[]='not booking insert';}
        
        // if the schedule id the make a list of cabins
        if($this->booking_id){
            if($this->add_booking_list()){
                return $this->booking_id;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    
    //this function for add booking lis 
    public function add_booking_list(){
        $error=array();
        $booking_list_attr=array(
            'booking_id'=>$this->booking_id,
            'floor_id'=>$this->floor_id,
			'floor_name'=>$this->floor_name,
            'schedule_id'=>$this->schedule_id,
            'schedule_day'=>$this->schedule_day,
            'journey_date'=>$this->journey_date,
            'lonch_id'=>$this->lonch_id,
            'from_destination'=>$this->from_destination,
            'to_destination'=>$this->to_destination
        );
        //print_r($this->cabins);exit;
        if($this->cabins){
            foreach($this->cabins as $cabin_number=>$cabin_price){
                
                $booking_list_attr['cabin_number']=$cabin_number;
                $booking_list_attr['cabin_price']=$cabin_price;
                
                if($this->db->insert('cabin_booking_list', $booking_list_attr)){
                    //nothing
                }else{
                    $error[]='List making errors';
                }
            }
        }
        if(!$error){return true;}else{return false;}
    }
    
    // this function for get day of journy
    public function get_day($journey_date){
        $date_parts = explode('/', $journey_date);
        return $day = date('l',mktime(0, 0, 0, $date_parts[1], $date_parts[0], $date_parts[2]));
    }
    //this method for make db time
    public function make_db_time($journey_date){
        $search_date=null;
        if($journey_date){
            $date_parts = explode('/', $journey_date);
            $search_date = $date_parts[2].'-'.$date_parts[1].'-'.$date_parts[0];
        }
        return $search_date;
    }
    
    // make drafts for online 
    public function make_order_draft($query, $user){
        $query = $_GET;
        //print_r($query);exit;
        
		$group_id=$query['group_id'];
		
		$this->from_destination=$query['from_destination'];
        $this->to_destination=$query['to_destination'];
        $this->journey_date=$this->make_db_time($query['journey_date']);
        $this->lonch_id=$query['lonch_id'];
		$this->schedule_id=$query['s_id'];
		$this->floor_id=$query['f_id'];
		$this->floor_name=$query['floor_name'];
        //$this->cabins=$cabins;
        $this->total_cabin=count($query['cabins']);
        
        $this->order_ac_type=$this->session->userdata('current_user_type');
        $this->order_ac_id=$this->session->userdata('current_user_id');
        $this->schedule_day=$this->get_day($query['journey_date']);
        
		$this->passenger_id=$user->id;
        $this->passenger_name=$user->first_name.' '.$user->last_name;
        $this->passenger_phone=$user->phone;
        
        // if seet pricess set the cabin pricess
        if($query['cabins']){
            //$floor = $this->lonch_model->get_floor($query['f_id']);
            //if($floor){
            //    //$floor_price=$floor->cabin_price;
			//	$floor_name=$floor->floor_name;
            //}
            foreach($query['cabins'] as $cabin){
                $single_cabin_plan = $this->lonch_model->single_cabin_plan($this->floor_name,$this->floor_id,$this->lonch_id,$this->floor_id,$cabin);
                $seet_title=null;

                if($single_cabin_plan){
                    //$cabin_type_id = $single_cabin_plan->cabin_type_id;
                    //$cabin_type = $this->lonch_model->get_cabin_type($cabin_type_id);
                    //if($cabin_type){
                    //   
                    //    $seet_price = $cabin_type->price;
                    //}else{
                    //   
                    //    $seet_price=$floor_price;
                    //}
					$seet_price=$single_cabin_plan->sells_price;
                }else{
                    $seet_price='';
                }
                
                $this->total_price+=$seet_price;
                $this->cabins[$cabin]=$seet_price;
            }
			$t_type ="online";
			$discount=$this->get_discount_price($t_type,$group_id,$this->lonch_id,$this->floor_id,$this->floor_id,$this->passenger_id,$this->passenger_phone,$this->journey_date);
			//print_r($discount);exit;
			if(isset($discount)&&(count($discount)>0)){
				$exact_discount=max($discount);
				$this->discount_price = ($exact_discount*$this->total_price)/100;
				$this->total_actual_price = $this->total_price;
				$this->total_payable_price = ($this->total_price-$this->discount_price);
			}else{
				$this->discount_price = 0;
				$this->total_actual_price=$this->total_price;
				$this->total_payable_price=$this->total_price;
			}
        }
        //echo $this->discount_price.'~'.$this->total_actual_price.'~'.$this->total_payable_price;exit;
        //make a attributes of database
        $booking_attr=array(
            'total_cabin'=>$this->total_cabin,
            'total_price'=>$this->total_payable_price,
			'actual_price'=>$this->total_actual_price,
			'discount_price'=>$this->discount_price,
            'transaction_type'=>'online',
            'order_ac_type'=>$this->order_ac_type,
            'order_ac_id'=>$this->order_ac_id,
            'lonch_id'=>$this->lonch_id,
            'journey_date'=>$this->journey_date,
            'from_destination'=>$this->from_destination,
            'to_destination'=>$this->to_destination,
			'passenger_id'=>$this->passenger_id,
            'passenger_name'=>$this->passenger_name,
            'passenger_phone'=>$this->passenger_phone,
            'order_date'=>date('Y-m-d H:i:s'),
            'status'=>'draft',
        );
		//print_r($booking_attr);exit;
        
        $errors=array();
        if($this->db->insert('cabin_boking', $booking_attr)){
            $this->booking_id=$this->db->insert_id();
        }else
        {$errors[]='not booking insert';}
        
        // if the schedule id the make a list of cabins
        if($this->booking_id){
            if($this->add_booking_list()){
                return $this->booking_id;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    
    
    //public function make products 
	public function cabin_list($query){
		$seet_title=null;
		$seet_price=0;
		$products=array();
		//print_r($query);exit;
		foreach($query['cabins'] as $cabin){
			$single_cabin_plan = $this->lonch_model->single_cabin_plan($query['floor_name'],$query['f_id'],$query['lonch_id'], $query['f_id'], $cabin);
			$seet_title=null;

			if($single_cabin_plan){
				//$cabin_type_id = $single_cabin_plan->cabin_type_id;
				//$cabin_type = $this->lonch_model->get_cabin_type($cabin_type_id);
				//if($cabin_type){
				//   $seet_title = $cabin_type->title;
				//    $seet_price = $cabin_type->price;
				//}else{
				//   $seet_title='G';
				//    $seet_price=$floor_price;
				//}
				$seet_price=$single_cabin_plan->sells_price;
			}else{
				$seet_title='';
				$seet_price='';
			}
			
			$products[]=array('name' => 'Cabin'.$cabin.$seet_title,'price' => $seet_price,'quantity' => 1);
		}
		return $products;
	}
    
    
    // return booking by list 
    public function get_booking($booking_id){
         $result = $this->db->where('id', $booking_id)->get('cabin_boking');
        return $result->row(0);
    }
    // return booking by list 
    public function get_booking_list($booking_id){
         $result = $this->db->where('booking_id', $booking_id)->get('cabin_booking_list');
        return $result->result();
    }
    // return booking by list 
    public function get_booking_list_single($booking_id){
        $result = $this->db->where('booking_id', $booking_id)->get('cabin_booking_list');
        return $result->row(0);
    }
    //this method for passneger order list (completed)
    public function passenger_order_list($user_id){
		$result = $this->db->query("SELECT * FROM `cabin_boking` WHERE (`passenger_id`='$user_id' or `order_ac_id`='$user_id') and `status`='complete'");
        return $result->result();
    }
    
	//this method for passneger order list (pending)
    public function passenger_pending_order_list($user_id){
		$result = $this->db->query("SELECT * FROM `cabin_boking` WHERE (`passenger_id`='$user_id' or `order_ac_id`='$user_id') and `status`='draft'");
        return $result->result();
    }
    
    // This function for check time out drafts of booking
    public function check_booking_schedule($s_day,$s_time,$time_out=30){
        $booking_ids=null;
		$s_time = date('h:i A', strtotime($s_time));
		$s_time = explode(' ',$s_time);
		if($s_time[1]=='PM') { 
			$schedule = explode(':', $s_time[0]); 
			$sch = ($schedule[0]+12).':'.$schedule[1]; 
			$sch = strtotime($sch);
		}else{
			$schedule = explode(':', $s_time[0]); 
			$sch = $schedule[0].':'.$schedule[1]; 
			$sch = strtotime($sch);
		}
		$curr_time = strtotime(date('H:i'));
		
		$curr_day = $this->get_day(date('d/m/Y')); 
		if($curr_day==$s_day){
			if($curr_time<$sch){
				$time_diff = $this->timeDiff($curr_time,$sch, false);
			}else{
				$time_diff = $this->timeDiff($sch,$curr_time, false);
			}
			
			//echo $time_diff;//exit;
			if($time_diff<=$time_out){
				return false;
			}else{
				return true;
			}
		}
    }
	function timeDiff($time_start = null, $time_end = null, $hour_mode = false){
		//$to_time = strtotime($time_start);
		//$from_time = strtotime($time_end);
		$to_time = $time_start;
		$from_time = $time_end;
		//echo $to_time.'~'.$from_time;
		
		$hour = 0;

		if ($hour_mode) { // Outputs in hours i.e. 8.50, 10.32
			$hour = round(abs($to_time - $from_time) / 60 / 60, 1); 
		}else {
			$hour = round(abs($to_time - $from_time) / 60, 1); // Outputs in minutes i.e. 3360, 500
		}    
//echo $hour;
		//if ($time_end < $time_start) {
		//	if ($hour_mode) {   
		//		$hour -= 24; // outputs in hours         
		//	}else {
		//		$hour -= 1440; // outputs in minutes
		//	}
		//}
		//$hour -= 1440; // outputs in minutes
		return abs($hour);
	}
	// This function for check time out drafts of booking
    public function delete_time_out_drafts($time_out=30){
        $booking_ids=null;
        $curr = date('Y-m-d H:i:s'); 
        $last_min = date('Y-m-d H:i:s', strtotime('-'.$time_out.' minutes'));
        $this->db->where('status', 'draft');
        $this->db->where('order_date <=', $last_min);
        $result = $this->db->get('cabin_boking');
        $drafts = $result->result();
       
        if($drafts){
            foreach($drafts as $draft){
                $booking_ids[]=$draft->id;
            }
        }
         
        $this->remove_cabin_booking_list($booking_ids);
        $this->remove_cabin_booking($booking_ids);
    }
    
    // remove un time out cabin book
    public function remove_cabin_booking($booking_ids){
        if($booking_ids){
            $this->db->where_in('id', $booking_ids);
            $this->db->delete('cabin_boking');
        }
    }
    //remove time out cabin booking list 
    public function remove_cabin_booking_list($booking_ids){
        if($booking_ids){
            $this->db->where_in('booking_id', $booking_ids);
            $this->db->delete('cabin_booking_list');
        }
    }
	public function new_discount_rules(){
		$discount=array(
			'transaction_type'=>$this->input->get('transaction_type'),
            'travel'=>$this->input->get('travel'),
            'p_phone'=>$this->input->get('passenger_phone'),
			'p_id'=>$this->get_passenger_id_by_phone($this->input->get('passenger_phone')),
            'percentage'=>$this->input->get('discount_percent'),
			'group_id'=>$this->input->get('group'),
            'lonch_id'=>$this->input->get('lonch'),
            'schedule_id'=>$this->input->get('schedule'),
			'floor_id'=>$this->input->get('floor'),
			'journey_from_date'=>$this->make_db_time($this->input->get('from_date')).' 0:0:0',
			'journey_to_date'=>$this->make_db_time($this->input->get('to_date')).' 23:59:59',
			'create_ac_type'=>$this->session->userdata('current_user_type'),
			'create_ac_id'=>$this->session->userdata('current_user_id'),
            'status'=>'active'
        );
		if(isset($discount)){
			if($this->db->insert('discount_plan', $discount)){
				$this->discount_id=$this->db->insert_id();
			}else{
				$errors[]='not discount insert';
			}
			// if the schedule id the make a list of cabins
			if($this->discount_id){
				unset($discount);
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	public function all_discount_rules(){
		$result = $this->db->get('discount_plan');
        return $result->result();
	}
	public function all_discount_rules_for_user(){
		$result = $this->db->where('status', 'active')->get('discount_plan');
        return $result->result_array();
	}
	public function get_discount_price($t_type,$g_id,$l_id,$s_id,$f_id,$p_id,$p_phone,$journey_date){
		//$result=$t_type.'~'.$g_id.'~'.$l_id.'~'.$s_id.'~'.$f_id.'~'.$p_id.'~'.$p_phone.'~'.$journey_date; echo $result;
		$discount_rules = $this->all_discount_rules_for_user(); //print_r($discount_rules);//exit;
		$result = array();
		for($i=0;$i<count($discount_rules);$i++){
			$res='';
			$all_date = $this->dateRange($discount_rules[$i]['journey_from_date'], $discount_rules[$i]['journey_to_date']);
			$journey_date = $this->convertString($journey_date);
			$count_travel = $this->count_passenger_travel($p_id,$p_phone);
			
			if(($discount_rules[$i]['group_id']==$g_id)||($discount_rules[$i]['lonch_id']==$l_id)||($discount_rules[$i]['schedule_id']==$s_id)||($discount_rules[$i]['floor_id']==$f_id)){ 
				$res=$discount_rules[$i]['percentage']; 
				//echo 'Extra - '.$res;	
			}
			if(($discount_rules[$i]['p_id']!='0')&&($discount_rules[$i]['p_phone']!='')){
				if(($discount_rules[$i]['p_id']==$p_id)&&($discount_rules[$i]['p_phone']==$p_phone)){
					$res=$discount_rules[$i]['percentage'];
				}else{ $res=''; }
				//echo 'passenger - '.$res.' >'.$discount_rules[$i]['p_id'].' '.$p_id.' ~ '.$discount_rules[$i]['p_phone'].' '.$p_phone;	
			}	
			if(($discount_rules[$i]['journey_from_date']!='0000-00-00')&&($discount_rules[$i]['journey_to_date']!='0000-00-00')){
				if(in_array($journey_date,$all_date,TRUE)){ 
					$res=$discount_rules[$i]['percentage']; 
				}else{ $res=''; }
				//echo 'date - '.$res;	
			}
			if($discount_rules[$i]['travel']!='0'){
				if($discount_rules[$i]['travel']<=$count_travel){ $res=$discount_rules[$i]['percentage']; }else{ $res=''; }
				//echo 'travel - '.$res;	
			}

			if($discount_rules[$i]['transaction_type']!=''){
				if($discount_rules[$i]['transaction_type']==$t_type){ $res=$discount_rules[$i]['percentage']; }else{ $res=''; }
				//echo 'transaction - '.$res;	
			}

			if($res!=''){ $result[]=$res; }	
		}
		//print_r($result);exit;
		return $result;
	}
	public function count_passenger_travel($p_id,$p_phone){
		$result = $this->db->query("SELECT count(`id`) as 'travel' FROM `cabin_boking` WHERE `passenger_id`='$p_id' and `passenger_phone`='$p_phone' and `status`='complete'");
        $passenger = $result->row(0);
		if($passenger->travel!=''){ $travel=$passenger->travel; }
		else { $travel=''; }
        return $travel;
	}
	function dateRange($startDate, $endDate) {
		$tmpDate = new DateTime($startDate);
		$tmpEndDate = new DateTime($endDate);

		$outArray = array();
		do {
			$outArray[] = $tmpDate->format('Y-m-d');
		} while ($tmpDate->modify('+1 day') <= $tmpEndDate);

		return $outArray;
	}
	function convertString ($date){ 
        $sec = strtotime($date); 
        $date = date("Y-m-d", $sec); 
        //echo $date; 
		return $date;
    } 
}
?>