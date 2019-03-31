<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {
    
	public function index(){		
		$this->db->cache_on();
        if($this->input->post('send_message')){
            $this->form_validation->set_rules('name', 'Name', 'trim|xss_clean|htmlspecialchars|strip_tags');
			$this->form_validation->set_rules('mobile', 'Phone Number', 'trim|xss_clean|htmlspecialchars|strip_tags');
			$this->form_validation->set_rules('email', 'Email', 'trim|xss_clean|valid_email|strip_tags');
			$this->form_validation->set_rules('message', 'Message', 'trim|xss_clean|htmlspecialchars|strip_tags');
            
           $data_attr=array(
            'name'=>addslashes($this->input->post('name')),
            'phone'=>addslashes($this->input->post('mobile')),
            'email'=>addslashes($this->input->post('email')),
            'message'=>addslashes($this->input->post('message'))
           ); 
        
            if($this->form_validation->run()){
                if($this->db->insert('contact', $data_attr)){
                    $this->session->set_userdata('success_msg', 'You Have Successfully send a message to Website Admin.');
                    
                }else{
                    $this->session->set_userdata('error_msg', 'Something wrong please try again');
                } 
            }else{
                $data['validation_errors']=validation_errors('<p>', '</p>');
                  $this->session->set_userdata('error_msg', 'Something wrong please try again. Validation Error');
            }
        }
        
		$this->load->view('frontend/contact');
	}
}


