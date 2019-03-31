<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends Customer_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('booking_model');
        $this->load->model('lonch_model');
        $this->user_type=$this->session->userdata('current_user_type');
        $this->user_id=$this->session->userdata('current_user_id');
    }
	public function index()
	{
        $data['user_data']=$this->user_model->get_user($this->session->userdata('current_user_id'));
        $this->load->model('user_model');
        $data['load']=$this->load;
        $this->load->view('frontend/customer/home', $data);
	}
    
    
    /*This function for edit profile*/
    
    public function edit_profile(){
        
        if($this->input->post('save_profile')){
            $update_attr=array(
                'first_name'=>$this->input->post('first_name'),
                'last_name'=>$this->input->post('last_name'),
                'phone'=>$this->input->post('phone'),
                'email'=>$this->input->post('email'),
                'birthday'=>$this->input->post('birthday'),
                'address1'=>$this->input->post('address1'),
                'address2'=>$this->input->post('address2'),
                'post_code'=>$this->input->post('post_code'),
                'country'=>$this->input->post('country'),
                'city'=>$this->input->post('city'),
                'state'=>$this->input->post('state'),
                'nid_number'=>$this->input->post('nid_number'),
                'passport_number'=>$this->input->post('passport_number')
            );
            
            if($this->db->where('id', $this->session->userdata('current_user_id'))->update('users', $update_attr)){
                $this->session->set_userdata('success_msg', 'Yout profile hasbeen updated');
				
            }else{
                $this->session->set_userdata('error_msg', 'Something wrong please try again');
            }
        }
        
         $data['user_data']=$this->user_model->get_user($this->session->userdata('current_user_id'));
        $this->load->view('frontend/customer/edit', $data);
    }

    /*This fucntion for edit photo*/
    public function edit_photo(){
        if($filename=$this->do_upload('profile_picture')){
            $update_attr=array( 'image'=>$filename );
            /*If file uploaded then insert file name in database*/
            if($this->db->where('id', $this->session->userdata('current_user_id'))->update('users', $update_attr)){
                $this->session->set_userdata('success_msg', 'Yout profile hasbeen updated');
                 redirect('customer');
            }else{
                $this->session->set_userdata('error_msg', 'Something wrong please try again');
                 redirect('customer/edit_profile');
            }
        }else{
            $this->session->set_userdata('error_msg', 'File does note upload. Please try another image');
            redirect('customer/edit_profile');
        }
    }
    
    /*This function for change password*/
    public function change_password(){
        if($this->input->post('change_password')){
            $update_attr=array( 'password'=>md5($this->input->post('password')) );
            if($this->db->where('id', $this->session->userdata('current_user_id'))->update('users', $update_attr)){
                $this->session->set_userdata('success_msg', 'Your Profile hasbeen changed.');
                 redirect('customer');
            }else{
                $this->session->set_userdata('error_msg', 'Something wrong please try again');
                 redirect('customer/edit_profile');
            }
        }
        $data['user_data']=$this->user_model->get_user($this->session->userdata('current_user_id'));
         $this->load->view('frontend/customer/change-password', $data);
    }
    
    public function list_order(){
        $data['user_data']=$this->user_model->get_user($this->session->userdata('current_user_id'));
        $this->load->model('user_model');
        $data['load']=$this->load;
        $data['list_order_completed']=$this->booking_model->passenger_order_list($this->user_id);
		$data['list_order_pending']=$this->booking_model->passenger_pending_order_list($this->user_id);
		//print_r($data);exit;
        $this->load->view('frontend/customer/list_order', $data);
    }
    
    
    public function thank_you($booking_id=null){
        if(!$booking_id){redirect('customer');}
        $data['booking']=$this->booking_model->get_booking($booking_id);
        $data['booking_list']=$this->booking_model->get_booking_list($booking_id);
        $data['booking_list_single']=$this->booking_model->get_booking_list_single($booking_id);
        $select_cabins=$this->cabin_ids($data['booking_list']);
        $data['submit_cabins']=$select_cabins;
        $data['user_data']=$this->user_model->get_user($this->session->userdata('current_user_id'));
        
        
        $this->load->view('frontend/customer/thank_you', $data);
    }
    
    public function print_order($booking_id=null){
        if(!$booking_id){redirect('customer');}
        $data['booking']=$this->booking_model->get_booking($booking_id);
        $data['booking_list']=$this->booking_model->get_booking_list($booking_id);
        $data['booking_list_single']=$this->booking_model->get_booking_list_single($booking_id);
        $select_cabins=$this->cabin_ids($data['booking_list']);
        $data['submit_cabins']=$select_cabins;
        $data['user_data']=$this->user_model->get_user($this->session->userdata('current_user_id'));
        $this->load->view('frontend/customer/print_order', $data);
    }
    
    public function cabin_ids($booking_list){
        $cabins=array();
            if($booking_list){
                foreach($booking_list as $book){
                    $cabins[]=$book->cabin_number;
                }
            }
        return $cabins;
    }
    
    
/*File upload function*/
 public function do_upload($field_name){
        $path = './uploads/users/'; 
        $fileTmpName=$_FILES['profile_picture']["tmp_name"];
        $upload_dir = './uploads/users/'; 
        $file_name = $_FILES['profile_picture']['name'];
        $type = explode('.', $file_name);
        $type = $type[count($type)-1];
        $time = time();
        if( in_array($type, array('jpg', 'png', 'jpeg', 'gif', 'JPEG', 'PNG', 'JPEG', 'GIF' )) ){
            if( is_uploaded_file( $_FILES['profile_picture']['tmp_name'] ) ){
                move_uploaded_file( $_FILES['profile_picture']['tmp_name'], $upload_dir.$time.$file_name );
                return $time.$file_name;
            }
        }else{
            return false;
        }
   }
    
    
}
