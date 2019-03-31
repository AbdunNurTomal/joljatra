<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Passport extends Agent_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('passport_model');
        $this->load->model('agency_model');
    }
	public function index()
	{
        
		$this->history();
	} 
    
    
        //public function 
     public function history(){
         $agent_id=$this->session->userdata('current_user_id');
        
        $data['agent_id']=$agent_id;
   
        $this->load->model('agency_model');
        $data['agents']=$this->user_model->get_all_new_agent();
        $data['agency']=$this->agency_model->get_all_agency();
        
        // start the search operation
        $query_vars=array();
        $query_vars['agent_id']=$agent_id;
        $query_vars['account']='Open';
       
        
        if($this->input->get('search_passport')){
            if($this->input->get('p_number')){ $query_vars['p_number']=$this->input->get('p_number');}
            if($this->input->get('gender')){ $query_vars['gender']=$this->input->get('gender');}
            if($this->input->get('finger_status')){ $query_vars['finger_status']=$this->input->get('finger_status');}
            if($this->input->get('current_status')){ $query_vars['current_status']=$this->input->get('current_status');}
            if($this->input->get('account')){ $query_vars['account']=$this->input->get('account');}
            
            $data['user_data']=$this->passport_model->get_passport_search($query_vars);
        }else{
             $data['user_data']=$this->passport_model->get_passport_search($query_vars);
        }
        
        $this->load->view("agent/passport/history", $data);
    }
    
    //public function 
    public function history_print(){
        $agent_id=$this->session->userdata('current_user_id');
        $data['agent_id']=$agent_id;
        
        $this->load->model('agency_model');
        $data['agents']=$this->user_model->get_all_new_agent();
        $data['agency']=$this->agency_model->get_all_agency();
        
        // start the search operation
        $query_vars=array();
        $query_vars['agent_id']=$agent_id;
        $query_vars['account']='Open';
       
        
        if($this->input->get('search_passport')){
            if($this->input->get('p_number')){ $query_vars['p_number']=$this->input->get('p_number');}
            if($this->input->get('gender')){ $query_vars['gender']=$this->input->get('gender');}
            if($this->input->get('finger_status')){ $query_vars['finger_status']=$this->input->get('finger_status');}
            if($this->input->get('current_status')){ $query_vars['current_status']=$this->input->get('current_status');}
            if($this->input->get('account')){ $query_vars['account']=$this->input->get('account');}
            
            $data['user_data']=$this->passport_model->get_passport_search($query_vars);
        }else{
             $data['user_data']=$this->passport_model->get_passport_search($query_vars);
        }
        
        $this->load->view("agent/passport/history_print", $data);
    }
  
    
    
}

