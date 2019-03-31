<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends MY_Controller {
    public function __construct(){
        parent::__construct();
    }
	public function index($error=null)
	{
        $this->destroy();
	}
    
    public function destroy(){
        $sesattr = array(
						'current_user_id' => '',
						'current_username' => '',
						'current_user_type' => '',
						'base_url' => ''
					);
       $this->session->set_userdata($sesattr);
        redirect('login');
    }
    // logout call by ajax 
    public function logout_ajax(){
        $sesattr = array(
						'current_user_id' => '',
						'current_username' => '',
						'current_user_type' => '',
						'base_url' => ''
					);
       $this->session->set_userdata($sesattr);
       $return['login_status']=true;
        echo json_encode($return);
    }
}
