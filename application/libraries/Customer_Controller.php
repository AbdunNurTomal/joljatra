<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_Controller extends MY_Controller {
    function __construct(){
        parent::__construct();
        date_default_timezone_set('Asia/Dhaka');
        $this->load->model('user_model');
        if(!$this->user_model->is_user_logd_in()){
             redirect();
        }
        if($this->user_model->is_user_logd_in()  and $this->session->userdata('current_user_type')!='passenger'){
             redirect('admin/dashboard');
        }
    }
}
