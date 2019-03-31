<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signup extends CI_Controller {

	public function index()
	{ 
        $data=array();
         if($this->input->post('sign_up')){
             
             $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
             $this->form_validation->set_rules('user_name', 'User Name', 'trim|required|is_unique[users.user_name]');
             
            $update_attr=array(
                'first_name'=>$this->input->post('first_name'),
                'last_name'=>$this->input->post('last_name'),
                'user_name'=>$this->input->post('user_name'),
                'phone'=>$this->input->post('phone'),
                'product_code'=>$this->input->post('product_code'),
                'referal_id'=>$this->input->post('referal_id'),
                'password'=>md5($this->input->post('password')),
                'image'=>'demo-avater.png',
                'email'=>$this->input->post('email'),
                'phone'=>$this->input->post('phone'),
                'product_code'=>$this->input->post('product_code'),
                'referal_id'=>$this->input->post('referal_id'),
                'team'=>$this->input->post('team')
            );
            
             if($this->form_validation->run()){
                   if($this->db->insert('users', $update_attr)){
                    $this->session->set_userdata('success_msg', 'Your Sign Up compleated. Please Complete Your Profile');
                    /*New Need to log in him*/
                       if($this->user_model->is_user_available( $this->input->post('user_name'), md5($this->input->post('password') ))){
                           redirect('customer/profile');
                       }
                }else{
                    $this->session->set_userdata('error_msg', 'Something wrong please try again');
                }  
             }else{
                 $data['validation_errors']=validation_errors('<p>', '</p>');
                  $this->session->set_userdata('error_msg', 'Something wrong please try again. Validation Error');
             }
            
        }
        
        
		$this->load->view('frontend/signup', $data);
	}
    
    
    // try sign up by ajax
	public function try_sign_up_ajax()
	{ 
        $data=array();
        $data['sign_up_success']=false;
         if($this->input->post('sign_up_action')){
             
             $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
             $this->form_validation->set_rules('user_name', 'User Name', 'trim|required|is_unique[users.user_name]');
             
            $update_attr=array(
                'first_name'=>$this->input->post('first_name'),
                'last_name'=>$this->input->post('last_name'),
                'user_name'=>$this->input->post('user_name'),
                'phone'=>$this->input->post('phone'),
                'password'=>md5($this->input->post('password')),
                'image'=>'demo-avater.png',
                'email'=>$this->input->post('email')
            );
            
             if($this->form_validation->run()){
                   if($this->db->insert('users', $update_attr)){
                    $data['sign_up_success']=true;
                       $this->sms_send('+88'.$update_attr['phone']);
                }else{
                    $data['validation_errors']="Something wrong please try again";
                    $data['sign_up_success']=false;
                }  
             }else{
                 $data['validation_errors']=validation_errors('<p>', '</p>');
                  $data['sign_up_success']=false;
                  
             }
            
        }
        
        echo json_encode($data);
        
	}
    
    //This method for send a sms to user 
    public function sms_send($to){
        $this->load->helper('sms');
        $this->sms = new sms();
        $sign_up_sms = $this->user_model->get_setting_data('sign_up_sms');
        $mss_repsonse = $this->sms->send($to, $sign_up_sms);
    }
    
    //this function for checking referal id
    public function user_name_validation(){
        $data['user_data']=array();
        if($this->input->post('user_name')){
            $user_name = $this->input->post('user_name');
            if(strlen($user_name)>3){
                  $data['user_data']=$this->db->where('user_name', $user_name)->get('users')->result(); 
            }else{
                $data['user_data'][0]=array('error_username'=>'username is too short');
            }
        }
       
        header('Access-Control-Allow-Origin: *');
        header("Content-Type: application/json");
        echo json_encode($data['user_data']);
    }
    
    //this function for checking email validation
    public function user_email_validation(){
        $data['user_data']=array();
        if($this->input->post('user_email')){
            $user_email = $this->input->post('user_email');
            if(filter_var($user_email, FILTER_VALIDATE_EMAIL)){
                  $data['user_data']=$this->db->where('email', $user_email)->get('users')->result(); 
            }else{
                $data['user_data'][0]=array('error_user_email'=>'user email validation false');
            }
        }
       
        header('Access-Control-Allow-Origin: *');
        header("Content-Type: application/json");
        echo json_encode($data['user_data']);
    }
    
    public function test($user_email='programmerashraful'){
        
            if(filter_var($user_email, FILTER_VALIDATE_EMAIL)){
                  echo true; 
            }else{
                echo 'false';
            }
        }
    
    
    
    

}
