<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends Admin_Controller{
    public $user_types;
    public function __construct(){
        parent::__construct();
        $this->user_types = array('administrator', 'agent');
        $this->user_type=$this->session->userdata('current_user_type');
        $this->user_id=$this->session->userdata('current_user_id');
    }
	public function index()
	{
		$this->all_user();
	}
    
    
    /*This functionality for users display, add, edit, and delete*/
    public function all_user($user_type=null, $page=null)
	{
        if($this->user_type=='manager'){redirect('admin/dashboard');}
        $this->load->library('pagination');
        $config['base_url'] = base_url().'admin/users/all_user/';
        $config['use_page_numbers'] = FALSE;
        $config['total_rows'] = $this->user_model->get_user_count($user_type);
		$config['per_page'] = 10;
        $config['full_tag_open'] = '<ul style="margin: 0;" class="pagination pagination-sm">';
		$config['full_tag_close'] = '</ul>';
		$config['last_link'] = 'LAST →';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['first_link'] = '← FIRST';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<a>';
		$config['cur_tag_close'] = '</a>';
		$config['next_link'] = '';
		$config['prev_link'] = '';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
        if(array_key_exists($user_type, $this->user_types)){
            $config['base_url'] = base_url().'admin/users/all_user/'.$user_type;
           $current_page=$this->uri->segment(5);
        }else{
            $current_page=$current_page=$this->uri->segment(4);
            $user_type=null;
            $config['total_rows'] = $this->user_model->get_user_count();
             $config['base_url'] = base_url().'admin/users/all_user/';
        }
        
        $this->pagination->initialize($config); 
        $data['links']=$this->pagination->create_links();
        $data['user_type']=$user_type;
        $data['user_types']=$this->user_types;
        $data['user_data']=$this->user_model->get_all_user($user_type, $config['per_page'],  $current_page);
		$this->load->view("admin/users/all_user", $data);
	}
    
    
    
    
    public function add_new(){
        if($this->user_type=='manager' ){
            if($this->user_id!=$user_id){
               redirect('admin/dashboard'); 
            }
        }
        $data=array();
         if($this->input->post('sign_up')){
             
             $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
             $this->form_validation->set_rules('user_name', 'User Name', 'trim|required|is_unique[users.user_name]');
             
            $update_attr=array(
                'first_name'=>$this->input->post('first_name'),
                'last_name'=>$this->input->post('last_name'),
                'user_name'=>$this->input->post('user_name'),
                'password'=>md5($this->input->post('password')),
                'image'=>'demo-avater.png',
                'email'=>$this->input->post('email'),
                'type'=>$this->input->post('type')
            );
            
             if($this->input->post('type')=='manager'){
                 $update_attr['owner_id']=$this->input->post('owner_id');
                 $update_attr['lonch_id']=$this->input->post('lonch_id');
             }
             
             if($this->form_validation->run()){
                   if($this->db->insert('users', $update_attr)){
                    $this->session->set_userdata('success_msg', 'You have successfully add a user. Please this user profiles');
                     redirect('admin/users/edit_user/'.$this->db->insert_id());
                }else{
                    $this->session->set_userdata('error_msg', 'Something wrong please try again');
                }  
             }else{
                 $data['validation_errors']=validation_errors('<p>', '</p>');
                  $this->session->set_userdata('error_msg', 'Something wrong please try again. Validation Error');
             }
            
        }
        
        
		$this->load->view('admin/users/add_new', $data);
    }
    
    
    /*This funciton for edit users*/
    public function edit_user($user_id){
        
        if($this->user_type=='manager' ){
            if($this->user_id!=$user_id){
               redirect('admin/dashboard'); 
            }
        }
        
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
        $this->load->view('admin/users/edit', $data);
    }
    
    /*This fucntion for edit user photo photo*/
    public function edit_photo($user_id){
        if($this->user_type=='manager' ){
            if($this->user_id!=$user_id){
               redirect('admin/dashboard'); 
            }
        }
        if($filename=$this->do_upload('profile_picture')){
            $update_attr=array( 'image'=>$filename );
            /*If file uploaded then insert file name in database*/
            if($this->db->where('id', $user_id)->update('users', $update_attr)){
                $this->session->set_userdata('success_msg', 'Your profile has been updated');
                 redirect('admin/users/edit_user/'.$user_id);
            }else{
                $this->session->set_userdata('error_msg', 'Something wrong please try again');
                 redirect('admin/users/edit_user/'.$user_id);
            }
        }else{
            $this->session->set_userdata('error_msg', 'File does note upload. Please try another image');
            redirect('admin/users/edit_user/'.$user_id);
        }
    }
    
    
    
    /*This function for change password*/
    public function change_password($user_id){
        if($this->user_type=='manager' ){
            if($this->user_id!=$user_id){
               redirect('admin/dashboard'); 
            }
        }
        if($this->input->post('change_password')){
            $update_attr=array( 'password'=>md5($this->input->post('password')) );
            if($this->db->where('id', $user_id)->update('users', $update_attr)){
                $this->session->set_userdata('success_msg', 'Your Password changed.');
                 redirect('admin/users/edit_user/'.$user_id);
            }else{
                $this->session->set_userdata('error_msg', 'Something wrong please try again');
                redirect('admin/users/edit_user/'.$user_id);
            }
        }
        $data['user_data']=$this->user_model->get_user($user_id);
        $data['user_id']=$user_id;
         $this->load->view('admin/users/change_password', $data);
    }
    
    
    
    /*This funciton for delete users*/
    /*This funcito for delete room*/
    public function delete($id){
        if($this->user_type=='manager'){redirect('admin/dashboard');}
        if($this->db->where('id', $id)->delete('users')){
            $this->session->set_userdata('success_msg', 'You have successfully delete a user');
                redirect('admin/users/all_user');
        }else{
            $this->session->set_userdata('error_msg', 'Something went wrong please try again letter');
                redirect('admin/users/all_user');
        }
    }
    
    
    /*This fucntion for image upload */
        
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
    
    
}
