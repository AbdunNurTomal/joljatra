<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staff extends Admin_Controller{
    public $user_types;
    public function __construct(){
        parent::__construct();
        $this->user_types = array('administrator', 'agent');
        $this->load->model('staff_model');
        
        $user_type = $this->session->userdata('current_user_type');
        if($user_type == 'admin' or $user_type == 'accountant'){}else{redirect('admin/dashboard');}
    }
	public function index()
	{
		$this->all_staff();
	}
    
    
    /*This functionality for users display, add, edit, and delete*/
    public function all_staff($page=null)
	{
        $this->load->library('pagination');
        $config['base_url'] = base_url().'admin/staff/all_staff/';
        $config['use_page_numbers'] = FALSE;
        $config['total_rows'] = $this->staff_model->get_staff_count();
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
        $current_page=$current_page=$this->uri->segment(4);
        
        $this->pagination->initialize($config); 
        $data['links']=$this->pagination->create_links();
      
        $data['user_data']=$this->staff_model->get_all_staff($config['per_page'],  $current_page);
		$this->load->view("admin/staff/all_staff", $data);
	}
    
    
    
    
    public function add_new(){
        $data=array();
         if($this->input->post('save_staff')){
             
        
            $update_attr=array(
                'first_name'=>$this->input->post('first_name'),
                'last_name'=>$this->input->post('last_name'),
                'designation'=>$this->input->post('designation'),
                'image'=>'demo-avater.png',
                'email'=>$this->input->post('email'),
                'salary'=>$this->input->post('salary'),
            );
            
              if($this->db->insert('staff', $update_attr)){
                    $this->session->set_userdata('success_msg', 'You have successfully add a user. Please this user profiles');
                     redirect('admin/staff/edit_staff/'.$this->db->insert_id());
                }else{
                    $this->session->set_userdata('error_msg', 'Something wrong please try again');
                }  
            
        }
        
        
		$this->load->view('admin/staff/add_new', $data);
    }
    
    
    /*This funciton for edit users*/
    public function edit_staff($staff_id){
        $data['staff_id']=$staff_id;
        if($this->input->post('save_staff')){
            $update_attr=array(
                'first_name'=>$this->input->post('first_name'),
                'last_name'=>$this->input->post('last_name'),
                'designation'=>$this->input->post('designation'),
                'phone'=>$this->input->post('phone'),
                'email'=>$this->input->post('email'),
                'birthday'=>$this->input->post('birthday'),
                'address1'=>$this->input->post('address1'),
                'address2'=>$this->input->post('address2'),
                'country'=>$this->input->post('country'),
                'city'=>$this->input->post('city'),
                'state'=>$this->input->post('state'),
                'nid_number'=>$this->input->post('nid_number'),
                'passport_number'=>$this->input->post('passport_number'),
                'salary'=>$this->input->post('salary')
            );
            
            if($this->db->where('id', $staff_id)->update('staff', $update_attr)){
                $this->session->set_userdata('success_msg', 'Your user hasbeen updated');
            }else{
                $this->session->set_userdata('error_msg', 'Something wrong please try again');
            }
        }
        
         $data['user_data']=$this->staff_model->get_staff($staff_id);
        $this->load->view('admin/staff/edit', $data);
    }
    
    /*This fucntion for edit user photo photo*/
    public function edit_photo($user_id){
        if($filename=$this->do_upload('profile_picture')){
            $update_attr=array( 'image'=>$filename );
            /*If file uploaded then insert file name in database*/
            if($this->db->where('id', $user_id)->update('staff', $update_attr)){
                $this->session->set_userdata('success_msg', 'Your profile has been updated');
                 redirect('admin/staff/edit_staff/'.$user_id);
            }else{
                $this->session->set_userdata('error_msg', 'Something wrong please try again');
                 redirect('admin/staff/edit_staff/'.$user_id);
            }
        }else{
            $this->session->set_userdata('error_msg', 'File does note upload. Please try another image');
            redirect('admin/staff/edit_staff/'.$user_id);
        }
    }

    
    /*This funciton for delete users*/

    public function delete($id){
        if($this->db->where('id', $id)->delete('staff')){
            $this->session->set_userdata('success_msg', 'You have successfully delete a user');
                redirect('admin/staff/all_staff');
        }else{
            $this->session->set_userdata('error_msg', 'Something went wrong please try again letter');
                redirect('admin/staff/all_staff');
        }
    }
    
    
    /*===================================================================================
                       STARTING THE SALARY OF STUFF REPORT
    ===================================================================================*/
    public function report($year=null){
        if($this->input->post('staff_report') and $this->input->post('year')){
            redirect('admin/staff/report/'.$this->input->post('year'));
        }
        if(!$year){ $year=date('Y',time());}
        $data=array();
        $data['year']=$year;
        $data['salary_table'] = $this->staff_model->get_staff_report($year);
        
        $this->load->view('admin/staff/staff_report', $data);
    }    
    
    
    //This function for download staff salary report by pdf
    public function pdf($year=null){
        if($this->input->post('staff_report') and $this->input->post('year')){
            redirect('admin/staff/report/'.$this->input->post('year'));
        }
        if(!$year){ $year=date('Y',time());}
        $data=array();
        $data['year']=$year;
        $this->load->helper('pdf_helper');
        $data['salary_table'] = $this->staff_model->get_staff_report_for_pdf($year);
        
        $this->load->view('admin/staff/pdf_report', $data);
    }
    
    
    //this function for change the report salary status
    public function change_report($staff_id, $year, $month){
        if(!$staff_id and !$year and !$month){
            redirect('admin/staff/report');
        }
        $data['month']=$month;
        $data['year']=$year;
        $data['staff'] = $this->staff_model->get_staff($staff_id);
        $data['staff_salary_status'] = $this->staff_model->get_staff_salary($staff_id, $year, $month);
        
        if($this->input->post('change_staff_report')){
            $attr=array();
            $attr['advance']=$this->input->post('advance');
            $attr['status']=$this->input->post('status');
            if($data['staff_salary_status']){
                if($this->db->where(array('staff_id'=>$staff_id, 'year'=>$year, 'month'=>$month))->update('salary', $attr)){
                    $this->session->set_userdata('success_msg', 'Your salary status updated');
                }else{
                    $this->session->set_userdata('error_msg', 'Something went wrong please try again letter');
                }
            }else{
                $attr['staff_id']=$staff_id;
                $attr['year']=$year;
                $attr['month']=$month;
                if($this->db->insert('salary', $attr)){
                    $this->session->set_userdata('success_msg', 'Your salary status updated');
                }else{
                    $this->session->set_userdata('error_msg', 'Something went wrong please try again letter');
                }
            }
        }
        $data['staff'] = $this->staff_model->get_staff($staff_id);
        $data['staff_salary_status'] = $this->staff_model->get_staff_salary($staff_id, $year, $month);
        $this->load->view('admin/staff/change_report', $data);
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
