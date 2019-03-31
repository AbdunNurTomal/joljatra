<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cabin extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        date_default_timezone_set('Asia/Dhaka');
        $this->load->model('lonch_model');
        $this->load->model('booking_model');
        $this->user_type=$this->session->userdata('current_user_type');
        $this->user_id=$this->session->userdata('current_user_id');
		
    }

	public function index(){
        $data['destinations']=$this->lonch_model->lonch_destinations();
		
		$this->session->unset_userdata('online_booking_set_min');
		$this->session->unset_userdata('online_booking_last_min');
		
		$last_min = $this->user_model->check_cabin_booking_timeout($timeout=1);
		$this->session->set_userdata('online_booking_last_min',$last_min);
		
		$this->load->view('frontend/cabin', $data);
	}
    
    // public this function for search cabin
    public function find(){		
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
			//print_r($data);exit;
            //the ID-S of t lonches of the schedule 
            $lonch_and_group_ids = $this->find_lonch_by_schedule($from_destination, $to_destination, $day);
			//print_r($lonch_and_group_ids);exit;
            // this function for get lonch group ids
            $lonch_group= $this->get_lonch_groups($lonch_and_group_ids['group_ids']);
            //print_r($lonch_group);exit;
            if($lonch_group){
                $data['lonch_groups']=$lonch_group;
            }
            //get all lonch from group
            if($this->input->get('group_id')){
                $data['all_lonch']= $this->get_lonch($this->input->get('group_id'), $lonch_and_group_ids['lonch_ids']);
                //echo '<pre>';var_dump($data['all_lonch']);exit();
            }   
			
			if($this->input->get('lonch_id')&&$this->input->get('s_id')){		
				$data['time_diff'] = 0;
				$s_day_time = $this->lonch_model->get_schedule_by_id_new($this->input->get('lonch_id'),$this->input->get('s_id'));
				if(isset($s_day_time)){
					$data['time_diff'] = $this->booking_model->check_booking_schedule($s_day_time->day,$s_day_time->time,$time_out=30);
				}
			}
        }
        
        $this->load->view('frontend/cabin', $data);
    }
    
    // public function add to cart
    public function add_to_cart(){
		$total_cabin=$this->input->get('total_cabins');
        $cabins=$this->input->get('cabins');
        $from_destination=$this->input->get('from_destination');
        $to_destination=$this->input->get('to_destination');
        $journey_date=$this->input->get('journey_date');
		
        $group_id=$this->input->get('group_id');
        $lonch_id=$this->input->get('lonch_id');
        $s_id=$this->input->get('s_id');
        $f_id=$this->input->get('f_id');
		$f_name=$this->input->get('floor_name');
		
		$p_id = $this->session->userdata('current_user_id');
		$p_name = $this->booking_model->get_passenger_name_by_id($p_id);
		$p_phone = $this->booking_model->get_passenger_phone_by_id($p_id);
		
		$this->add_to_cart_helper($from_destination,$to_destination,$journey_date,$total_cabin,$cabins,$group_id,$lonch_id,$s_id,$f_id,$f_name,$p_id,$p_name,$p_phone);
    }
	public function add_to_cart_final(){
		$total_cabin=$this->input->get('total_cabin');
		$cabins=$this->input->get('cabins');
		$from_destination=$this->input->get('from_destination');
        $to_destination=$this->input->get('to_destination');
		$journey_date=$this->input->get('journey_date');
		
		$group_id=$this->input->get('group_id');
		$lonch_id=$this->input->get('lonch_id');
		$s_id=$this->input->get('s_id');
		$f_id=$this->input->get('f_id');
		$f_name=$this->input->get('floor_name');
		
		$p_id=$this->input->get('passenger_id');
		$p_name=$this->input->get('passenger_name');
		$p_phone=$this->input->get('passenger_phone');
		
		$this->add_to_cart_helper($from_destination,$to_destination,$journey_date,$total_cabin,$cabins,$group_id,$lonch_id,$s_id,$f_id,$f_name,$p_id,$p_name,$p_phone);
	}
	public function add_to_cart_helper($from_destination,$to_destination,$journey_date,$total_cabin,$cabins,$group_id,$lonch_id,$s_id,$f_id,$f_name,$p_id,$p_name,$p_phone){
		$day = $this->get_day($journey_date);
		
		$data['day']=$day;
		$data['from_destination']=$from_destination;
		$data['to_destination']=$to_destination;
		//the ID-S of t lonches of the schedule 
		$lonch_and_group_ids = $this->find_lonch_by_schedule($from_destination, $to_destination, $day);
		//print_r($lonch_and_group_ids);exit;
			
		// this function for get lonch group ids
		$lonch_group= $this->get_lonch_groups($lonch_and_group_ids['group_ids']);
            
		if($lonch_group){ $data['lonch_groups']=$lonch_group; }
            
		if($group_id){
			$data['all_lonch']= $this->get_lonch($group_id, $lonch_and_group_ids['lonch_ids']);
			/*echo '<pre>';var_dump($data['all_lonch']);exit();*/
		}
        
		//if cabins then count cabins and price
		//$total_cabins=null;
		$total_price=0;
		//print_r($cabins);
		if($cabins){
			//$floor = $this->lonch_model->get_floor($f_id);
			//$floor = $this->lonch_model->get_floor($f_id);
			////print_r($floor);//exit;
			//if($floor){
			//	//$floor_price=$floor->cabin_price;
			//	$floor_name=$floor->floor_name;
			//}
			$seet_title=array();
			//print_r($cabins);exit;
			foreach($cabins as $cabin){
				$single_cabin_plan = $this->lonch_model->single_cabin_plan($f_name,$s_id,$lonch_id, $f_id, $cabin);
				$seet_title=null;
				//print_r($single_cabin_plan);exit;
				
				if($single_cabin_plan){
					//$cabin_type_id = $single_cabin_plan->cabin_type_id;
					//$cabin_type = $this->lonch_model->get_cabin_type($cabin_type_id);
					//if($cabin_type){
						$seet_title[] = $single_cabin_plan->cabin_number;
						$seet_price = $single_cabin_plan->sells_price;
				   //}else{
				   //    $seet_title='G';
				   //    $seet_price=$floor_price;
				   //}
				}else{
					$seet_title='';
					$seet_price='';
				}
				//$total_cabins.=$cabin.$seet_title.', ';
				//$total_cabins.=$seet_title.', ';
				$total_price+=$seet_price;
			}
			$total_cabin=implode(',',$seet_title);
		}
		
		$t_type ="online";
		$discount=$this->booking_model->get_discount_price($t_type,$group_id,$lonch_id,$s_id,$f_id,$p_id,$p_phone,$journey_date);
		if(isset($discount)&&(count($discount)>0)){
			$exact_discount=max($discount);
			$exact_discount = ($exact_discount*$total_price)/100;
			$data['discount']= $exact_discount;
			$data['total_cabins']=$total_cabin;
			$data['total_actual_price']=$total_price;
			$data['total_payable_price']=($total_price-$exact_discount);
		}else{
			$data['discount']= '';
			$data['total_cabins']=$total_cabin;
			$data['total_actual_price']=$total_price;
			$data['total_payable_price']='';
        } 
		$data['group_id']=$group_id;
		$data['floor_name']=$f_name;
		$data['s_id']=$s_id;
		$data['lonch_id']=$lonch_id;
		$data['f_id']=$f_id;
		$data['from_destination']=$from_destination;
		$data['to_destination']=$to_destination;
		$data['journey_date']=$journey_date;
		$data['total_cabin']=$this->input->get('total_cabin');
		$data['passenger_name']=$this->input->get('passenger_name');
		$data['passenger_phone']=$p_phone;
		$data['passenger_id']=$p_id;
        /*echo '<pre>'; var_dump($cabins);*/
        $this->load->view('frontend/cabin_add_to_cart', $data);
	}
    
    // take payment action
    public function get_payment(){
        // make a draft order by draft id
		if($this->session->userdata('online_booking_set_min') !== TRUE){
			$online_booking_set_min = date('Y-m-d H:i:s');
			$this->session->set_userdata('online_booking_set_min',$online_booking_set_min);
		}
			
		//echo $this->session->userdata('online_booking_set_min').' ~ '.$this->session->userdata('online_booking_last_min');
		
		if($this->session->userdata('online_booking_set_min')>$this->session->userdata('online_booking_last_min')){
			redirect('cabin');
		}
		
        $order_draft_id=null;
        $query = $_GET;
        $user = $this->user_model->get_user($this->user_id);
		
        if($query and $user){
			//print_r($query);exit;
            if($order_draft_id = $this->booking_model->make_order_draft($query, $user)){
               //print_r($order_draft_id);exit;
            }else{
               $this->session->set_userdata('error_msg', 'something wrong please try again');
               redirect('cabin'); 
            }
        }else{
            $this->session->set_userdata('error_msg', 'something wrong please try again');
            redirect('cabin');
        }
        if($order_draft_id){
            $this->session->set_userdata('order_draft_id', $order_draft_id);
        }else{
            redirect('cabin');
        }
        
        
        $this->load->helper('WALLETMIX');
        
        $access_username=$this->user_model->get_setting_data('walletmix_access_username');
        $access_password=$this->user_model->get_setting_data('walletmix_access_password');
        $access_app_key=$this->user_model->get_setting_data('walletmix_access_app_key');
        $access_marchent_id=$this->user_model->get_setting_data('walletmix_access_marchent_id');
        
        // make a payment form wallet mix

        $this->walletmix = NEW walletmix($access_username, $access_password, $access_marchent_id, $access_app_key);
        
        $customer_info = array(
            "customer_name" 	=> $user->first_name.' '.$user->last_name,
            "customer_email" 	=> $user->email,
            "customer_add" 		=> $user->address1,
            "customer_city" 	=> $user->city,
            "customer_country" 	=> $user->country,
            "customer_postcode" => $user->post_code,
            "customer_phone" 	=> $user->phone,
        );
        
        $shipping_info = array(
            "shipping_name" => $user->first_name.' '.$user->last_name,
            "shipping_add" => $user->address1,
            "shipping_city" => $user->city,
            "shipping_country" => $user->country,
            "shipping_postCode" => $user->post_code,
        );
        
        $this->walletmix->set_shipping_charge(0);
        $this->walletmix->set_discount(0);

        $products = $this->booking_model->cabin_list($query);
        

        $this->walletmix->set_product_description($products);

        $this->walletmix->set_merchant_order_id($order_draft_id);

        $this->walletmix->set_app_name('joljatra.com');
        $this->walletmix->set_currency('BDT');
        $this->walletmix->set_callback_url(site_url('cabin/payment_call_back'));

        $extra_data = array();

        //if you want to send extra data then use this way
        //$extra_data = array('param_1' => 'data_1','param_2' => 'data_2','param_3' => 'data_3');

        $this->walletmix->set_extra_json($extra_data);

        $this->walletmix->set_transaction_related_params($customer_info);
        $this->walletmix->set_transaction_related_params($shipping_info);

        $this->walletmix->set_database_driver('session');	// options: "txt" or "session"

        $this->walletmix->send_data_to_walletmix();
        
    }
    
    // payment call back 
    public function payment_call_back(){
        $order_draft_id = $this->session->userdata('order_draft_id');
        $this->load->helper('WALLETMIX');
        $access_username=$this->user_model->get_setting_data('walletmix_access_username');
        $access_password=$this->user_model->get_setting_data('walletmix_access_password');
        $access_app_key=$this->user_model->get_setting_data('walletmix_access_app_key');
        $access_marchent_id=$this->user_model->get_setting_data('walletmix_access_marchent_id');
        
        // make a payment form wallet mix

        $this->walletmix = NEW walletmix($access_username, $access_password, $access_marchent_id, $access_app_key);

        $this->walletmix->set_database_driver('session');	// options: "txt" or "session"

        if(isset($_POST['merchant_txn_data'])){
            $merchant_txn_data = json_decode($_POST['merchant_txn_data']);
            
            $this->walletmix->get_database_driver();

            if($this->walletmix->get_database_driver() == 'txt'){
                $saved_data = json_decode($this->walletmix->read_file());
            }elseif($this->walletmix->get_database_driver() == 'session'){
                // Read data from your database
                $saved_data = json_decode($this->walletmix->read_data());
            }

            if($merchant_txn_data->token === $saved_data->token){

                $wmx_response = json_decode($this->walletmix->check_payment($saved_data));
                /*echo '<pre>';
                var_dump($wmx_response);*/
                //$this->walletmix->debug($wmx_response,true);
                
                if(	($wmx_response->wmx_id == $saved_data->wmx_id) ){
                    if(	($wmx_response->txn_status == '1000') ){
                        /*
                        echo '<pre>';
                        var_dump($wmx_response);
                        */
                        
                        if(	($wmx_response->bank_amount_bdt >= $saved_data->amount) ){
                            if(	($wmx_response->merchant_amount_bdt == $saved_data->amount) ){	
                                $this->update_dreaft_booking($order_draft_id);
                                $this->session->set_userdata('success_msg', 'Thak you your order hasbeen placed your order ID: '.$order_draft_id.' <a href="'.site_url('customer/print_order/'.$order_draft_id).'"><b>Print This order</b></a>');
                                echo 'Update merchant database with success. amount : '.$wmx_response->bank_amount_bdt;
                                redirect('customer/thank_you/'.$order_draft_id);
                            }else{
                                $this->update_dreaft_booking($order_draft_id);
                                $this->session->set_userdata('success_msg', 'Thak you your order hasbeen placed your order ID: '.$order_draft_id.' <a href="'.site_url('customer/print_order/'.$order_draft_id).'"><b>Print This order</b></a>');
                               redirect('customer/thank_you/'.$order_draft_id);
                                
                            }
                        }else{
                            
                            $this->remove_dreaft_booking($order_draft_id);
                            $this->session->set_userdata('error_msg', 'Bank amount is less then merchant amount like partial payment.');
                            redirect('cabin');
                        }
                        
                        
                    }else{
                        
                        $this->remove_dreaft_booking($order_draft_id);
                        $this->session->set_userdata('error_msg', 'Money transaction faield');
                        redirect('cabin');
                    }
                }else{
                    $this->remove_dreaft_booking($order_draft_id);
                   $this->session->set_userdata('error_msg', 'Merchant ID Mismatch');
                    redirect('cabin');
                }
            }else{
                $this->remove_dreaft_booking($order_draft_id);
                $this->session->set_userdata('error_msg', 'Token mismatch');
                redirect('cabin');
            }
        }else{
            $this->remove_dreaft_booking($order_draft_id);
            $this->session->set_userdata('error_msg', 'Try to direct access');
            redirect('cabin');
        }
    }
    
    public function remove_dreaft_booking($booking_id){
        $this->db->where(array('id'=>$booking_id, 'status'=>'draft'))->delete('cabin_boking');
        $this->db->where(array('booking_id'=>$booking_id))->delete('cabin_booking_list');
    }
    public function update_dreaft_booking($booking_id){
        $this->db->where(array('id'=>$booking_id, 'status'=>'draft'))->update('cabin_boking', array('status'=>'complete'));
        $this->sms_send($booking_id);
    }
    
    //This method for send a sms to user 
    public function sms_send($booking_id){
        $user = $this->user_model->get_user($this->user_id);
        $booking = $this->booking_model->get_booking($booking_id);
        $this->load->helper('sms');
        $this->sms = new sms();
        $sms_after_booking = $this->user_model->get_setting_data('sms_after_booking');
        $sms_after_booking.=' অর্ডার আইডিঃ- '.$booking_id;
        $mss_repsonse = $this->sms->send('+88'.$user->phone, $sms_after_booking);
    }
        
    // this method fo remove from drafts
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
		if($this->session->userdata('site_lang')=='bd'){
			$result = $this->db->get_where('lonch_schedules', array('from_destination'=>$from_destination, 'to_destination'=>$to_destination, 'day'=>$day));
		}else if($this->session->userdata('site_lang')=='en'){
			$result = $this->db->get_where('lonch_schedules', array('from_destination_eng'=>$from_destination, 'to_destination_eng'=>$to_destination, 'day'=>$day));
		}
        $result = $result->result();
        if($result){
            foreach($result as $schedule){
				//echo $schedule->lonch_id.'~'.$lonch->group_id;exit;
                if($lonch = $this->lonch_model->get_lonch($schedule->lonch_id)){
					$schedule_ids[]=$schedule->id;
                    $lonch_ids[]=$schedule->lonch_id;
                    $group_ids[]=$lonch->group_id;
                }
            }
        }
        $return_array=array('schedule_ids'=>$schedule_ids, 'lonch_ids'=>$lonch_ids, 'group_ids'=>$group_ids);
		//print_r($return_array);
		//echo $from_destination.'~'.$to_destination.'~'.$day;exit;
        return $return_array;
    }
	///////
	 public function find_lonch_by_schedule_cart($from_destination, $to_destination, $day, $s_id){
        $lonch_ids = array();
        $group_ids = array();
        $result = $this->db->get_where('lonch_schedules', array('from_destination'=>$from_destination, 'to_destination'=>$to_destination, 'day'=>$day));
        $result = $result->result();
        if($result){
            foreach($result as $schedule){
				//echo $schedule->lonch_id.'~'.$lonch->group_id;exit;
                if($lonch = $this->lonch_model->get_lonch($schedule->lonch_id)){
					$schedule_ids[]=$schedule->id;
                    $lonch_ids[]=$schedule->lonch_id;
                    $group_ids[]=$lonch->group_id;
                }
            }
        }
        $return_array=array('schedule_ids'=>$schedule_ids, 'lonch_ids'=>$lonch_ids, 'group_ids'=>$group_ids);
		//print_r($return_array);
		//echo $from_destination.'~'.$to_destination.'~'.$day;exit;
        return $return_array;
    }
	///////
    
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
		//echo $group_id;print_r($lonch_ids);exit;
        if($group_id and $lonch_ids){
            $this->db->where_in('id', $lonch_ids);
            $this->db->where('group_id', $group_id);
            $result = $this->db->get('lonch');
            return $result->result();
        }else{return null;}
        
    }

}
?>