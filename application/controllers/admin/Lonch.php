<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lonch extends Admin_Controller{
    public function __construct(){
        parent::__construct();
        $this->user_type = $this->session->userdata('current_user_type');
        $this->user_id = $this->session->userdata('current_user_id');
        $this->load->model('lonch_model');
        
        if($this->user_type=='manager'){
            redirect('admin/dashboard');
        }
    }
	public function index(){
        $this->lonch_groups();
	}
        
    //this function for loncg group
    public function lonch_groups($owner_id=null){
        $data['lonch_groups']=$this->lonch_model->get_lonch_groups($owner_id);
        $this->load->view('admin/lonch/lonch_group_list', $data);
    }
    
    // this method for add new lonch group
    public function add_new_group(){
        $error=array();
        if($this->input->post('lonch_group')){
            $attr=array();
            if($_FILES['group_picture']['tmp_name']){
               $attr['group_picture']=$this->do_upload('./uploads/lonch-group/', 'group_picture'); 
            }
            $attr['owner_id']=$this->input->post('owner_id');
            $attr['group_name']=addslashes($this->input->post('group_name'));
			$attr['group_name_eng']=addslashes($this->input->post('group_name_eng'));
            $attr['group_description']=addslashes($this->input->post('group_description'));
			$attr['group_description_eng']=addslashes($this->input->post('group_description_eng'));
            if($this->db->insert('lonch_group', $attr)){
                $this->session->set_userdata('success_msg', 'The lonch group added');
                redirect('admin/lonch/lonch_groups');
            }else{
                $this->session->set_userdata('error_msg', 'Something wrong please try again');
            }
        }
        $this->load->view('admin/lonch/add_new_group');
    }
    
    
    // this method for add new lonch group
    public function edit_group($id,$lonch=null){
		$lonch_floors = array();
		
        $data['group'] = $this->lonch_model->get_group($id);
		$data['all_lonch'] = $this->lonch_model->get_lonch_by_group($id);
		if($lonch != null){
			$lonch_floors = $this->lonch_model->get_booking_list_by_lonch($lonch);
			//print_r($lonch_floors);exit;

			if(isset($lonch_floors)&&(!empty($lonch_floors))){	
				$data['lonch_floors'] = $lonch_floors;
				$data['lonch_id'] = $lonch;
			}else{
				$data['lonch_floors'] = '';
				$data['lonch_id'] = '';
			}
		}else{
			$data['lonch_floors'] = '';
			$data['lonch_id'] = '';
		}
		
        if($this->user_type='admin'){
            // you can edit this group
        }
        elseif($this->user_type='owner' and $data['group']->owner_id==$tihs->$user_id){
            // you can edit this group
        }else{
            // you can not edit this group
            redirect('error');
        }
            
        if($this->input->post('lonch_group')){
            $attr=array();
            if($_FILES['group_picture']['tmp_name']){
               $attr['group_picture']=$this->do_upload('./uploads/lonch-group/', 'group_picture'); 
                if($attr['group_picture']){
                    if(file_exists('./uploads/lonch-group/'.$data['group']->group_picture)){
                        unlink('./uploads/lonch-group/'.$data['group']->group_picture);
                    }
                }
            }
            $attr['owner_id']=$this->input->post('owner_id');
            $attr['group_name']=addslashes($this->input->post('group_name'));
			$attr['group_name_eng']=addslashes($this->input->post('group_name_eng'));
            $attr['group_description']=addslashes($this->input->post('group_description'));
			$attr['group_description_eng']=addslashes($this->input->post('group_description_eng'));
            
            if($this->db->where('id', $id)->update('lonch_group', $attr)){
                $this->session->set_userdata('success_msg', 'The lonch group updated');
                redirect('admin/lonch/lonch_groups');
            }else{
                $this->session->set_userdata('error_msg', 'Something wrong please try again');
            }
        }
        $data['group'] = $this->lonch_model->get_group($id);
        $this->load->view('admin/lonch/edit_group', $data);
    }
    
    // this function for delete a lonch group
    public function delete_group($id){
        
        $data['group'] = $this->lonch_model->get_group($id);
        if($this->user_type='admin'){
            // you can edit this group
        }
        elseif($this->user_type='owner' and $data['group']->owner_id==$tihs->$user_id){
            // you can edit this group
        }else{
            // you can not edit this group
            redirect('error');
        }
        
        if($this->db->where('id', $id)->delete('lonch_group')){
            $this->session->set_userdata('success_msg', 'You have successfully delete a group');
            if(file_exists('./uploads/lonch-group/'.$data['group']->group_picture)){
                unlink('./uploads/lonch-group/'.$data['group']->group_picture);
            }
                redirect('admin/lonch/lonch_groups');
        }else{
            $this->session->set_userdata('error_msg', 'Something went wrong please try again letter');
                redirect('admin/lonch/lonch_groups');
        }
    }
    
   /*
    =================================================================
       LONCH FUNCTIONS 
    =================================================================
    */
    // this function for display all lonch user
    public function all_lonch($owner_id=null){
        $data['lonchs']=$this->lonch_model->get_all_lonch($owner_id);
        $this->load->view('admin/lonch/all_lonch', $data);
    }
    
	// this function for display all lonch user
    public function all_discount_lonch($owner_id=null){
        $data['lonchs']=$this->lonch_model->get_all_discount_lonch($owner_id);
        $this->load->view('admin/lonch/all_discount_lonch', $data);
    }
    
    // this function for add a news lonch
    public function add_new_lonch($owner_id=null){
        $error=array();
         $data['lonch_groups']=$this->lonch_model->get_lonch_groups($owner_id);
        if($this->input->post('new_lonch')){
            $attr=array();
            if($_FILES['lonch_picture']['tmp_name']){
               $attr['picture']=$this->do_upload('./uploads/lonch/', 'lonch_picture'); 
            }
            $attr['owner_id']=$this->input->post('owner_id');
            $attr['group_id']=addslashes($this->input->post('group_id'));
            $attr['lonch_name']=addslashes($this->input->post('lonch_name'));
			$attr['lonch_name_eng']=addslashes($this->input->post('lonch_name_eng'));
            $attr['cabin']=addslashes($this->input->post('cabin'));
            if($this->db->insert('lonch', $attr)){
                $this->session->set_userdata('success_msg', 'The lonch added');
                redirect('admin/lonch/all_lonch');
            }else{
                $this->session->set_userdata('error_msg', 'Something wrong please try again');
            }
        }
        $this->load->view('admin/lonch/add_new_lonch', $data);
    }
    
    
    // this method for edit lonch
    public function edit_lonch($id, $owner_id=null){
        $data['destinations'] = $this->lonch_model->lonch_destinations();
        $data['lonch'] = $this->lonch_model->get_lonch($id);
        $data['lonch_floors'] = $this->lonch_model->get_lonch_floors($id);
        $data['lonch_schedules'] = $this->lonch_model->get_lonch_schedules($id);
	//print_r($data['lonch_schedules']);exit;
	
        if($this->user_type='admin'){
            // you can edit this group
        }
        elseif($this->user_type='owner' and $data['lonch']->owner_id==$tihs->$user_id){
            // you can edit this group
        }else{
            // you can not edit this group
            redirect('error');
        }
        $data['lonch_groups']=$this->lonch_model->get_lonch_groups($owner_id);
        if($this->input->post('edit_lonch')){
            $attr=array();
            if($_FILES['lonch_picture']['tmp_name']){
               $attr['picture']=$this->do_upload('./uploads/lonch/', 'lonch_picture'); 
                if($attr['picture']){
                    if(file_exists('./uploads/lonch/'.$data['lonch']->picture)){
                        unlink('./uploads/lonch/'.$data['lonch']->picture);
                    }
                }
            }
            $attr['owner_id']=$this->input->post('owner_id');
            $attr['group_id']=addslashes($this->input->post('group_id'));
            $attr['lonch_name']=addslashes($this->input->post('lonch_name'));
			$attr['lonch_name_eng']=addslashes($this->input->post('lonch_name_eng'));
            $attr['cabin']=addslashes($this->input->post('cabin'));
            
            if($this->db->where('id', $id)->update('lonch', $attr)){
                $this->session->set_userdata('success_msg', 'The lonch group updated');
                redirect('admin/lonch/all_lonch');
            }else{
                $this->session->set_userdata('error_msg', 'Something wrong please try again');
            }
        }
       // $data['lonch'] = $this->lonch_model->get_lonch($id);
        $this->load->view('admin/lonch/edit_lonch', $data);
    }
    
    public function add_lonch_floor($lonch_id){
		$lonch_schedule = $_POST['lonch_schedule'];
        $floor_name = $_POST['floor_name'];
        $cabin = $_POST['total_cabin'];
		
		$this->db->trans_start();
        if($this->db->insert('lonch_floors', array('id'=>$lonch_schedule,'lonch_id'=>$lonch_id, 'floor_name'=>$floor_name,'cabin'=>$cabin))){
			$this->session->set_userdata('success_msg', 'The lonch floor updated');
        }else{
            $this->session->set_userdata('error_msg', 'Something wrong please try again');
        }
		$this->db->trans_complete();
    }
    
	public function edit_lonch_floor($lonch_id, $floor_id, $floor_name){
		$lonch_schedule = $this->input->post('edit_lonch_schedule');
        $new_floor_name = $this->input->post('floor_name');
        $cabin = $this->input->post('total_cabin');
		
		$floor_name = str_replace('%20', ' ', $floor_name);
		
        if($this->db->where(array('id'=>$floor_id,'lonch_id'=>$lonch_id,'floor_name'=>$floor_name))->update('lonch_floors', array('id'=>$lonch_schedule, 'floor_name'=>$new_floor_name, 'cabin'=>$cabin))){
			$this->db->where(array('id'=>$floor_id,'lonch_id'=>$lonch_id,'floor_id'=>$floor_id,'floor_name'=>$floor_name))->update('cabin_plan', array('id'=>$lonch_schedule, 'floor_id'=>$lonch_schedule, 'floor_name'=>$new_floor_name));
			$this->session->set_userdata('success_msg', 'The lonch floor updated');
			redirect('admin/lonch/edit_lonch/'.$lonch_id);
        }else{
            $this->session->set_userdata('error_msg', 'Something wrong please try again');
			redirect('admin/lonch/edit_lonch/'.$lonch_id);
        }
    }
    
    
    // this method for delete a lonch floor
    public function delete_lonch_floor($lonch_id, $floor_id, $floor_name){
        if($this->db->where(array('id'=>$floor_id,'lonch_id'=>$lonch_id,'floor_name'=>$floor_name))->delete('lonch_floors')){
			if($this->db->where(array('id'=>$floor_id,'lonch_id'=>$lonch_id, 'floor_id'=>$floor_id,'floor_name'=>$floor_name))->delete('cabin_plan')){
				$this->session->set_userdata('success_msg', 'The lonch floor deleted');
				redirect('admin/lonch/edit_lonch/'.$lonch_id);
			}
        }else{
            $this->session->set_userdata('error_msg', 'Something wrong please try again');
            redirect('admin/lonch/edit_lonch/'.$lonch_id);
        }
    }
    
    
	//public function schedule_from_destination_eng(){
	//	$from_destination = $this->input->post('from_destination');
	//	$from_destination_eng = $this->lonch_model->get_from_destination_eng($from_destination);
	//	echo $from_destination_eng;
	//}
	
    //this function for add a lonch schedule
    public function add_lonch_schedule($lonch_id){
        $attr=array(
            'lonch_id'=>$lonch_id,
            'from_destination'=>$_POST['from_destination'],
			'from_destination_eng'=>$this->lonch_model->get_from_destination_eng($_POST['from_destination']),
            'to_destination'=>$_POST['to_destination'],
			'to_destination_eng'=>$this->lonch_model->get_from_destination_eng($_POST['to_destination']),
            'day'=>$_POST['schedule_day'],
            'time'=>$_POST['schedule_time']
        );
        if($this->db->insert('lonch_schedules', $attr)){
            $this->session->set_userdata('success_msg', 'The lonch schedule updated');
        }else{
            $this->session->set_userdata('error_msg', 'Something wrong please try again');
        }
    }
    //this function for add a lonch schedule
    public function edit_lonch_schedule($lonch_id, $schedule_id){
        $attr=array(
            'lonch_id'=>$lonch_id,
            'from_destination'=>$_POST['from_destination'],
			'from_destination_eng'=>$this->lonch_model->get_from_destination_eng($_POST['from_destination']),
            'to_destination'=>$_POST['to_destination'],
			'to_destination_eng'=>$this->lonch_model->get_from_destination_eng($_POST['to_destination']),
            'day'=>$_POST['schedule_day'],
            'time'=>$_POST['schedule_time']
        );
        if($this->db->where('id', $schedule_id)->update('lonch_schedules', $attr)){
            $this->session->set_userdata('success_msg', 'The lonch schedule updated');
        }else{
            $this->session->set_userdata('error_msg', 'Something wrong please try again');
        }
    }
    // this method for delete a lonch schedules
    public function delete_lonch_schedule($lonch_id, $schedule_id){
        if($this->db->where('id', $schedule_id)->delete('lonch_schedules')){
			if($this->db->where(array('id'=>$schedule_id,'lonch_id'=>$lonch_id))->delete('lonch_floors')){
				if($this->db->where(array('id'=>$schedule_id,'lonch_id'=>$lonch_id,'floor_id'=>$schedule_id))->delete('cabin_plan')){
					$this->session->set_userdata('success_msg', 'The lonch schedule, corresponds floor, cabin deleted');
					redirect('admin/lonch/edit_lonch/'.$lonch_id);
				}
			}
        }else{
            $this->session->set_userdata('error_msg', 'Something wrong please try again');
            redirect('admin/lonch/edit_lonch/'.$lonch_id);
        }
    }
    
    // this function for deletea a lonch
    public function delete_lonch($id){
        
        $data['lonch'] = $this->lonch_model->get_lonch($id);
        if($this->user_type='admin'){
            // you can edit this group
        }
        elseif($this->user_type='owner' and $data['lonch']->owner_id==$tihs->$user_id){
            // you can edit this group
        }else{
            // you can not edit this group
            redirect('error');
        }
        
        if($this->db->where('id', $id)->delete('lonch')){
            $this->session->set_userdata('success_msg', 'You have successfully delete a lonch');
            if(file_exists('./uploads/lonch/'.$data['lonch']->picture)){
                unlink('./uploads/lonch/'.$data['lonch']->picture);
            }
                redirect('admin/lonch/all_lonch');
        }else{
            $this->session->set_userdata('error_msg', 'Something went wrong please try again letter');
                redirect('admin/lonch/all_lonch');
        }
    }
    
    
    // this method for lonch destinations
    public function destination($destination_id=null){
        if($this->user_type!='admin'){redirect('admin/lonch');}// security alert
        
        if($this->input->post('submit_destination')){
            $destination_name = $this->db->escape_str($this->input->post('destination_name'));
            $destination_name = str_replace(" ",'',$destination_name);
            $attr['name']=$destination_name;
			$destination_name_eng = $this->db->escape_str($this->input->post('destination_name_eng'));
            $destination_name_eng = str_replace(" ",'',$destination_name_eng);
            $attr['name_eng']=$destination_name_eng;
			
            if($destination_id){
                if($this->db->where('id', $destination_id)->update('destinations', $attr)){
                    $this->session->set_userdata('cuccess_msg', 'Your data hasbeen updated');
                }else{
                    $this->session->set_userdata('error_msg', 'Something went wrong please try again letter');
                }
            }else{
                if($this->db->insert('destinations', $attr)){
                    $this->session->set_userdata('cuccess_msg', 'Your data hasbeen updated');
                }else{
                    $this->session->set_userdata('error_msg', 'Something went wrong please try again letter');
                }
            }
        }
        
        if($destination_id){
            $data['destination_id']=$destination_id;
            $data['destination']=$this->lonch_model->get_destination($destination_id);
        }
        $data['destinations']=$this->lonch_model->lonch_destinations();
        $this->load->view('admin/lonch/lonch_destinations', $data);
    }
    
    // this function for delete destination 
    public function delete_destination($id){
        if($this->user_type!='admin'){redirect('admin/lonch');}// security alert
        if($this->db->where('id', $id)->delete('destinations')){
            $this->session->set_userdata('success_msg', 'You have successfully delete a destination');
                redirect('admin/lonch/destination');
        }else{
            $this->session->set_userdata('error_msg', 'Something went wrong please try again letter');
                redirect('admin/lonch/destination');
        }
    }
    
    
    // this function for lonch cabin type
    public function cabin_type($cabin_type_id=null){
        
        
        if($this->input->post('submit_cabin_type')){
            $title = $this->db->escape_str($this->input->post('title'));
            $price = $this->input->post('price');
            $title = str_replace(" ",'',$title);
            $attr['title']=$title;
            $attr['price']=$price;
            if($this->user_type!=='admin'){
                $attr['owner_id']=$this->user_id;
            }
            if($cabin_type_id){
                
                if($this->db->where('id', $cabin_type_id)->update('cabin_type', $attr)){
                    $this->session->set_userdata('cuccess_msg', 'Your data hasbeen updated');
                }else{
                    $this->session->set_userdata('error_msg', 'Something went wrong please try again letter');
                }
            }else{
                if($this->db->insert('cabin_type', $attr)){
                    $this->session->set_userdata('cuccess_msg', 'Your data hasbeen updated');
                }else{
                    
                    $this->session->set_userdata('error_msg', 'Something went wrong please try again letter');
                }
            }
        }
        
        if($cabin_type_id){
            $data['cabin_type_id']=$cabin_type_id;
            $data['cabin_type']=$this->lonch_model->get_cabin_type($cabin_type_id);
        }
        $data['cabin_types']=$this->lonch_model->get_cabin_types();
        $this->load->view('admin/lonch/cabin_type', $data);
    }
    
    // delete cabin type
    public function delete_cabin_type($id){
        
        if($this->db->where('id', $id)->delete('cabin_type')){
            $this->session->set_userdata('success_msg', 'You have successfully delete a cabin type');
                redirect('admin/lonch/cabin_type');
        }else{
            $this->session->set_userdata('error_msg', 'Something went wrong please try again letter');
                redirect('admin/lonch/cabin_type');
        }
    }
    
    /*====================================================
        AJAX FUNCTION
    ======================================================*/
    public function lonch_list_by_owner($owner_id){
        $lonch_list = $this->lonch_model->lonch_by_owner($owner_id);
        if($lonch_list){
            echo '<option value="">Select lonch....</option>';
            foreach($lonch_list as $lonch){
                
                echo '<option value="'.$lonch->id.'">'.$lonch->lonch_name.'</option>';
            }
        }else{
            echo '<option value="">Select lonch....</option>';
        }
    }
    public function lonch_list_by_group(){
		$group_id = $this->input->post('group_id');
        $lonch_list = $this->lonch_model->lonch_by_group($group_id);
        if($lonch_list){
            echo '<option value="">Select lonch....</option>';
            foreach($lonch_list as $lonch){
                echo '<option value="'.$lonch->id.'">'.$lonch->lonch_name.'</option>';
            }
        }else{
            echo '<option value="">Select lonch....</option>';
        }
    }
	public function schedule_list_by_lonch(){
		$lonch_id = $this->input->post('lonch_id');
        $schedule_list = $this->lonch_model->schedule_by_lonch($lonch_id);
        if($schedule_list){
            echo '<option value="">Select lonch....</option>';
            foreach($schedule_list as $schedule){
				echo '<option value="'.$schedule->id.'">'.$schedule->from_destination.'~'.$schedule->to_destination.' ('.$schedule->day.'|'.$schedule->time.')</option>';
            }
        }else{
            echo '<option value="">Select lonch....</option>';
        }
    }
	public function floor_by_lonch_schedule($lonch_id,$schedule_id){
        $floor_list = $this->lonch_model->get_lonch_floors_data_new($lonch_id,$schedule_id);
        if($floor_list){
            echo '<option value="">Select floor....</option>';
            foreach($floor_list as $floor){
				echo '<option value="'.$floor->id.'">'.$floor->floor_name.'</option>';
            }
        }else{
            echo '<option value="">Select floor....</option>';
        }
    }
    
    // get lonch cabin plan
    public function get_cabin_plan($lonch_id, $floor_id, $floor_cabin, $schedule_id, $floor_name, $form_group){
		//echo $lonch_id.'~'.$floor_id.'~'.$floor_cabin.'~'.$schedule_id.'~'.$floor_name.'~'.$form_group;
			
        $lonch = $this->lonch_model->get_lonch($lonch_id);
        $lonch_floor = $this->lonch_model->get_floor($floor_id);
        $cabin_plans = $this->lonch_model->get_cabin_plans($lonch_id, $floor_id, $floor_cabin, $floor_name);
		//print_r($cabin_plans);//exit;
        //$cabin_types = $this->lonch_model->get_cabin_types();
		if($form_group=='group'){
			if($cabin_plans!=false){
				for($cabin=0; $cabin<$floor_cabin; $cabin++){
					$cabin_number = $actual = $sells = $commission=0;
					
					$cabin_number = $cabin_plans[$cabin]['cabin'];
					$actual = $cabin_plans[$cabin]['actual_price'];
					$sells = $cabin_plans[$cabin]['sells_price'];
					$commission = $cabin_plans[$cabin]['commission'];
					
					echo '<div class="col-sm-3">
							  <div class="form-group row">
									<label for="cabin_'.$cabin_number.'" class="col-sm-12 col-form-label">Cabin: '.$cabin_number.'</label>
									<div class="col-sm-12">
										<input class="col-sm-4" name="cabin_actual_'.$cabin_number.'" id="cabin_actual_'.$cabin_number.'" class="form-control" placeholder="Actual" onkeyup="calculateCommission(cabin_actual_'.$cabin_number.',cabin_sells_'.$cabin_number.',cabin_commission_'.$cabin_number.')" value="'.$actual.'" readonly/>
										<input class="col-sm-4" name="cabin_sells_'.$cabin_number.'" id="cabin_sells_'.$cabin_number.'" class="form-control" placeholder="Sells" onkeyup="calculateCommission(cabin_actual_'.$cabin_number.',cabin_sells_'.$cabin_number.',cabin_commission_'.$cabin_number.')" value="'.$sells.'" readonly/>
										<input class="col-sm-4" name="cabin_commission_'.$cabin_number.'" id="cabin_commission_'.$cabin_number.'" class="form-control" placeholder="commission" tabindex="-1" value="'.$commission.'" readonly/>
									</div>
								</div>
						  </div>';
				}
			}else{
				echo '<div class="col-sm-3">
						  <div class="form-group row">
								<div class="col-sm-12">NO DATA</div>
							</div>
					  </div>';
			}
		}else if($form_group=='lonch'){
			if($cabin_plans!=false){
				for($cabin=0; $cabin<$floor_cabin; $cabin++){
					$cabin_number = $actual = $sells = $commission=0;
					
					$cabin_number = $cabin_plans[$cabin]['cabin'];
					$actual = $cabin_plans[$cabin]['actual_price'];
					$sells = $cabin_plans[$cabin]['sells_price'];
					$commission = $cabin_plans[$cabin]['commission'];
					
					echo '<div class="col-sm-3">
							  <div class="form-group row">
									<label for="cabin_'.$cabin_number.'" class="col-sm-12 col-form-label">Cabin: '.$cabin_number.'</label>
									<div class="col-sm-12">
										<input class="col-sm-4" name="cabin_actual_'.$cabin_number.'" id="cabin_actual_'.$cabin_number.'" class="form-control" placeholder="Actual" onkeyup="calculateCommission(cabin_actual_'.$cabin_number.',cabin_sells_'.$cabin_number.',cabin_commission_'.$cabin_number.')" value="'.$actual.'" required/>
										<input class="col-sm-4" name="cabin_sells_'.$cabin_number.'" id="cabin_sells_'.$cabin_number.'" class="form-control" placeholder="Sells" onkeyup="calculateCommission(cabin_actual_'.$cabin_number.',cabin_sells_'.$cabin_number.',cabin_commission_'.$cabin_number.')" value="'.$sells.'" required/>
										<input class="col-sm-4" name="cabin_commission_'.$cabin_number.'" id="cabin_commission_'.$cabin_number.'" class="form-control" placeholder="commission" tabindex="-1" value="'.$commission.'" readonly required/>
									</div>
								</div>
						  </div>';
				}
			}else{
				for($cabin=1; $cabin<=$floor_cabin; $cabin++){
					//$cabin_plan_type_id = $this->cabin_plan_type_id($cabin_plans, $cabin);
					echo '<div class="col-sm-3">
							  <div class="form-group row">
									<label for="cabin_'.$cabin.'" class="col-sm-12 col-form-label">Cabin: '.$cabin.'</label>
									<div class="col-sm-12">
										<input class="col-sm-4" name="cabin_actual_'.$cabin.'" id="cabin_actual_'.$cabin.'" class="form-control" placeholder="Actual" onkeyup="calculateCommission(cabin_actual_'.$cabin.',cabin_sells_'.$cabin.',cabin_commission_'.$cabin.')" required/>
										<input class="col-sm-4" name="cabin_sells_'.$cabin.'" id="cabin_sells_'.$cabin.'" class="form-control" placeholder="Sells" onkeyup="calculateCommission(cabin_actual_'.$cabin.',cabin_sells_'.$cabin.',cabin_commission_'.$cabin.')" required/>
										<input class="col-sm-4" name="cabin_commission_'.$cabin.'" id="cabin_commission_'.$cabin.'" class="form-control" placeholder="commission" tabindex="-1" readonly required/>
									</div>
								</div>
						  </div>';
				}
			}
		}
        echo '<input name="lonch_id" type="hidden" value="'.$lonch_id.'" />';
        echo '<input name="floor_id" type="hidden" value="'.$floor_id.'" />';
		echo '<input name="floor_cabin" type="hidden" value="'.$floor_cabin.'" />';
		echo '<input name="schedule_id" type="hidden" value="'.$schedule_id.'" />';
		echo '<input name="floor_name" type="hidden" value="'.$floor_name.'" />';
    }
   
    // function for make cabin types option 
    public function make_cabin_type_option($cabin_types, $select_id=null){
        $options=null;
        $selected=null;
        
        if($cabin_types){
            foreach($cabin_types as $type){
                if($select_id==$type->id){$selected='selected';}else{$selected=null;}
                $options.=' <option value="'.$type->id.'" '.$selected.'>'.$type->title.' | '.$type->price.' '.$this->config->item('currency_symbol').'</option>';
            }
        }
        return $options;
    }
    
    // this function for select cabin plan select id 
    public function cabin_plan_type_id($cabin_plans, $cabin){
        $type_id=null;
        if($cabin_plans){
            foreach($cabin_plans as $plan){
                if($plan->cabin_number==$cabin){
                    $type_id=$plan->cabin_type_id;
                }
            }
        }
        return $type_id;
    }
    
    // save cabin plan 
    public function save_cabin_plan(){ 
        $data['sign_up_success']=false;
        $errors=array();
        $lonch_id=$this->input->post('lonch_id');
        $floor_id=$this->input->post('floor_id');
		$floor_cabin=$this->input->post('floor_cabin');
		$schedule_id=$this->input->post('schedule_id');
		$floor_name=$this->input->post('floor_name');
		$floor_name = str_replace('%20', ' ', $floor_name);
		
        $lonch = $this->lonch_model->get_lonch($lonch_id);
        $lonch_floor = $this->lonch_model->get_floor($floor_id);
	
        $total_actual = $total_sells = $total_commission = 0;
        if(($lonch_id!='') && ($floor_id!='') && ($floor_cabin>0) && ($schedule_id!='') && ($floor_name!='')){
            for($cabin=1; $cabin<=$floor_cabin; $cabin++){
				$cabin_actual = $this->input->post('cabin_actual_'.$cabin);
				$cabin_sells = $this->input->post('cabin_sells_'.$cabin);
				$cabin_commission = $this->input->post('cabin_commission_'.$cabin);
		
				$total_actual = $total_actual+$cabin_actual;
				$total_sells = $total_sells+$cabin_sells;
				$total_commission = $total_commission+$cabin_commission;
				
                if($this->save_single_cabin_plan($floor_name,$schedule_id, $lonch_id, $floor_id, $cabin, $cabin_actual, $cabin_sells, $cabin_commission)){
                }else{
					$errors[]='cabin_'.$cabin.' Not Inputed';
				}
            }
            if($this->update_lonch_floor($floor_name,$schedule_id, $lonch_id, $floor_id, $cabin, $total_actual, $total_sells, $total_commission)){
			}else{
				$errors[]='cabin_'.$cabin.' Not Inputed';
			}
        }
        if(!$errors){ $data['sign_up_success']=true; }else{ $data['sign_up_success']=false; }
        
        echo json_encode($data);
    }
    
    // save single acbin plan
    public function save_single_cabin_plan($floor_name, $schedule, $lonch_id, $floor_id, $cabin_number, $actual, $sells, $commission){
        if($this->lonch_model->single_cabin_plan($floor_name, $schedule, $lonch_id, $floor_id, $cabin_number)){
            if($this->db->where(array('id'=>$schedule,'lonch_id'=>$lonch_id, 'floor_id'=>$floor_id, 'floor_name'=>$floor_name, 'cabin_number'=>$cabin_number))->update('cabin_plan', array('actual_price'=>$actual, 'sells_price'=>$sells, 'commission'=>$commission))){
                return true;
            }else{
                return false;
            }
        }else{
            if($this->db->insert('cabin_plan', array('id'=>$schedule, 'lonch_id'=>$lonch_id, 'floor_id'=>$floor_id, 'floor_name'=>$floor_name, 'cabin_number'=>$cabin_number, 'actual_price'=>$actual, 'sells_price'=>$sells, 'commission'=>$commission))){
                return true;
            }else{
                return false;
            }
        }
    }
	public function update_lonch_floor($floor_name, $schedule, $lonch_id, $floor_id, $cabin, $total_actual, $total_sells, $total_commission){
		//$floor_name = str_replace(' ', '%20', $floor_name);
		//$data = array('id'=>$schedule,'lonch_id'=>$lonch_id, 'floor_name'=>$floor_name);
		//echo $total_actual.'>'.$total_sells.'>'.$total_commission;
		//print_r($data);//exit;
		if($this->db->where(array('id'=>$schedule,'lonch_id'=>$lonch_id,'floor_name'=>$floor_name))->update('lonch_floors', array('cabin_price'=>$total_actual, 'cabin_sells_price'=>$total_sells, 'cabin_commission'=>$total_commission))){
			return true;
		}else{
			return false;
		}
	}
      
    
    /*This is a fucntion that upload the hotel image*/
    public function do_upload($upload_path, $file_input_field){
        $path = $upload_path; 
        $fileTmpName=$_FILES[$file_input_field]["tmp_name"];
        $upload_dir = $upload_path; 
        $file_name = $_FILES[$file_input_field]['name'];
        $type = explode('.', $file_name);
        $type = $type[count($type)-1];
        $time = time();
        if( in_array($type, array('jpg', 'png', 'jpeg', 'gif', 'JPEG', 'PNG', 'JPG', 'GIF' )) ){
            if( is_uploaded_file( $_FILES[$file_input_field]['tmp_name'] ) ){
                move_uploaded_file( $_FILES[$file_input_field]['tmp_name'], $upload_dir.$time.$file_input_field.$file_name );
                return $time.$file_input_field.$file_name;
            }
        }else{
            $this->session->set_userdata('error_msg', 'File type not supported');
            return false;
        }
   }
    
}

