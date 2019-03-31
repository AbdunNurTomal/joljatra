<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends Agent_Controller{
    public function __construct(){
        parent::__construct();
        $this->user_types = array('administrator', 'customer');
    }
	public function index(){
        $data['user_id']=$this->session->userdata('current_user_id');
        $user_id=$this->session->userdata('current_user_id');
        if($this->input->post('save_user')){
            $update_attr=array(
                'first_name'=>$this->input->post('first_name'),
                'last_name'=>$this->input->post('last_name'),
                'phone'=>$this->input->post('phone'),
                'email'=>$this->input->post('email'),
                'birthday'=>$this->input->post('birthday'),
                'address1'=>$this->input->post('address1'),
                'address2'=>$this->input->post('address2'),
                'country'=>$this->input->post('country'),
                'city'=>$this->input->post('city'),
                'state'=>$this->input->post('state'),
                'nid_number'=>$this->input->post('nid_number'),
                'passport_number'=>$this->input->post('passport_number')
            );
            
            if($this->db->where('id', $user_id)->update('users', $update_attr)){
                $this->session->set_userdata('success_msg', 'Your user hasbeen updated');
            }else{
                $this->session->set_userdata('error_msg', 'Something wrong please try again');
            }
        }
        
         $data['user_data']=$this->user_model->get_user($user_id);
        $this->load->view('agent/users/edit', $data);
    }
    
    /*This funciton for edit users*/
    public function edit_user(){
        $user_id=$this->session->userdata('current_user_id');
        $data['user_id']=$user_id;
        if($this->input->post('save_user')){
            $update_attr=array(
                'first_name'=>$this->input->post('first_name'),
                'last_name'=>$this->input->post('last_name'),
                'phone'=>$this->input->post('phone'),
                'email'=>$this->input->post('email'),
                'birthday'=>$this->input->post('birthday'),
                'address1'=>$this->input->post('address1'),
                'address2'=>$this->input->post('address2'),
                'country'=>$this->input->post('country'),
                'city'=>$this->input->post('city'),
                'state'=>$this->input->post('state'),
                'nid_number'=>$this->input->post('nid_number'),
                'passport_number'=>$this->input->post('passport_number')
            );
            
            if($this->db->where('id', $user_id)->update('users', $update_attr)){
                $this->session->set_userdata('success_msg', 'Your user hasbeen updated');
            }else{
                $this->session->set_userdata('error_msg', 'Something wrong please try again');
            }
        }
        
         $data['user_data']=$this->user_model->get_user($user_id);
        $this->load->view('agent/users/edit', $data);
    }
    
    
    /*This fucntion for edit user photo photo*/
    public function edit_photo(){
        $user_id = $this->session->userdata('current_user_id');
        if($filename=$this->do_upload('profile_picture')){
            $update_attr=array( 'image'=>$filename );
            /*If file uploaded then insert file name in database*/
            if($this->db->where('id', $user_id)->update('users', $update_attr)){
                $this->session->set_userdata('success_msg', 'Your profile has been updated');
                 redirect('agent/profile');
            }else{
                $this->session->set_userdata('error_msg', 'Something wrong please try again');
                 redirect('agent/profile');
            }
        }else{
            $this->session->set_userdata('error_msg', 'File does note upload. Please try another image');
            redirect('agent/profile/');
        }
    }
    
    
    
    /*This function for change password*/
    public function change_password(){
        $user_id = $this->session->userdata('current_user_id');
        if($this->input->post('change_password')){
            $update_attr=array( 'password'=>md5($this->input->post('password')) );
            if($this->db->where('id', $user_id)->update('users', $update_attr)){
                $this->session->set_userdata('success_msg', 'Your Password changed.');
                 redirect('agent/profile/');
            }else{
                $this->session->set_userdata('error_msg', 'Something wrong please try again');
                redirect('agent/profile/edit_user/');
            }
        }
        $data['user_data']=$this->user_model->get_user($user_id);
        $data['user_id']=$user_id;
         $this->load->view('agent/users/change_password', $data);
    }
    
    
    
    
    /*File upload function*/
 public function do_upload(){
        $path = './uploads/users/'; 
        $fileTmpName=$_FILES['user_image']["tmp_name"];
        $upload_dir = './uploads/users/'; 
        $file_name = $_FILES['user_image']['name'];
        $type = explode('.', $file_name);
        $type = $type[count($type)-1];
        $time = time();
        if( in_array($type, array('jpg', 'png', 'jpeg', 'gif', 'JPEG', 'PNG', 'JPEG', 'GIF' )) ){
            if( is_uploaded_file( $_FILES['user_image']['tmp_name'] ) ){
                move_uploaded_file( $_FILES['user_image']['tmp_name'], $upload_dir.$time.$file_name );
                return $time.$file_name;
            }
        }else{
            $this->session->set_userdata('error_msg', 'File type not supported');
            return false;
        }
   }
    
    //end of class
}

