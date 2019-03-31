<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends Admin_Controller{
    public function __construct(){
        parent::__construct();
        if($this->session->userdata('current_user_type')!='admin'){redirect('admin/dashboard');}
    }
	public function index()
	{
        $data['messages']=$this->user_model->all_message();
       
		$this->load->view('admin/message/message-list', $data);
	}
    
    // this functionf for view single message
    
    public function view($id){
        $data['message']=$this->user_model->get_message($id);
        $this->db->where('id', $id)->update('contact', array('status'=>'old'));
		$this->load->view('admin/message/message', $data);
    }
    
    /*This fucntion for delete a message from the list*/
    
    public function delete($id){
        if($this->db->where('id', $id)->delete('contact')){
             $this->session->set_userdata('success_msg', 'Your Deletion completed');
            redirect('admin/message');
        }else{
             $this->session->set_userdata('error_msg', 'Something wrong please try again');
        }
    }
}
