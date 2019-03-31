<?php
class User_Model extends MY_Model{
    public function __construct(){
        parent:: __construct();
        
    }
    public function is_user_logd_in(){
        if($this->session->userdata('current_user_id') and base_url()==$this->session->userdata('base_url'))
        {return true;}
        else{return false;}
    }
    public function is_captcha_log(){
        return true;
    }
    
    
    // is user log in and make log in session
    public function is_captcha_available( $username, $captcha_code ){
        $attr = array(
            'user_name' => $username
        );
        $result = $this->db->get_where('users', $attr);
        //if username amd password is metch it redirect dashboard else redirect to login page
			if($captcha_code==config_item('captcha_code')){
                if($result->num_rows() > 0){
                    $sesattr = array(
                            'captcha_code' => true,
                            'base_url' => base_url(),
                        );
                    //session set 
                    $this->session->set_userdata($sesattr);
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
    }
    
    // is user log in and make log in session
    public function is_user_available( $username, $password ){
        $attr = array(
            'user_name' => $username,
			'password'  => $password
        );
        $result = $this->db->get_where('users', $attr);
        //if username amd password is metch it redirect dashboard else redirect to login page
			if($result->num_rows() > 0){
				$sesattr = array(
						'current_user_id' => $result->row(0)->id,
						'current_username' => $username,
						'current_user_type' => $result->row(0)->type,
						'base_url' => base_url()
					);
				//session set 
				$this->session->set_userdata($sesattr);
                return true;
			}else{
				return false;
			}
    }
    
/*
========================================================================================
                    USER LOG IN SECTION EDD HERE
========================================================================================
*/
   
     public function get_all_user($type=null, $per_page=null, $page=null){
        $current_user_type = $this->session->userdata('current_user_type');
        $current_user_id = $this->session->userdata('current_user_id');
        if($current_user_type=='owner'){
            $this->db->where('id', $current_user_id);
            $this->db->or_where('owner_id', $current_user_id);
        }
         
        $result=0;
        if($per_page!=null){
            $this->db->order_by("id", "DESC");
            $this->db->limit($per_page, $page);
        }
        if ($type==null){
            $result = $this->db->get('users');
        }else{
            $result = $this->db->get_where('users', array('type'=>$type));
        }
        return $result->result();
    }
    
    /*This function for get all user count */
    public function get_user_count($type=null){
        $result=0;
        if ($type==null){
            $result = $this->db->get('users');
        }else{
            $result = $this->db->get_where('users', array('type'=>$type));
        }
        return $result->num_rows();
        
    }
    
    //thhis function for query all members
     public function get_all_new_agent($per_page=null, $page=null){
        $result=0;
        if($per_page!=null){
            $this->db->order_by("id", "ASC");
            $this->db->limit($per_page, $page);
        }
        $result = $this->db->get_where('users', array('type'=>'agent'));
        return $result->result();
    }
    
    /*This function for get all members count */
    public function get_agent_count($type=null){
        $result=0;
        
        $result = $this->db->get_where('users', array('type'=>'agent'));
        return $result->num_rows();
    }
    
    /*This fnction for get one single user*/
    public function get_user($id=null){
        $result = $this->db->get_where('users', array('id'=>$id));
        return $result->row(0);
    }
    
    /*This fnction for get one single user*/
    public function get_user_by_email($email){
         $result = $this->db->get_where('users', array('email'=>$email));
        return $result->row(0);
    }
    /*This fnction for get one single user*/
    public function get_user_by_user_name($user_name=null){
         $result = $this->db->get_where('users', array('user_name'=>$user_name));
        return $result->row(0);
    }
    
    /*This fucntion for new message count*/
    public function new_message_count($status='new'){
        $result = $this->db->get_where('contact', array('status'=>$status));
        return $result->num_rows(0);
    }
    
    /*This fucntion for get single setting data*/
    public function get_setting_data($data_id){
        $result = $this->db->get_where('setting', array('data_id'=>$data_id));
        if($result->row(0)){
            $data = $result->row(0);
			if($this->session->userdata('site_lang')=='bd'){ return  $data->data; }
			else if($this->session->userdata('site_lang')=='en'){ return  $data->eng; }            
        }else{
            return '';
        }
    }
	 public function get_setting_data_old($data_id){
        $result = $this->db->get_where('setting', array('data_id'=>$data_id));
        if($result->row(0)){
            $data = $result->row(0);
			return  $data->data;           
        }else{
            return '';
        }
    }
    
    public function agent_name($id=null){
        $user = $this->get_user($id);
        $user_name = 'No Agent';
        if($user){
            $user_name=$user->first_name.' '.$user->last_name;
        }
        return $user_name;
    } 
    
    /*This function for get all messages */
    public function all_message(){
        $this->db->order_by('id', 'DESC');
        $result = $this->db->get('contact');
        return $result->result();
    }
    /*This function for get all messages */
    public function get_message($id){
        $this->db->order_by('id', 'DESC');
        $result = $this->db->get_where('contact', array('id'=>$id));
        return $result->row(0);
    }
    
    /*This funciton for user rooms booking*/
    public function get_all_booking($user_id){
        $result = $this->db->get_where('booking', array('user_id'=>$user_id));
        return $result->result();
    }
    /*This funciton for user rooms booking*/
    public function get_booking($id){
        $result = $this->db->get_where('booking', array('id'=>$id));
        return $result->row(0);
    }
    public function user_name($id){
        $display_name='No user found';
        $user_data = $this->get_user($id);
        if($user_data){
            $display_name = $user_data->first_name.' '.$user_data->last_name;
        }
        return $display_name;
    }
	public function get_user_phone($type){
		$current_user_type = $this->session->userdata('current_user_type');
		$phone= array();
        if($current_user_type=='admin'){
			if($type=='all'){
				$result = $this->db->get('users');
			}else if($type=='passenger'){
				$result = $this->db->get_where('users', array('type'=>$type));
			}else if($type=='owner'){
				$result = $this->db->get_where('users', array('type'=>$type));
			}
			$allusers = $result->result();
			if($allusers->num_rows()>0){
				foreach($allusers as $user){
					if(!empty($user->phone)){
						$phone[]='+88'.$user->phone;
					}
				}
			}
        }
		return $phone;
	}
	public function get_terminal_location(){
		$terminal= array();
		$result = $this->db->get('terminal_map');
		$locations = $result->result();
		foreach($locations as $location){
			$data=array();
			$data['name']=$location->name;
			$data['info']=$location->info;
			$data['lat']=$location->lat;
			$data['long']=$location->long;
			$terminal[]=$data;
		}
		//print_r($terminal);exit;
		return $terminal;
	}
	
	public function terminal_map(){
		$name = $this->input->post('name');
		$map=array(
				'name' => $name,
				'info' => $this->input->post('info'),
				'lat' => $this->input->post('latitude'),
				'long' => $this->input->post('longitude')
			);
		//$result = $this->db->get_where('terminal_map', array('name'=>$name));
		
		$query = $this->db->query("select `name` from `terminal_map` where `name` = '".$name."'");
		$found_name=false;
		if($query->num_rows() > 0){
		   foreach ($query->result() as $row){
			   $found_name = true;
		   }	
		}
		
		if($found_name==true){
			$this->db->where('name', $name)->update('terminal_map', $map);
			if(!$this->db->affected_rows()) {
				$result = 'Error! ID ['.$id.'] not found';
				return $result;
			}else {
				unset($map);
				return true;
			}
		}else{
			$this->db->insert('terminal_map', $map);
			if(!$this->db->affected_rows()) {
				$result = 'Error! ID ['.$id.'] not found';
				return $result;
			}else {
				unset($map);
				return true;
			}
		} 
	}
	public function terminal_map_delete(){
		$name = $this->input->post('name');
		$info = $this->input->post('info');
		$lat = $this->input->post('latitude');
		$lng = $this->input->post('longitude');
		
		$result = $this->db->get_where('terminal_map', array('name'=>$name,'info'=>$info,'lat'=>$lat,'long'=>$lng));
		
		if($result->row()->id){
			$this->db->where('id', $result->row()->id);
			$this->db->delete('terminal_map');
			if(!$this->db->affected_rows()) {
				$result = 'Error! ID ['.$id.'] not found';
			}else {
				return true;
			}
		}else{
			return false;
		}
	}
	
	public function check_cabin_booking_timeout($timeout){
		$last_min = date('Y-m-d H:i:s', strtotime('+'.$timeout.' minutes'));
		return $last_min;
	}
}
?>