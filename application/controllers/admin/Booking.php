<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends Admin_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('lonch_model');
        $this->load->model('booking_model');
        $this->user_type=$this->session->userdata('current_user_type');
        $this->user_id=$this->session->userdata('current_user_id');
		$this->cabins=array();
    }
	public function index(){
        $this->all_booking();
	}
    
    public function all_booking(){
        $data=array();
        //$this->db->where('status', 'complete');
        
        if($this->input->get('from_date') and $this->input->get('to_date')){
            $this->db->where('order_date >=', $this->booking_model->make_db_time($this->input->get('from_date')).' 0:0:0');
            $this->db->where('order_date <=', $this->booking_model->make_db_time($this->input->get('to_date')).' 23:59:59');
        }else{
            $this->db->where('order_date >=', $this->booking_model->make_db_time(date('d/m/Y',time())).' 0:0:0');
            $this->db->where('order_date <=', $this->booking_model->make_db_time(date('d/m/Y',time())).' 23:59:59');
        }
		
        if($this->input->get('transaction_type')){
            $this->db->where('transaction_type', $this->input->get('transaction_type'));
        }
        
        if($this->user_type!='manager'){
            $owner_id = null;
            if($this->user_type=='admin'){ $owner_id = $this->input->get('owner_id'); }
			else{ $owner_id = $this->input->get($this->user_id); }
			
            $lonch_ids = $this->lonch_ids_by_owner($owner_id);
            if($lonch_ids){ $this->db->where_in('lonch_id', $lonch_ids); }
			else{ $this->db->where('lonch_id', null); }
        }else{
            $lonch_id = $this->manager_lonch_id();
            $this->db->where('lonch_id', $lonch_id);
        }
        if($this->input->get('lonch_id')){
             $this->db->where('lonch_id', $this->input->get('lonch_id'));
        }
        if($this->input->get('order_id')){
             $this->db->where('id', $this->input->get('order_id'));
        }
        if($this->input->get('passenger_phone')){
             $this->db->where('passenger_phone', $this->input->get('passenger_phone'));
        }
        
        //find the table 
        $this->db->order_by('id', 'DESC');
		
		//echo $this->db->get_compiled_select();exit;
		
        $result = $this->db->get('cabin_boking');
        $data['bookings'] = $result->result();
        /*echo '<pre>'; var_dump($data['bookings']); exit()*/;
                
		if($this->user_type=='admin'){
           $this->load->view('admin/booking/all_booking/admin', $data);
		}
        if($this->user_type=='owner'){
            $this->load->view('admin/booking/all_booking/owner', $data);
        }
        if($this->user_type=='manager'){
            $this->load->view('admin/booking/all_booking/manager', $data);
        }
    }
	
	public function add_discount_rules(){
		$all_discount_booking = $this->booking_model->new_discount_rules();
		if($all_discount_booking){
			redirect('admin/booking/add_discount_booking/');
		}
	}
	// this method for delete a lonch schedules
    public function delete_discount_rules($discount_id){
        if($this->db->where('id', $discount_id)->delete('discount_plan')){
			$this->session->set_userdata('success_msg', 'The discount rule deleted');
        }else{
            $this->session->set_userdata('error_msg', 'Something wrong please try again');
        }
		redirect('admin/booking/add_discount_booking/');
    }
	public function search_passenger_for_rules($t_type,$g_id,$l_id,$s_id,$f_id,$travel,$pid,$pphone,$percentage,$from,$to){
		//echo $t_type.'~'.$g_id.'~'.$l_id.'~'.$s_id.'~'.$f_id.'~'.$travel.'~'.$pid.'~'.$pphone.'~'.$percentage.'~'.$from.'~'.$to;
		
		//$sql = "select * 
		//		from `cabin_boking` 
		//		where ";
		//		if($t_type != ''){ $sql .= " `cabin_boking`.`transaction_type`='".$t_type."'"; }
		//		if($l_id != ''){ $sql .= " `cabin_boking`.`lonch_id`='".$l_id."'"; }
		//		if($from != ''){ $sql .= " and `cabin_boking`.`order_date`='".$from."'"; }
		//		else if($to != ''){ $sql .= " and `cabin_boking`.`order_date`='".$from."'"; }
		//		else { $sql .= " (`cabin_boking`.`order_date` between '".$from."' and '".$to."')";}
		//		
		//		
		//		$sql .= " order by `special`.`ins_date`";
        //
		//		echo $sql;exit;
		//		$query = $this->db->query($sql);
		//
	}
	public function add_discount_booking(){
		$data['discount_data'] = $this->booking_model->all_discount_rules();
		//print_r($data['discount_data']);
		$this->load->view('admin/booking/add_discount_booking',$data);
	}
    
    //Offline Booking
    public function offline(){
        $this->booking_model->delete_time_out_drafts($time_out=30);
		$data['destinations']=$this->lonch_model->lonch_destinations();
        if($this->input->get('search_cabin_btn')){
            $from_destination = $this->input->get('from_destination');
            $to_destination = $this->input->get('to_destination');
            $journey_date = $this->input->get('journey_date');
            $day = $this->get_day($journey_date);
            $data['day']=$day;
            $data['from_destination']=$from_destination;
            $data['to_destination']=$to_destination;
            //the ID-S of t lonches of the schedule 
            $lonch_and_group_ids = $this->find_lonch_by_schedule($from_destination, $to_destination, $day);
			//print_r($lonch_and_group_ids);exit;
            // this function for get lonch group ids
            $lonch_group= $this->get_lonch_groups($lonch_and_group_ids['group_ids']);
            //print_r($lonch_group);exit;
            if($lonch_group){
                $data['lonch_groups']=$lonch_group;
            }
            
            if($this->input->get('group_id')){
                $data['all_lonch']= $this->get_lonch($this->input->get('group_id'), $lonch_and_group_ids['lonch_ids']);
               //echo '<pre>';var_dump($data['all_lonch']);exit();
            }
        }
        
        $this->load->view('admin/booking/offline_booking', $data);
    }
    	
    // offline add cart
    public function offline_add_cart(){
        $cabins=$this->input->get('cabins');
        $total_cabins=null;
        $total_price=0;
        $from_destination=$this->input->get('from_destination');
        $to_destination=$this->input->get('to_destination');
        $journey_date=$this->input->get('journey_date');
        $group_id=$this->input->get('group_id');
        $s_id=$this->input->get('s_id');
        $lonch_id=$this->input->get('lonch_id');
        $f_id=$this->input->get('f_id');
		$f_name=$this->input->get('floor_name');
		
        $day = $this->get_day($journey_date);
            $data['day']=$day;
            $data['from_destination']=$from_destination;
            $data['to_destination']=$to_destination;
            //the ID-S of t lonches of the schedule 
            $lonch_and_group_ids = $this->find_lonch_by_schedule($from_destination, $to_destination, $day);
            // this function for get lonch group ids
            $lonch_group= $this->get_lonch_groups($lonch_and_group_ids['group_ids']);
            
            if($lonch_group){
                $data['lonch_groups']=$lonch_group;
            }
            
            if($group_id){
                $data['all_lonch']= $this->get_lonch($group_id, $lonch_and_group_ids['lonch_ids']);
                /*echo '<pre>'; var_dump($data['all_lonch']);exit();*/
            }
           $this->cabins = $cabins;
            if($cabins){
                //$floor = $this->lonch_model->get_floor($f_id);
                //if($floor){
                //    //$floor_price=$floor->cabin_price;
				//	$floor_name=$floor->floor_name;
                //}
				$seet_title=array();
                foreach($cabins as $cabin){
                    $single_cabin_plan = $this->lonch_model->single_cabin_plan($f_name,$f_id,$lonch_id, $f_id, $cabin);
                    if($single_cabin_plan){
                        //$cabin_type_id = $single_cabin_plan->cabin_type_id;
                        //$cabin_type = $this->lonch_model->get_cabin_type($cabin_type_id);
                        //if($cabin_type){
                        //    $seet_title = $cabin_type->title;
                        //    $seet_price = $cabin_type->price;
                        //}else{
                        //    $seet_title='G';
                        //    $seet_price=$floor_price;
                        //}
						$seet_title[] = $single_cabin_plan->cabin_number;
                        $seet_price = $single_cabin_plan->sells_price;
                    }else{
                        $seet_title='';
                        $seet_price='';
                    }
                    //$total_cabins.=$seet_title.', ';
                    $total_price+=$seet_price;
                }
				$total_cabins=implode(',',$seet_title);
            }
			
            $data['total_cabins']=$total_cabins;
            $data['total_price']=$total_price;
			$data['floor_name']=$f_name;
			
            //print_r($cabins);exit;
			if($this->input->get('booking_complete') and $this->input->get('passenger_name') and $this->input->get('passenger_phone') and $this->input->get('total_cabin')){
				if($this->input->get('total_cabin')){
					// make booking//echo $this->input->get('passenger_name').','.$this->input->get('passenger_phone');
					$passenger_id = $this->booking_model->get_passenger_id($this->input->get('passenger_name'),$this->input->get('passenger_phone'));
					$t_type ="offline";
					$p_phone=$this->input->get('passenger_phone');
					
					$discount=$this->booking_model->get_discount_price($t_type,$group_id,$lonch_id,$s_id,$f_id,$passenger_id,$p_phone,$journey_date);
					//print_r($discount);exit;
					if(isset($discount)&&(count($discount)>0)){
						$exact_discount=max($discount);
						$data['discount']= ($exact_discount*$this->input->get('total_price'))/100;
						$data['total_cabins']=$this->input->get('total_cabin');
						$data['total_actual_price']=$this->input->get('total_price');
						$data['total_payable_price']=($total_price-$data['discount']);
					}else{
						$data['discount']= '';
						$data['total_cabins']=$this->input->get('total_cabin');
						$data['total_actual_price']=$this->input->get('total_price');
						$data['total_payable_price']='';
					}
					//print_r($data);exit;
					$data['group_id']=$group_id;
					$data['f_name']=$f_name;
					$data['s_id']=$s_id;
					$data['lonch_id']=$lonch_id;
					$data['f_id']=$f_id;
					$data['from_destination']=$from_destination;
					$data['to_destination']=$to_destination;
					$data['journey_date']=$journey_date;
					$data['total_cabin']=$this->input->get('total_cabin');
					$data['passenger_name']=$this->input->get('passenger_name');
					$data['passenger_phone']=$p_phone;
					$data['passenger_id']=$passenger_id;
				}else{
					$this->session->set_userdata('error_msg', 'Please select cabin');
				}
			}
        /*echo '<pre>';  var_dump($cabins);*/
        $this->load->view('admin/booking/cabin_new_add_to_cart', $data);
    }
    
	public function offline_add_cart_final(){
		$from_destination=$this->input->get('from_destination');
        $to_destination=$this->input->get('to_destination');
		$journey_date=$this->input->get('journey_date');
		
		$group_id=$this->input->get('group_id');
		$lonch_id=$this->input->get('lonch_id');
		$s_id=$this->input->get('s_id');
		$f_id=$this->input->get('f_id');
		$f_name=$this->input->get('floor_name');
		$total_cabin=$this->input->get('total_cabin');
		
		$passenger_name=$this->input->get('passenger_name');
		$passenger_phone=$this->input->get('passenger_phone');
		$passenger_id=$this->input->get('passenger_id');
		
		if($booking_id = $this->booking_model->offline_booking($group_id,$f_name,$lonch_id, $from_destination, $to_destination, $journey_date, $total_cabin, $f_id, $s_id, $passenger_name, $passenger_phone,$passenger_id)){
			$this->session->set_userdata('success_msg', 'Your order has been pleaced. Thank you');
			// This method for send sms
			//$this->sms_send($booking_id, $this->input->get('passenger_phone'));
			redirect('admin/booking/offline');
		}else{
			$this->session->set_userdata('error_msg', 'Something wrong please try again');
		}
	}
    
	//This method for send a sms to user 
    public function sms_send($booking_id, $phone){
        $booking = $this->booking_model->get_booking($booking_id);
        $this->load->helper('sms');
        $this->sms = new sms();
        $sms_after_booking = $this->user_model->get_setting_data('sms_after_booking');
        $sms_after_booking.=' অর্ডার আইডিঃ- '.$booking_id;
        $mss_repsonse = $this->sms->send('+88'.$phone, $sms_after_booking);
    }
    //This method for send a sms to all 
    public function broadcast_sms_send(){
		$msg = $this->input->post('message');
		$type= $this->input->post('type');
		
		$contacts = implode(',',array_filter($this->user_model->get_user_phone($type)));
		//$contacts = "+8801965824332,+8801729192141";
		//echo $contacts;//exit;
		$this->load->helper('sms');
        $this->sms = new sms();
		$mss_repsonse = $this->sms->send($contacts, $msg);
    }
    // offline booking helper method
    
    
    // this function for get day of journy
    public function get_day($journy_date){
        $date_parts = explode('/', $journy_date);
        return $day = date('l',mktime(0, 0, 0, $date_parts[1], $date_parts[0], $date_parts[2]));
    }
    
    // public function find the lonch ids by schedules
    public function find_lonch_by_schedule($from_destination, $to_destination, $day){
        $schedule_ids = array();
		$lonch_ids = array();
        $group_ids = array();
        $result = $this->db->get_where('lonch_schedules', array('from_destination'=>$from_destination, 'to_destination'=>$to_destination, 'day'=>$day));
        $result = $result->result();
        if($result){
            foreach($result as $schedule){
                if($lonch = $this->lonch_model->get_lonch($schedule->lonch_id)){
					$schedule_ids[]=$schedule->id;
                    $lonch_ids[]=$schedule->lonch_id;
                    $group_ids[]=$lonch->group_id;
                }
            }
        }
        $return_array=array('schedule_ids'=>$schedule_ids, 'lonch_ids'=>$lonch_ids, 'group_ids'=>$group_ids);
		//print_r($return_array);
        return $return_array;
    }
    
    // this funciton fr get lonch groups
    public function get_lonch_groups($group_ids){
        if($group_ids){
            $this->db->where_in('id', $group_ids);
            $result = $this->db->get('lonch_group');
            return $result->result();
        }else{return null;}
        
    }
    // this funciton fr get lonch groups
    public function get_lonch($group_id, $lonch_ids){
        if($group_id and $lonch_ids){
            $this->db->where_in('id', $lonch_ids);
            $this->db->where('group_id', $group_id);
            $result = $this->db->get('lonch');
            return $result->result();
        }else{return null;}
        
    }
    
    // this method for finding lonch ids by owner
    public function lonch_ids_by_owner($owner_id=null){
       
        $lonch_ids=array();
        if($owner_id){
            $result = $this->db->query("SELECT * FROM lonch WHERE owner_id='$owner_id'");
        }else{
             $result = $this->db->query("SELECT * FROM lonch");
        }
        $result = $result->result();
        if($result){
            foreach($result as $lonch){
                $lonch_ids[]=$lonch->id;
            }
            
        }
        return $lonch_ids;
    }
    
    // lonch id for manager
    public function manager_lonch_id(){
        $lonch_id=null;
        $result = $this->db->query("SELECT * FROM users WHERE id='$this->user_id'");
        $result = $result->row(0);
        if($result){
            $lonch_id=  $result->lonch_id;
        }
        return $lonch_id;

    }
    
    
    
}

