<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('user_model');
        if($this->user_model->is_user_logd_in()){
            redirect('admin/dashboard');
        }
         if(!$this->user_model->is_captcha_log()){
            redirect('pre_login');
        }
    }
	public function index($error=null)
	{
        $data=array();
        if($error){
            $data['login_error']=$error;
        }
		$this->load->view('admin/admin-login', $data);
	}
    
    public function try_login(){
        $user_name = $this->input->post('user_name');
        $password= $this->input->post('password');
        if($this->user_model->is_user_available( $user_name, md5($password) )){
            if($this->session->userdata('current_user_type')=='customer'){
                redirect('customer');
            }else{
                redirect('admin/dashboard');
            }
        }else{
            redirect('login/index/error');
        }
    }
    
    public function destroy(){
        $sesattr = array(
						'captcha_code' => false,
						'current_user_id' => '',
						'current_username' => '',
						'current_user_type' => '',
						'base_url' => ''
					);
       $this->session->unset_userdata($sesattr);
        redirect('login');
    }
    
    
    // try login by ajax
     public function try_login_ajax(){
        $return=array();
         if(isset($_POST['login_action'])){
            $user_name = $_POST['user_name'];
            $password= $_POST['password'];
            if($this->user_model->is_user_available( $user_name, md5($password) )){
                $return['login_status']=true;
                echo json_encode($return);
            }else{
                $return['login_status']=false;
                echo json_encode($return);
            }   
         }
        
    }
    
    //check imail for reset 
    public function forget_password_email(){
        $return=array();
         $return['reset_email']=false;
        $return['reset_error']='Something wrong please try agian';
         if(isset($_POST['reset_email'])){
             $email = $_POST['reset_email'];
             $user = $this->user_model->get_user_by_email($email);
             if($user){
                 if($user->phone){
                     $reset_code = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
                     //save the code on you 
                     $this->session->set_userdata('reset_code', $reset_code);
                     $this->session->set_userdata('reset_email', $email);
                     $this->session->set_userdata('reset_staatus', false);
                     // attemt for sms
                     $this->load->helper('sms');
                     $this->sms = new sms();
                    $mss_repsonse =  $this->sms->send('+88'.$user->phone, 'Joljatra Password Reset Code:- '.$reset_code);
                     if($mss_repsonse){
                         $return['reset_email']=true;
                         $return['phone_number']=$user->phone;
                     }else{
                        $return['reset_email']=false; 
                         $return['reset_error']='sms not sending please try again.';
                     }
                 }else{
                     $return['reset_email']=false;
                     $return['reset_error']='Your phone number is not valid';
                 }
             }else{
                 $return['reset_email']=false;
                 $return['reset_error']='Your email is not intered in our database';
             }
         }
         echo json_encode($return);
        
    }
    
    // check reset code is valid or not 
    public function submit_reset_code(){
         $return=array();
         $return['reset_code']=false;
        $return['reset_error']='Something wrong please try agian';
         if(isset($_POST['reset_code'])){
            if($_POST['reset_code']==$this->session->userdata('reset_code')){
                 $return['reset_code']=true;
                $this->session->set_userdata('reset_staatus', 'reset_true');
            }else{
                $return['reset_code']=false;
                $return['reset_error']='Your reset code is not valid';
            }
         }
         echo json_encode($return);
    }
    
    // if everything ok reset the password
    public function submit_reset_password(){
        $return=array();
         $return['reset_new_pass']=false;
        $return['reset_error']='Something wrong please try agian';
         
        if(isset($_POST['reset_password'])){
            if($_POST['reset_password']==$_POST['again_reset_password']){
                if($this->session->userdata('reset_staatus')=='reset_true'){
                    $email = $this->session->userdata('reset_email');
                    if($this->db->where('email', $email)->update('users', array('password'=>md5($_POST['reset_password'])))){
                        $return['reset_new_pass']=true;
                        $return['reset_error']='Your password has been reset.';
                    }else{
                        $return['reset_new_pass']=false;
                        $return['reset_error']='Something wrong please try agian';
                    }
                }else{
                    $return['reset_new_pass']=false;
                    $return['reset_error']='Taking wrong action';
                }
            }else{
                $return['reset_new_pass']=false;
                $return['reset_error']='Password Does not Metch';
            }
        }
           
           echo json_encode($return);
    }
    
    
   /* public function display(){
        echo $this->session->userdata('reset_code');
    }*/
    
}
